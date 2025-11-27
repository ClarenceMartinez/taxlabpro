<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Client Report - {{ $client->first_name }} {{ $client->last_name }}</title>
    <style>
        :root {
            --tlp-primary-color: #0056b3;
            --tlp-secondary-color: #4A5568;
            --tlp-accent-color: #007bff;
            --tlp-light-bg: #f8f9fa;
            --tlp-header-footer-bg: #e9ecef;
        }

        body { font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin: 0; padding: 0; color: var(--tlp-secondary-color); }
        @page { margin: 25px 25px 45px 25px; }

        .header-brand {
            text-align: right;
            padding-bottom: 10px;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--tlp-primary-color);
        }
        .header-brand img {
            max-height: 45px;
            vertical-align: middle;
        }
        .header-brand .brand-text {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
            font-size: 10px;
            color: var(--tlp-secondary-color);
        }
        .header-brand .brand-name {
            font-weight: bold;
            color: var(--tlp-primary-color);
        }

        .main-title { text-align: center; color: var(--tlp-primary-color); font-size: 20px; margin-bottom: 5px; }
        .client-info-header { text-align: center; font-size: 12px; margin-bottom: 25px; color: var(--tlp-secondary-color); }

        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: -30px;
            font-size: 8px;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            background-color: var(--tlp-header-footer-bg);
            color: var(--tlp-secondary-color);
        }
        .pagenum:before { content: counter(page); }
        .container { margin-top: 0; margin-bottom: 30px; }

        h2 { font-size: 15px; color: var(--tlp-primary-color); margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        h3 { font-size: 13px; color: var(--tlp-secondary-color); margin-top: 15px; margin-bottom: 8px; }
        h4 { font-size: 11px; color: var(--tlp-primary-color); margin-top: 10px; margin-bottom: 5px; text-decoration: underline;}

        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; table-layout: fixed; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; vertical-align: top; word-wrap: break-word; }
        th { background-color: var(--tlp-light-bg); font-weight: bold; color: var(--tlp-primary-color); }

        .profile-table td:first-child, .summary-table td:first-child { width: 35%; font-weight: bold; background-color: var(--tlp-light-bg);}
        .profile-table td, .summary-table td { padding: 6px; }
        .summary-table th { text-align: center; }
        .summary-table td { text-align: right; }
        .summary-table td:first-child { text-align: left; font-weight: normal; } /* Ajuste para que el año no sea bold */

        .no-data { text-align: center; color: #718096; padding: 10px; font-style: italic; background-color: #f9f9f9; }
        .section { margin-bottom: 25px; padding: 15px; border: 1px solid #dee2e6; border-radius: 5px; background-color: #fff; }
        .intro-text { text-align: justify; margin-bottom: 15px; padding: 10px; background-color: #eef2f7; border-left: 4px solid var(--tlp-accent-color); color: var(--tlp-secondary-color); line-height: 1.4;}
        .page-break { page-break-after: always; }

        .transcript-summary { margin-bottom: 6px; line-height: 1.3;}
        .transcript-summary strong { display: inline-block; width: 190px; color: var(--tlp-secondary-color); }

        .transcript-block {
            border: 1px solid var(--tlp-accent-color);
            padding: 12px;
            margin-bottom:15px;
            border-radius: 4px;
            background-color: var(--tlp-light-bg);
        }
        .transcript-block h3 {
            color: var(--tlp-primary-color);
            border-bottom: 1px dotted #ccc;
            padding-bottom: 4px;
            margin-top: 0;
        }
         .transcript-block h3 small {
            font-size: 9px;
            font-weight: normal;
            color: #777;
         }
         .sub-section table { margin-top: 5px; }
         .sub-section { margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="footer">
        Generated on: {{ $reportGeneratedDate }}  |  Page <span class="pagenum"></span>  |  Powered by <strong style="color: var(--tlp-primary-color);">TaxLabPro</strong>
    </div>

    <div class="container">
        <div class="header-brand">
            @if(file_exists(public_path('img/taxlabpro_logo.png')))
                <img src="{{ public_path('img/taxlabpro_logo.png') }}" alt="TaxLabPro Logo">
            @else
                <span class="brand-text" style="font-size: 12px;">
                    Generated with <span class="brand-name" style="font-size: 14px;">TaxLabPro</span>
                </span>
            @endif
        </div>

        <h1 class="main-title">Client Information Report</h1>
        <p class="client-info-header">
            <strong>Client:</strong> {{ $client->first_name }} {{ $client->last_name ?: $client->business_name }}
            @if($client->client_reference) | <strong>Ref:</strong> {{ $client->client_reference }} @endif
            <br>
            <strong>Report Date:</strong> {{ $reportGeneratedDate }}
        </p>

        <div class="section">
            <h2>Introduction</h2>
            <p class="intro-text">
                This report provides a comprehensive summary of client information, including personal, contact, and case details, along with key data extracted from available tax transcripts. The transcript data offers an overview of the client's tax history for the years presented. All information should be verified for accuracy and completeness.
            </p>
        </div>

        <div class="section">
            <h2>Client Profile</h2>
            <table class="profile-table">
                <tr><td colspan="2" style="background-color: var(--tlp-accent-color); color: white; font-weight:bold; text-align:center;">General Information</td></tr>
                <tr><td>Full Name:</td><td>{{ $client->first_name }} {{ $client->mi ? $client->mi.'. ' : '' }}{{ $client->last_name }}</td></tr>
                @if($client->business_name)
                <tr><td>Business Name:</td><td>{{ $client->business_name }}</td></tr>
                @endif
                <tr><td>SSN/EIN:</td><td>{{ $client->ssn ?: ($client->ein ?: 'N/A') }}</td></tr>
                <tr><td>Date of Birth:</td><td>{{ $client->date_birdth ? \Carbon\Carbon::parse($client->date_birdth)->format('m/d/Y') : 'N/A' }}</td></tr>
                <tr><td>Client Type:</td><td>{{ $client->type ? ucfirst($client->type) : 'N/A' }}</td></tr>
                <tr><td>Case Status:</td><td>
                    @php
                        $caseStatusMap = [1 => 'Open', 2 => 'In Progress', 3 => 'Closed'];
                    @endphp
                    {{ $caseStatusMap[$client->case_status] ?? 'N/A' }}
                </td></tr>
                <tr><td>Form Type:</td><td>{{ $client->form_type ?: 'N/A' }}</td></tr>

                <tr><td colspan="2" style="background-color: var(--tlp-accent-color); color: white; font-weight:bold; text-align:center;">Contact Information</td></tr>
                <tr><td>Taxpayer Email:</td><td>{{ $client->tax_payer_email ?: 'N/A' }}</td></tr>
                <tr><td>Phone (Home):</td><td>{{ $client->phone_home ?: 'N/A' }}</td></tr>
                <tr><td>Phone (Cell):</td><td>{{ $client->cell_home ?: 'N/A' }}</td></tr>
                <tr><td>Phone (Work):</td><td>{{ $client->phone_work ?: 'N/A' }}</td></tr>
                <tr>
                    <td>Primary Address:</td>
                    <td>
                        {{ $client->address_1 ?: '' }}
                        @if($client->address_2)<br>{{ $client->address_2 }}@endif
                        <br>
                        {{ $client->city ? $client->city . ', ' : '' }}
                        {{ $client->stateOfAmerica->name ?? ($client->state ?? '') }} {{ $client->zipcode ?: '' }}
                        <br>
                        {{ $client->country ?: 'N/A' }}
                        <small>({{ $client->type_address ? 'Type: '.ucfirst($client->type_address) : '' }})</small>
                    </td>
                </tr>
                @if($client->m_address_1)
                <tr>
                    <td>Mailing Address:</td>
                    <td>
                        {{ $client->m_address_1 ?: '' }}
                        @if($client->m_address_2)<br>{{ $client->m_address_2 }}@endif
                        <br>
                        {{ $client->m_city ? $client->m_city . ', ' : '' }}
                        {{ $client->m_state ? (StateOfAmerica::find($client->m_state)->name ?? $client->m_state) : '' }} {{ $client->m_zipcode ?: '' }}
                    </td>
                </tr>
                @endif

                <tr><td colspan="2" style="background-color: var(--tlp-accent-color); color: white; font-weight:bold; text-align:center;">Marital Information</td></tr>
                @if($client->marital_status)
                <tr><td>Marital Status:</td><td>{{ ucfirst(str_replace('_', ' ', $client->marital_status)) }}</td></tr>
                <tr><td>Date of Marital Status:</td><td>{{ $client->marital_date ? \Carbon\Carbon::parse($client->marital_date)->format('m/d/Y') : 'N/A' }}</td></tr>
                    @if(!in_array($client->marital_status, ['single', 'divorced', 'widowed', 'legally_separated', 'unknown', '']))
                    <tr><td>Spouse Full Name:</td><td>{{ $client->spouse_first_name ?: '' }} {{ $client->spouse_mi ? $client->spouse_mi.'. ' : '' }}{{ $client->spouse_last_name ?: '' }}</td></tr>
                    <tr><td>Spouse SSN:</td><td>{{ $client->spouse_ssn ?: 'N/A' }}</td></tr>
                    <tr><td>Spouse Date of Birth:</td><td>{{ $client->spouse_date_birdth ? \Carbon\Carbon::parse($client->spouse_date_birdth)->format('m/d/Y') : 'N/A' }}</td></tr>
                    <tr><td>Spouse Email:</td><td>{{ $client->spouse_email ?: 'N/A' }}</td></tr>
                    <tr><td>Spouse Phone (Cell):</td><td>{{ $client->spouse_cell_home ?: 'N/A' }}</td></tr>
                    @endif
                @else
                <tr><td>Marital Status:</td><td>N/A</td></tr>
                @endif
            </table>
        </div>

        {{-- SECCIÓN: TAX LIABILITY SUMMARY --}}
        <div class="section">
            <h2>Tax Liability Summary (Based on Available Account Transcripts)</h2>
            @php
                $liabilityDataFromTranscripts = [];
                $hasAnyActualLiabilityData = false; // Tracks if any transcript year has non-zero monetary values
                $transcriptYears = []; // Collect actual years from transcripts

                if (!empty($accountTranscripts)) {
                    foreach ($accountTranscripts as $transcript) {
                        if (isset($transcript['tax_year']) && is_numeric($transcript['tax_year'])) {
                            $year = (int)$transcript['tax_year'];
                            $transcriptYears[] = $year; // Store this year

                            $accountBalance = floatval(str_replace([',','$'], '', $transcript['account_balance'] ?? 0));
                            $accruedInterest = floatval(str_replace([',','$'], '', $transcript['accrued_interest'] ?? 0));
                            $accruedPenalty = floatval(str_replace([',','$'], '', $transcript['accrued_penalty'] ?? 0));
                            $totalOwed = 0;

                            if (isset($transcript['account_balance_plus_accruals'])) {
                                $totalOwed = floatval(str_replace([',','$'], '', $transcript['account_balance_plus_accruals']));
                            } else {
                                $totalOwed = $accountBalance + $accruedInterest + $accruedPenalty;
                            }

                            $liabilityDataFromTranscripts[$year] = [
                                'account_balance' => $accountBalance,
                                'accrued_interest' => $accruedInterest,
                                'accrued_penalty' => $accruedPenalty,
                                'total_owed' => $totalOwed,
                            ];

                            // Check if this year has any actual monetary value
                            if ($accountBalance != 0 || $accruedInterest != 0 || $accruedPenalty != 0 || $totalOwed != 0) {
                                $hasAnyActualLiabilityData = true;
                            }
                        }
                    }
                }

                // Determine the year from $reportGeneratedDate to calculate the 10-year range
                // Ensure $reportGeneratedDate is available in your view.
                $reportDateCarbon = \Carbon\Carbon::parse($reportGeneratedDate);
                $currentCalendarYear = (int)$reportDateCarbon->year;

                $lastTenYears = [];
                for ($i = 0; $i < 10; $i++) {
                    $lastTenYears[] = $currentCalendarYear - $i;
                }

                // Combine transcript years and last ten years, then sort unique descending
                $allDisplayYears = array_unique(array_merge($transcriptYears, $lastTenYears));
                rsort($allDisplayYears); // Sorts numerically: e.g., 2025, 2024, ..., 2016, then 2013 if present

                $finalLiabilityDisplayData = [];
                foreach ($allDisplayYears as $year) {
                    if (isset($liabilityDataFromTranscripts[$year])) {
                        $finalLiabilityDisplayData[$year] = $liabilityDataFromTranscripts[$year];
                    } else {
                        // For years in the 10-year range but not in transcripts, or other specified years without data
                        $finalLiabilityDisplayData[$year] = [
                            'account_balance' => 0,
                            'accrued_interest' => 0,
                            'accrued_penalty' => 0,
                            'total_owed' => 0,
                        ];
                    }
                }
            @endphp

            @if(!empty($finalLiabilityDisplayData))
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>Tax Year</th>
                            <th>Account Balance</th>
                            <th>Accrued Interest</th>
                            <th>Accrued Penalty</th>
                            <th>Total Owed (Est.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finalLiabilityDisplayData as $year => $data)
                            <tr>
                                <td style="text-align:left;">{{ $year }}</td>
                                <td>${{ number_format($data['account_balance'], 2) }}</td>
                                <td>${{ number_format($data['accrued_interest'], 2) }}</td>
                                <td>${{ number_format($data['accrued_penalty'], 2) }}</td>
                                <td><strong>${{ number_format($data['total_owed'], 2) }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Conditional messages based on data availability --}}
                @if(empty($accountTranscripts))
                    {{-- This means no transcript files were processed at all. --}}
                    <p class="no-data">No account transcript data was provided. The table displays the last 10 years (and any other relevant years if specified by other logic) as empty.</p>
                @elseif(!$hasAnyActualLiabilityData)
                    {{-- This means transcript files were processed, but all of them showed zero monetary values. --}}
                    <p class="no-data">No outstanding liabilities found in the available account transcripts. Years without transcript data within the displayed range are shown as empty.</p>
                @endif
                {{-- If $hasAnyActualLiabilityData is true and $accountTranscripts is not empty, it means there is data to show, so no specific "no data" message is needed here. --}}

            @else
                {{-- This case should ideally not be reached if $finalLiabilityDisplayData is always populated (e.g., with last 10 years). --}}
                <p class="no-data">No tax liability data available to display. This might indicate an issue with data processing or an empty set of years to display.</p>
            @endif
            <p style="font-size: 9px; text-align: center; margin-top: 10px;">
                * Amounts based on available Account Transcripts. Accrued interest and penalty are as of the date specified in the transcript, if available.
            </p>
        </div>


        @if($client->dependents && $client->dependents->whereNotNull('first_name')->count() > 0)
        <div class="section">
            <h2>Dependents</h2>
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Relationship</th>
                        <th>SSN</th>
                        <th>Date of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($client->dependents->whereNotNull('first_name') as $dependent)
                    <tr>
                        <td>{{ $dependent->first_name }} {{ $dependent->last_name }}</td>
                        <td>{{ $dependent->relationship ?: 'N/A' }}</td>
                        <td>{{ $dependent->ssn ?: 'N/A' }}</td>
                        <td>{{ $dependent->date_of_birth ? \Carbon\Carbon::parse($dependent->date_of_birth)->format('m/d/Y') : 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="page-break"></div>

        @if(($client->employment && $client->employment->whereNotNull('employer_name')->count() > 0) || ($client->employment_spouse && $client->employment_spouse->whereNotNull('employer_name_spouse')->count() > 0))
        <div class="section">
            <h2>Employment Information</h2>
            @if($client->employment && $client->employment->whereNotNull('employer_name')->count() > 0)
                <div class="sub-section">
                    <h4>Taxpayer Employment</h4>
                    @foreach($client->employment->whereNotNull('employer_name') as $emp)
                        <table class="profile-table">
                            <tr><td>Employer:</td><td>{{ $emp->employer_name ?: 'N/A' }}</td></tr>
                            <tr><td>Occupation:</td><td>{{ $emp->occupation ?: 'N/A' }}</td></tr>
                            <tr><td>Employment Type:</td><td>{{ $emp->type_of_employment ?: 'N/A' }}</td></tr>
                            <tr><td>Dates:</td><td>From: {{ $emp->date_of_employment_from ? \Carbon\Carbon::parse($emp->date_of_employment_from)->format('m/d/Y') : 'N/A' }} To: {{ $emp->date_of_employment_to ? \Carbon\Carbon::parse($emp->date_of_employment_to)->format('m/d/Y') : 'Current' }}</td></tr>
                            <tr><td>Pay Period:</td><td>{{ $emp->payPeriod->name ?? ($emp->pay_period ?: 'N/A') }}</td></tr>
                            <tr><td>Gross Income:</td><td>${{ number_format(floatval($emp->gross_income ?? 0), 2) }}</td></tr>
                        </table>
                    @endforeach
                </div>
            @endif

            @if($client->employment_spouse && $client->employment_spouse->whereNotNull('employer_name_spouse')->count() > 0)
                <div class="sub-section">
                    <h4>Spouse Employment</h4>
                     @foreach($client->employment_spouse->whereNotNull('employer_name_spouse') as $empSpouse)
                        <table class="profile-table">
                            <tr><td>Employer:</td><td>{{ $empSpouse->employer_name_spouse ?: 'N/A' }}</td></tr>
                            <tr><td>Occupation:</td><td>{{ $empSpouse->occupation_spouse ?: 'N/A' }}</td></tr>
                            <tr><td>Employment Type:</td><td>{{ $empSpouse->type_of_employment_spouse ?: 'N/A' }}</td></tr>
                            <tr><td>Dates:</td><td>From: {{ $empSpouse->date_of_employment_from_spouse ? \Carbon\Carbon::parse($empSpouse->date_of_employment_from_spouse)->format('m/d/Y') : 'N/A' }} To: {{ $empSpouse->date_of_employment_to_spouse ? \Carbon\Carbon::parse($empSpouse->date_of_employment_to_spouse)->format('m/d/Y') : 'Current' }}</td></tr>
                            <tr><td>Pay Period:</td><td>{{ $empSpouse->payPeriod->name ?? ($empSpouse->pay_period_spouse ?: 'N/A') }}</td></tr>
                            <tr><td>Gross Income:</td><td>${{ number_format(floatval($empSpouse->gross_income_spouse ?? 0), 2) }}</td></tr>
                        </table>
                    @endforeach
                </div>
            @endif
        </div>
        @endif

        <div class="section">
            <h2>Account Transcripts Summary (Detailed by Year)</h2>
            @if(!empty($accountTranscripts))
                @foreach($accountTranscripts as $transcript)
                    <div class="transcript-block">
                        <h3>Account Transcript - Tax Year: {{ $transcript['tax_year'] ?? 'N/A' }}
                            <small style="float:right;">(File: {{ Illuminate\Support\Str::limit($transcript['source_filename'] ?? 'N/A', 30) }})</small>
                        </h3>
                        <p class="transcript-summary"><strong>Taxpayer Name:</strong> {{ $transcript['taxpayer_name'] ?? 'N/A' }}</p>
                        <p class="transcript-summary"><strong>TIN:</strong> {{ $transcript['taxpayer_identification_number'] ?? 'N/A' }}</p>
                        <p class="transcript-summary"><strong>Form Number:</strong> {{ $transcript['form_number'] ?? 'N/A' }}</p>
                        <p class="transcript-summary"><strong>Filing Status:</strong> {{ $transcript['filing_status'] ?? 'N/A' }}</p>
                        <p class="transcript-summary"><strong>Account Balance:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['account_balance'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Accrued Interest:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['accrued_interest'] ?? 0)), 2) }} (as of {{ $transcript['accrued_interest_as_of_date'] ?? 'N/A' }})</p>
                        <p class="transcript-summary"><strong>Accrued Penalty:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['accrued_penalty'] ?? 0)), 2) }} (as of {{ $transcript['accrued_penalty_as_of_date'] ?? 'N/A' }})</p>
                        <p class="transcript-summary"><strong>Balance Plus Accruals:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['account_balance_plus_accruals'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>AGI:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['adjusted_gross_income'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Taxable Income:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['taxable_income'] ?? 0)), 2) }}</p>

                        @if(!empty($transcript['transactions']))
                            <h4>Transactions ({{ count($transcript['transactions']) }}):</h4>
                            <table>
                                <col style="width:10%;">
                                <col style="width:55%;">
                                <col style="width:15%;">
                                <col style="width:20%;">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Explanation</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($transcript['transactions'] as $tx)
                                    <tr>
                                        <td>{{ $tx['code'] ?? 'N/A' }}</td>
                                        <td>
                                            {{ $tx['explanation'] ?? 'N/A' }}
                                            @if(!empty($tx['supplemental_info']))
                                                @foreach($tx['supplemental_info'] as $info)
                                                    <br><small style="color: #555;"><em>- {{ $info }}</em></small>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $tx['date'] ?? 'N/A' }}</td>
                                        <td>${{ number_format(floatval(str_replace([',','$'], '', $tx['amount'] ?? 0)), 2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="no-data">No transaction details found for this year.</p>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="no-data">No Account Transcripts data available for this client.</p>
            @endif
        </div>


        <div class="section">
            <h2>Tax Return Transcripts Summary (Detailed by Year)</h2>
            @if(!empty($taxReturnTranscripts))
                @foreach($taxReturnTranscripts as $transcript)
                     <div class="transcript-block">
                        <h3>Tax Return Transcript - Tax Year: {{ $transcript['tax_year'] ?? 'N/A' }}
                            <small style="float:right;">(File: {{ Illuminate\Support\Str::limit($transcript['source_filename'] ?? 'N/A', 30) }})</small>
                        </h3>
                        <p class="transcript-summary"><strong>SSN:</strong> {{ $transcript['ssn'] ?? 'N/A' }}</p>
                        @if(isset($transcript['spouse_ssn']) && $transcript['spouse_ssn'])
                        <p class="transcript-summary"><strong>Spouse SSN:</strong> {{ $transcript['spouse_ssn'] }}</p>
                        @endif
                        <p class="transcript-summary"><strong>Name(s) on Return:</strong> {{ $transcript['names_on_return'] ?? 'N/A' }}</p>
                        <p class="transcript-summary"><strong>Filing Status:</strong> {{ $transcript['filing_status'] ?? 'N/A' }}</p>
                        <p class="transcript-summary"><strong>Total Income:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['total_income'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Adjusted Gross Income (AGI):</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['adjusted_gross_income'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Taxable Income:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['taxable_income'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Total Tax:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['total_tax'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Total Payments:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['total_payments'] ?? 0)), 2) }}</p>
                        <p class="transcript-summary"><strong>Balance Due/Overpayment:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['balance_due_or_overpayment'] ?? 0)), 2) }}</p>

                        @if(isset($transcript['exemptions']))
                        <p class="transcript-summary"><strong>Exemptions:</strong> {{ $transcript['exemptions'] }}</p>
                        @endif
                        @if(isset($transcript['dependents_count']))
                        <p class="transcript-summary"><strong>Number of Dependents:</strong> {{ $transcript['dependents_count'] }}</p>
                        @endif
                        @if(isset($transcript['refund_amount']))
                        <p class="transcript-summary"><strong>Refund Amount:</strong> ${{ number_format(floatval(str_replace([',','$'], '', $transcript['refund_amount'] ?? 0)), 2) }}</p>
                        @endif
                         @if(isset($transcript['tax_period']))
                        <p class="transcript-summary"><strong>Tax Period:</strong> {{ $transcript['tax_period'] }}</p>
                        @endif
                        @if(isset($transcript['received_date']))
                        <p class="transcript-summary"><strong>Received Date:</strong> {{ $transcript['received_date'] }}</p>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="no-data">No Tax Return Transcripts data available for this client.</p>
            @endif
        </div>

    </div>
</body>
</html>