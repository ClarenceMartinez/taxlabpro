<?php

namespace App\Services;

use App\Models\Files; // Importar el modelo Files
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class TranscriptParserService
{
    // Define base paths for client's transcripts
    private const TAX_RETURN_TRANSCRIPTS_SUB_PATH = 'Transcripts/Tax Return Transcripts';
    private const ACCOUNT_TRANSCRIPTS_SUB_PATH = 'Transcripts/Account Transcripts';

    protected Files $filesModel;

    public function __construct(Files $filesModel)
    {
        $this->filesModel = $filesModel;
    }

    private function getTranscripts(int $clientId, ?string $clientStorageBasePath, string $transcriptSubPath, callable $parserCallback): array
    {
        if (empty($clientStorageBasePath)) {
            Log::warning("TranscriptParserService: No storage base path provided for client ID {$clientId}.");
            return [];
        }

        $directoryPathForDbQuery = rtrim(str_replace('//', '/', $clientStorageBasePath . '/' . $transcriptSubPath), '/');

        $dbFiles = $this->filesModel
            ->where('client_id', $clientId)
            ->where('url', 'like', $directoryPathForDbQuery . '/%')
            ->where(function ($query) {
                $query->where('ext', 'html')
                      ->orWhere('ext', 'htm');
            })
            ->get();

        if ($dbFiles->isEmpty()) {
            Log::info("TranscriptParserService: No transcript files found in database for client ID {$clientId} at path prefix '{$directoryPathForDbQuery}/'. Type: " . basename($transcriptSubPath));
            return [];
        }

        $parsedTranscripts = [];

        foreach ($dbFiles as $fileRecord) {
            $filePath = $fileRecord->url;

            if (!Storage::disk('local')->exists($filePath)) {
                Log::warning("TranscriptParserService: File record found in DB (ID: {$fileRecord->id}, URL: {$filePath}) but file not found on disk for client ID {$clientId}. Skipping.");
                continue;
            }

            try {
                $content = Storage::disk('local')->get($filePath);
                if (empty(trim($content))) {
                    Log::warning("TranscriptParserService: File content is empty for {$filePath} (DB ID: {$fileRecord->id}) for client ID {$clientId}. Skipping.");
                    continue;
                }
                $data = call_user_func($parserCallback, $content, basename($filePath));

                if ($data && isset($data['tax_year'])) {
                    $data['file_id'] = $fileRecord->id;
                    $parsedTranscripts[] = $data;
                } else {
                    Log::warning("TranscriptParserService: Could not parse or missing tax year for file {$filePath} (DB ID: {$fileRecord->id}) for client ID {$clientId}. Type: " . basename($transcriptSubPath));
                }
            } catch (\Exception $e) {
                Log::error("TranscriptParserService: Failed to process file {$filePath} (DB ID: {$fileRecord->id}) for client ID {$clientId}. Error: " . $e->getMessage(), ['exception' => $e]);
            }
        }

        usort($parsedTranscripts, function ($a, $b) {
            return ($b['tax_year'] ?? 0) <=> ($a['tax_year'] ?? 0);
        });

        return $parsedTranscripts;
    }

    public function getTaxReturnTranscripts(int $clientId, ?string $clientStorageBasePath): array
    {
        return $this->getTranscripts(
            $clientId,
            $clientStorageBasePath,
            self::TAX_RETURN_TRANSCRIPTS_SUB_PATH,
            [$this, 'parseTaxReturnTranscriptContent']
        );
    }

    public function getAccountTranscripts(int $clientId, ?string $clientStorageBasePath): array
    {
        return $this->getTranscripts(
            $clientId,
            $clientStorageBasePath,
            self::ACCOUNT_TRANSCRIPTS_SUB_PATH,
            [$this, 'parseAccountTranscriptContent']
        );
    }

    private function parseTaxReturnTranscriptContent(string $htmlContent, string $filename): ?array
    {
        $crawler = new Crawler($htmlContent);
        $data = [];

        $taxYear = null;
        $titleText = $this->getTextFromXPath($crawler, '//head/title');
        if ($titleText && preg_match('/(\d{4})\d{2}/', $titleText, $matches)) {
            $taxYear = (int) $matches[1];
        }
        if (!$taxYear) {
            $taxPeriodEnding = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'Tax Period Ending:']]/td[2]");
            if ($taxPeriodEnding && preg_match('/(\d{4})$/', $taxPeriodEnding, $matches)) {
                $taxYear = (int) $matches[1];
            }
        }
         if (!$taxYear) {
            if ($titleText && preg_match('/Dec\.\s*31,\s*(\d{4})/', $titleText, $matches)) {
                $taxYear = (int) $matches[1];
            }
        }
        if (!$taxYear) {
            Log::warning("TranscriptParserService (Tax Return): Could not determine tax year for file {$filename} during parsing.");
            return null;
        }
        $data['tax_year'] = $taxYear;
        $data['source_filename'] = $filename;
        $data['transcript_type'] = 'Tax Return Transcript';

        $fieldSelectors = [
            'ssn' => ["//tr[td[1][normalize-space(.) = 'SSN:']]/td[2]", "//tr[td[1][normalize-space(.) = 'SSN Provided:']]/td[2]"],
            'spouse_ssn' => ["//tr[td[1][normalize-space(.) = 'SPOUSE SSN:']]/td[2]"],
            'names_on_return' => ["//tr[td[1][normalize-space(.) = 'NAME(S) SHOWN ON RETURN:']]/td[2]"],
            'filing_status' => ["//tr[td[1][normalize-space(.) = 'FILING STATUS:']]/td[@class='PDFFilingStatus']", "//tr[td[1][normalize-space(.) = 'FILING STATUS:']]/td[2]"],
            'total_income' => [
                "//tr[td[1][normalize-space(.) = 'TOTAL INCOME PER COMPUTER:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'TOTAL INCOME:']]/td[2]"
            ],
            'adjusted_gross_income' => [
                "//tr[td[1][normalize-space(.) = 'ADJUSTED GROSS INCOME PER COMPUTER:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'ADJUSTED GROSS INCOME:']]/td[2]"
            ],
            'taxable_income' => [
                "//tr[td[1][normalize-space(.) = 'TAXABLE INCOME PER COMPUTER:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'TAXABLE INCOME:']]/td[2]"
            ],
            'total_tax' => [
                "//tr[td[1][normalize-space(.) = 'TOTAL ASSESSMENT PER COMPUTER:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'TOTAL TAX LIABILITY TP FIGURES PER COMPUTER:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'TOTAL TAX LIABILITY TP FIGURES:']]/td[2]",
            ],
            'total_payments' => [
                "//tr[td[1][normalize-space(.) = 'TOTAL PAYMENTS PER COMPUTER:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'TOTAL PAYMENTS:']]/td[2]"
            ],
            'balance_due_or_overpayment' => [
                "//tr[td[1][normalize-space(.) = 'BAL DUE/OVER PYMT USING COMPUTER FIGURES:']]/td[2]",
                "//tr[td[1][normalize-space(.) = 'AMOUNT YOU OWE:']]/td[2]",
            ],
        ];

        foreach ($fieldSelectors as $key => $xpaths) {
            $value = null;
            foreach ((array)$xpaths as $xpath) {
                $value = $this->getTextFromXPath($crawler, $xpath);
                if ($value !== null) break;
            }
            $data[$key] = $value;
        }

        $numericKeys = ['total_income', 'adjusted_gross_income', 'taxable_income', 'total_tax', 'total_payments', 'balance_due_or_overpayment'];
        foreach($numericKeys as $key) {
            if (isset($data[$key])) {
                $data[$key] = $this->cleanMonetaryValue($data[$key]);
            }
        }
        return $data;
    }

    private function parseAccountTranscriptContent(string $htmlContent, string $filename): ?array
    {
        $crawler = new Crawler($htmlContent);
        $data = [];

        $taxYear = null;
        $titleText = $this->getTextFromXPath($crawler, '//head/title');
        if ($titleText && preg_match('/Dec\.\s*31,\s*(\d{4})/', $titleText, $matches)) {
            $taxYear = (int) $matches[1];
        }
        if (!$taxYear) {
            $taxPeriod = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'TAX PERIOD:']]/td[2]");
            if ($taxPeriod && preg_match('/(\d{4})$/', $taxPeriod, $matches)) {
                $taxYear = (int) $matches[1];
            }
        }

        if (!$taxYear) {
            Log::warning("TranscriptParserService (Account): Could not determine tax year for file {$filename} from title or TAX PERIOD field.");
            return null;
        }
        $data['tax_year'] = $taxYear;
        $data['source_filename'] = $filename;
        $data['transcript_type'] = 'Account Transcript';

        $data['request_date'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'Request Date:']]/td[2]");
        $data['response_date'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'Response Date:']]/td[2]");
        $data['tracking_number'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'Tracking Number:']]/td[2]");
        $data['form_number'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'FORM NUMBER:']]/td[2]");
        $data['taxpayer_identification_number'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'TAXPAYER IDENTIFICATION NUMBER:']]/td[2]");
        
        $nameNode = $crawler->filterXPath('//table[summary="This table is used for layout purposes only" and .//b[contains(text(), "POWER OF ATTORNEY")]]/tr[1]/td[1]');
        if ($nameNode->count() > 0) {
            $data['taxpayer_name'] = trim($nameNode->text());
        } else {
            $data['taxpayer_name'] = $this->getTextFromXPath($crawler, "//body/table/tr/td/table[count(tr)=2 and .//b[contains(text(), 'POWER OF ATTORNEY')]]/tr[1]/td[1]");
            if(!$data['taxpayer_name']) { // Fallback if the above is too specific or structure varies slightly
                Log::debug("TranscriptParserService (Account): Taxpayer name primary XPath failed for {$filename}, trying less specific based on POA proximity.");
                // Attempt to find any table that contains the POA text, then go up to its parent `td`, then find a preceding sibling `td` that might contain the name. This is more fragile.
                 $poaNode = $crawler->filterXPath('//b[contains(text(), "POWER OF ATTORNEY")]');
                 if ($poaNode->count() > 0) {
                     try {
                        // This logic assumes name is in a <tr> directly above the POA <tr>, in the same table structure
                        $nameCandiateNode = $poaNode->closest('table')->filterXPath('preceding-sibling::tr/td[1]|tr[1]/td[1]')->first();
                        if($nameCandiateNode->count() > 0) $data['taxpayer_name'] = trim($nameCandiateNode->text());
                     } catch (\Exception $e){
                        Log::debug("TranscriptParserService (Account): Exception during fallback taxpayer name parsing for {$filename}: " . $e->getMessage());
                        $data['taxpayer_name'] = null;
                     }
                 } else {
                    $data['taxpayer_name'] = null;
                 }
            }
        }
        
        $data['account_balance'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'ACCOUNT BALANCE:']]/td[2]"));
        $data['accrued_interest'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'ACCRUED INTEREST:']]/td[2]"));
        $data['accrued_interest_as_of_date'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'ACCRUED INTEREST:'] and td[3][normalize-space(.) = 'AS OF:']]/td[4]");
        $data['accrued_penalty'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'ACCRUED PENALTY:']]/td[2]"));
        $data['accrued_penalty_as_of_date'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'ACCRUED PENALTY:'] and td[3][normalize-space(.) = 'AS OF:']]/td[4]");
        $data['account_balance_plus_accruals'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][starts-with(normalize-space(.), 'ACCOUNT BALANCE PLUS ACCRUALS')]]/td[2]"));

        $data['exemptions'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'EXEMPTIONS:']]/td[2]");
        $data['filing_status'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'FILING STATUS:']]/td[normalize-space(@class)='PDFFilingStatus']");
        if (!$data['filing_status']) {
            $data['filing_status'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'FILING STATUS:']]/td[2]");
        }
        $data['adjusted_gross_income'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'ADJUSTED GROSS INCOME:']]/td[2]"));
        $data['taxable_income'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'TAXABLE INCOME:']]/td[2]"));
        $data['tax_per_return'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'TAX PER RETURN:']]/td[2]"));
        $data['se_taxable_income_taxpayer'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'SE TAXABLE INCOME TAXPAYER:']]/td[2]"));
        $data['se_taxable_income_spouse'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'SE TAXABLE INCOME SPOUSE:']]/td[2]"));
        $data['total_self_employment_tax'] = $this->cleanMonetaryValue($this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'TOTAL SELF EMPLOYMENT TAX:']]/td[2]"));
        
        $data['return_due_date_or_received_date'] = $this->getTextFromXPath($crawler, "//tr[td[1][starts-with(normalize-space(.), 'RETURN DUE DATE OR RETURN RECEIVED DATE')]]/td[2]");
        $data['processing_date'] = $this->getTextFromXPath($crawler, "//tr[td[1][normalize-space(.) = 'PROCESSING DATE']]/td[2]");

        // Transactions
        $data['transactions'] = [];
        
        // **** MODIFIED XPath for locating the transaction table ****
        // Primary XPath: Targets summary, normalizes space and case.
        $transactionTableBasePath = "//table[contains(normalize-space(translate(@summary, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')), 'transactions table')]";
        $transactionTableNode = $crawler->filterXPath($transactionTableBasePath);

        if ($transactionTableNode->count() === 0) {
            Log::warning("TranscriptParserService (Account): Transactions table (primary XPath based on summary) not found for file '{$filename}'. XPath: '{$transactionTableBasePath}'");
            
            // Fallback XPath: Targets table based on specific header content (more robust if summary changes drastically)
            $transactionTableBasePath_alt = "//table[.//th[normalize-space(.)='CODE'] and .//th[normalize-space(.)='EXPLANATION OF TRANSACTION'] and .//th[normalize-space(.)='CYCLE'] and .//th[normalize-space(.)='DATE'] and .//th[normalize-space(.)='AMOUNT']]";
            $transactionTableNode = $crawler->filterXPath($transactionTableBasePath_alt);
            
            if($transactionTableNode->count() > 0) {
                Log::info("TranscriptParserService (Account): Transactions table found using ALT XPath (based on table headers) for file '{$filename}'. Using XPath: '{$transactionTableBasePath_alt}'");
                $transactionTableBasePath = $transactionTableBasePath_alt; // Use this path for subsequent operations
            } else {
                Log::warning("TranscriptParserService (Account): Transactions table (ALT XPath with headers) also not found for file '{$filename}'. XPath: '{$transactionTableBasePath_alt}'. No transactions will be parsed.");
                // No need to proceed if table is not found by either method.
                return $data; // Return data parsed so far (without transactions)
            }
        } else {
            Log::debug("TranscriptParserService (Account): Transactions table found using primary XPath (summary) for file '{$filename}'.");
        }

        // Proceed with parsing rows from the identified transaction table
        $separatorRowPath = $transactionTableBasePath . '/tr[td[@class="l_solidblack"]]';
        $separatorRowNode = $crawler->filterXPath($separatorRowPath);
        if ($separatorRowNode->count() === 0) {
            Log::warning("TranscriptParserService (Account): Transaction table separator row (class 'l_solidblack') not found for file '{$filename}'. XPath: '{$separatorRowPath}'. Attempting to find rows without relying on specific separator if headers were present.");
            // If separator is missing but we found table by headers, we might try to grab all 'tr' after the header 'tr'
            // This assumes the header row is the first 'tr' if the separator is missing.
            $headerRowPath = $transactionTableBasePath . '/tr[th[normalize-space(.)="CODE"]]';
            $transactionRows = $crawler->filterXPath($headerRowPath . '/following-sibling::tr');

            if ($transactionRows->count() == 0) {
                 Log::warning("TranscriptParserService (Account): Could not find transaction data rows even after trying to bypass missing separator for file '{$filename}'.");
                 return $data; // No rows to parse
            }
            Log::debug("TranscriptParserService (Account): Found " . $transactionRows->count() . " potential transaction data rows (bypassing missing separator) for file '{$filename}'.");


        } else {
             Log::debug("TranscriptParserService (Account): Transaction table separator row found for file '{$filename}'.");
             $transactionRowsPath = $separatorRowPath . '/following-sibling::tr';
             $transactionRows = $crawler->filterXPath($transactionRowsPath);
             Log::debug("TranscriptParserService (Account): Found " . $transactionRows->count() . " potential transaction data rows for file '{$filename}' using XPath: '{$transactionRowsPath}'.");
        }
        
        if ($transactionRows->count() === 0 && $transactionTableNode->count() > 0 && $separatorRowNode->count() > 0) {
            $allRowsInTable = $transactionTableNode->filter('tr');
            Log::debug("TranscriptParserService (Account): Total rows in transaction table (including headers/separators): " . $allRowsInTable->count() . " for file '{$filename}', but 0 data rows after separator.");
        }

        $lastTransactionIndex = -1;

        $transactionRows->each(function (Crawler $row, $i) use (&$data, &$lastTransactionIndex, $filename) {
            $cells = $row->filter('td');
            // Each transaction row should have 5 cells (CODE, EXPLANATION, CYCLE, DATE, AMOUNT)
            // Supplemental rows ('n/a') also tend to have this structure, though some cells might be empty.
            if ($cells->count() < 5) {
                Log::debug("TranscriptParserService (Account): Row " . ($i+1) . " in file '{$filename}' has {$cells->count()} cells, expected at least 5. Skipping. Row HTML: " . substr($row->html(), 0, 200) . "...");
                return;
            }

            $code = trim($cells->eq(0)->text(null, true));
            $explanationHtml = $cells->eq(1)->html();
            $explanation = trim(str_replace(['<br>','<br/>','<br />'], ' ', $explanationHtml));
            $explanation = preg_replace('/\s+/', ' ', strip_tags($explanation)); 

            $cycleText = trim($cells->eq(2)->text(null, true));
            $dateText = trim($cells->eq(3)->text(null, true));
            $amountStr = trim($cells->eq(4)->text(null, true));
            
            if (is_numeric($code)) {
                $transaction = [
                    'code' => $code,
                    'explanation' => $explanation,
                    'cycle' => $cycleText ?: null, 
                    'date' => $dateText ?: null,   
                    'amount' => $this->cleanMonetaryValue($amountStr),
                    'supplemental_info' => []
                ];
                $data['transactions'][] = $transaction;
                $lastTransactionIndex = count($data['transactions']) - 1;
            } elseif (strtolower($code) === 'n/a' && $lastTransactionIndex !== -1 && !empty(trim($explanation))) {
                $data['transactions'][$lastTransactionIndex]['supplemental_info'][] = $explanation;
            } else {
                // Only log if it's not an empty row that sometimes appears at the end of tables.
                if(!empty(trim($row->text(null, true)))) {
                     Log::debug("TranscriptParserService (Account): Row " . ($i+1) . " in file '{$filename}' did not match main transaction or supplemental info structure. Code: '{$code}', Explanation Preview: '" . substr($explanation, 0, 50) . "...'");
                }
            }
        });
        Log::info("TranscriptParserService (Account): Successfully processed " . count($data['transactions']) . " transactions for file '{$filename}'.");
        // **** END MODIFICATION ****

        return $data;
    }

    private function getTextFromXPath(Crawler $crawler, string $xpath): ?string
    {
        try {
            $node = $crawler->filterXPath($xpath);
            if ($node->count() > 0) {
                $text = trim($node->text(null, true)); 
                return $text !== '' ? $text : null;
            }
        } catch (\InvalidArgumentException $e) {
            Log::debug("TranscriptParserService: Invalid XPath or node not found: {$xpath} - " . $e->getMessage());
        }
        return null;
    }

    private function cleanMonetaryValue(?string $value): ?float
    {
        if ($value === null || trim($value) === '') {
            return null;
        }
        $cleanedValue = $value;
        $isNegative = false;

        if (str_starts_with($cleanedValue, '-')) {
            $isNegative = true;
            $cleanedValue = substr($cleanedValue, 1);
        }
        
        $cleanedValue = str_replace(['$', ',', ' '], '', $cleanedValue);
        
        if (!$isNegative && str_starts_with($cleanedValue, '(') && str_ends_with($cleanedValue, ')')) {
            $cleanedValue = substr($cleanedValue, 1, -1);
            $isNegative = true; 
        }
        
        if (is_numeric($cleanedValue)) {
            $floatVal = (float)$cleanedValue;
            return $isNegative ? -$floatVal : $floatVal;
        }
        
        if (preg_match('/[\d\.\(\)-]/', $value)) {
             Log::debug("TranscriptParserService: Could not parse monetary value '{$value}' to float. Cleaned to '{$cleanedValue}'. Input: '{$value}'");
        }
        return null;
    }
}