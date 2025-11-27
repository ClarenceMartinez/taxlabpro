{{-- resources/views/client/partials/_account_transcript_details_table.blade.php --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<style>
    /* Styles for DataTables (unchanged) */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.5em;
        padding-bottom: 0.5em;
    }
    table.dataTable td, table.dataTable th {
        vertical-align: middle;
    }

    /* Styles for the new card-based display of transcript details */
    .details-card .card-header {
        padding: 0.5rem 1rem; /* Compact header */
        background-color: #f8f9fa; /* Light background for header */
    }
    .details-card .card-body {
        padding: 0; /* Remove card body padding, items will manage their own */
    }
    .details-card .data-item {
        display: flex;
        justify-content: space-between;
        align-items: center; /* Vertically align items if they wrap */
        padding: 0.60rem 1rem; /* Padding for each key-value pair */
        border-bottom: 1px solid #dee2e6; /* Separator line */
    }
    .details-card .data-item:last-child {
        border-bottom: none; /* No border for the last item in a card */
    }
    .details-card .data-item dt {
        flex-basis: 45%; /* Adjust basis for key */
        padding-right: 0.5rem;
        font-weight: 500; 
        color: #495057; /* Slightly darker than muted for keys */
        white-space: normal; /* Allow keys to wrap */
        margin-bottom: 0; /* Reset dl/dt default margin */
    }
    .details-card .data-item dd {
        flex-basis: 55%; /* Adjust basis for value */
        margin-bottom: 0; /* Reset dl/dd default margin */
        text-align: right;
        word-break: break-word; /* Prevent long values from breaking layout */
    }
    .text-danger { color: #dc3545 !important; }
    .text-success { color: #198754 !important; }
    .fw-bold { font-weight: 600 !important; } /* Slightly bolder for emphasis */
</style>

@php
    // Prepare data from $transcript, ensuring numeric values are floats or null
    $transcriptData = [
        'Request Date' => $transcript['request_date'] ?? null,
        'Response Date' => $transcript['response_date'] ?? null,
        'Tracking Number' => $transcript['tracking_number'] ?? null,
        'Form Number' => $transcript['form_number'] ?? null,
        'Taxpayer Identification Number' => $transcript['taxpayer_identification_number'] ?? null,
        'Taxpayer Name' => $transcript['taxpayer_name'] ?? null,
        'Account Balance' => isset($transcript['account_balance']) ? (float)$transcript['account_balance'] : null,
        'Accrued Interest' => isset($transcript['accrued_interest']) ? (float)$transcript['accrued_interest'] : null,
        'Accrued Interest As Of Date' => $transcript['accrued_interest_as_of_date'] ?? null,
        'Accrued Penalty' => isset($transcript['accrued_penalty']) ? (float)$transcript['accrued_penalty'] : null,
        'Accrued Penalty As Of Date' => $transcript['accrued_penalty_as_of_date'] ?? null,
        'Account Balance Plus Accruals' => isset($transcript['account_balance_plus_accruals']) ? (float)$transcript['account_balance_plus_accruals'] : null,
        'Exemptions' => $transcript['exemptions'] ?? null,
        'Filing Status' => $transcript['filing_status'] ?? null,
        'Adjusted Gross Income' => isset($transcript['adjusted_gross_income']) ? (float)$transcript['adjusted_gross_income'] : null,
        'Taxable Income' => isset($transcript['taxable_income']) ? (float)$transcript['taxable_income'] : null,
        'Tax Per Return' => isset($transcript['tax_per_return']) ? (float)$transcript['tax_per_return'] : null,
        'SE Taxable Income (Taxpayer)' => isset($transcript['se_taxable_income_taxpayer']) ? (float)$transcript['se_taxable_income_taxpayer'] : null,
        'SE Taxable Income (Spouse)' => isset($transcript['se_taxable_income_spouse']) ? (float)$transcript['se_taxable_income_spouse'] : null,
        'Total Self Employment Tax' => isset($transcript['total_self_employment_tax']) ? (float)$transcript['total_self_employment_tax'] : null,
        'Return Due Date or Received Date' => $transcript['return_due_date_or_received_date'] ?? null,
        'Processing Date' => $transcript['processing_date'] ?? null,
    ];

    // Define sections and the order of fields within them
    $sections = [
        'Summary' => [
            'Account Balance Plus Accruals', 'Account Balance', 'Accrued Interest', 'Accrued Penalty',
        ],
        'Taxpayer Info' => [
            'Taxpayer Name', 'Taxpayer Identification Number', 'Form Number', 'Filing Status', 'Exemptions',
        ],
        'Income / Tax' => [
            'Adjusted Gross Income', 'Taxable Income', 'Tax Per Return', 'Total Self Employment Tax', 'SE Taxable Income (Taxpayer)', 'SE Taxable Income (Spouse)',
        ],
        'Tracking' => [
            'Processing Date', 'Return Due Date or Received Date', 'Request Date', 'Response Date', 'Tracking Number',
        ]
    ];

    $monetary_fields = ['Account Balance', 'Accrued Interest', 'Accrued Penalty', 'Account Balance Plus Accruals', 'Adjusted Gross Income', 'Taxable Income', 'Tax Per Return', 'SE Taxable Income (Taxpayer)', 'SE Taxable Income (Spouse)', 'Total Self Employment Tax'];
    $liability_fields = ['Account Balance', 'Accrued Interest', 'Accrued Penalty', 'Account Balance Plus Accruals'];
    $show_zero_value_fields = ['Accrued Penalty']; // Fields that must be shown even if $0.00

    // Helper function to format monetary values
    if (!function_exists('format_transcript_monetary_value')) {
        function format_transcript_monetary_value($value, $is_liability = true, $as_of_date = null) {
            $date_suffix_html = '';
            if ($as_of_date) {
                $date_suffix_html = ' <small class="text-muted">(as of ' . htmlspecialchars($as_of_date) . ')</small>';
            }

            if ($value === null) {
                return 'N/A' . $date_suffix_html;
            }

            $formattedValue = '$' . number_format(abs($value), 2);
            $class = '';
            $suffix = '';

            if ($is_liability) {
                if ($value > 0) $class = 'text-danger fw-bold';
                elseif ($value < 0) { $class = 'text-success fw-bold'; $suffix = ' CR'; }
                else $class = 'fw-bold'; // $0.00 liability
            } else { // Non-liability monetary values
                if ($value != 0) $class = 'fw-bold';
                else return '$0.00' . $date_suffix_html; // Plain $0.00 for non-liability
            }
            return '<span class="' . $class . '">' . $formattedValue . $suffix . '</span>' . $date_suffix_html;
        }
    }
@endphp

{{-- MODIFICATION START: New layout for the first table's information --}}
<div class="row g-3"> {{-- g-3 for gutters between cards --}}
@foreach($sections as $sectionTitle => $fields)
    @php
        $sectionItemsHtml = '';
        $itemCountInSection = 0;

        foreach ($fields as $key) {
            $rawValue = $transcriptData[$key] ?? null;
            $asOfDate = null;
            if ($key === 'Accrued Interest') $asOfDate = $transcriptData['Accrued Interest As Of Date'] ?? null;
            if ($key === 'Accrued Penalty') $asOfDate = $transcriptData['Accrued Penalty As Of Date'] ?? null;

            $displayField = true;

            if ($key === 'SE Taxable Income (Spouse)' && ($rawValue === null || $rawValue == 0)) {
                $displayField = false;
            } elseif ($key === 'Taxpayer Identification Number' && ($rawValue === null || $rawValue === 'N/A' || trim((string)$rawValue) === '')) {
                $displayField = false;
            } elseif ($rawValue === null && !(in_array($key, ['Accrued Interest', 'Accrued Penalty']) && $asOfDate)) {
                $displayField = false;
            } elseif ($rawValue === 'N/A' || (is_string($rawValue) && trim($rawValue) === '')) {
                $displayField = false;
            }


            if ($displayField) {
                $finalFormattedValue = 'N/A';
                if (in_array($key, $monetary_fields)) {
                    $isLiability = in_array($key, $liability_fields);
                    $finalFormattedValue = format_transcript_monetary_value($rawValue, $isLiability, $asOfDate);
                } elseif ($rawValue !== null) { // Handles non-monetary string values
                    $finalFormattedValue = htmlspecialchars((string)$rawValue);
                }

                // Post-formatting checks for hiding
                if (str_starts_with($finalFormattedValue, 'N/A') && !(in_array($key, ['Accrued Interest', 'Accrued Penalty']) && $asOfDate && $rawValue === null) ){ // Hide N/A unless it's an accrual N/A with a date
                    $displayField = false;
                } elseif (str_starts_with($finalFormattedValue, '$0.00') && !in_array($key, $show_zero_value_fields) && !(in_array($key, $liability_fields) && $rawValue === 0.0) ) {
                    // Hide $0.00 if not a special field or a zero-value liability
                     $is_zero_liability_with_date = (in_array($key, $liability_fields) && $rawValue === 0.0 && $asOfDate);
                     if (!$is_zero_liability_with_date) { // Don't hide $0.00 (as of date) for liabilities
                        $displayField = false;
                     }
                }
            }

            if ($displayField) {
                $sectionItemsHtml .= '<div class="data-item"><dt>' . htmlspecialchars($key) . '</dt><dd>' . $finalFormattedValue . '</dd></div>';
                $itemCountInSection++;
            }
        }
    @endphp

    @if($itemCountInSection > 0)
    <div class="col-lg-6"> {{-- Two columns on large screens, stack on smaller --}}
        <div class="card details-card h-100"> {{-- h-100 for equal height cards in a row --}}
            <div class="card-header">
                <h6 class="mb-0">{{ htmlspecialchars($sectionTitle) }}</h6>
            </div>
            <div class="card-body">
                <dl class="mb-0"> {{-- Using dl for semantics, styled by .data-item divs --}}
                    {!! $sectionItemsHtml !!}
                </dl>
            </div>
        </div>
    </div>
    @endif
@endforeach
</div>
{{-- MODIFICATION END --}}


@if(!empty($transcript['transactions']))
    <h6 class="mt-4 mb-2 ps-1">Transactions:</h6>
    <div class="table-responsive">
        <table id="accountTransactionsTable_{{ $transcript['file_id'] ?? rand() }}" class="table table-sm table-bordered table-hover table-compact-transcripts" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Explanation</th>
                    <th scope="col">Cycle</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transcript['transactions'] as $transaction)
                    @php
                        $sortableDate = $transaction['date'] ?? '';
                        if (!empty($transaction['date']) && $transaction['date'] !== 'N/A') {
                            try {
                                $dateObject = \Carbon\Carbon::createFromFormat('m-d-Y', $transaction['date']);
                                if ($dateObject) {
                                    $sortableDate = $dateObject->format('Y-m-d');
                                }
                            } catch (\Exception $e) {
                                $sortableDate = '0000-00-00'; // Fallback for unparseable dates
                            }
                        } elseif (empty($transaction['date'])) {
                            $sortableDate = '';
                        }
                    @endphp
                    <tr>
                        <td data-label="Code">{{ $transaction['code'] }}</td>
                        <td data-label="Explanation">
                            {!! nl2br(e($transaction['explanation'])) !!}
                            @if(!empty($transaction['supplemental_info']))
                                <ul class="list-unstyled mb-0 ps-3 mt-1">
                                    @foreach($transaction['supplemental_info'] as $info)
                                        <li><small class="text-muted"><em>↳ {{ $info }}</em></small></li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td data-label="Cycle">{{ $transaction['cycle'] ?? '' }}</td>
                        <td data-label="Date" data-sort="{{ $sortableDate }}">{{ $transaction['date'] ?? 'N/A' }}</td>
                        <td data-label="Amount" class="text-end" data-sort="{{ $transaction['amount'] ?? 0 }}">
                            @if(isset($transaction['amount']))
                                @if($transaction['amount'] < 0)
                                    <span class="text-success">${{ number_format(abs($transaction['amount']), 2) }} CR</span>
                                @elseif($transaction['amount'] > 0)
                                    <span class="text-danger">${{ number_format($transaction['amount'], 2) }}</span>
                                @else
                                    ${{ number_format($transaction['amount'], 2) }}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="ps-1">No transactions found for this period.</p>
@endif

@if(!empty($transcript['transactions']))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableId = '#accountTransactionsTable_{{ $transcript['file_id'] ?? rand() }}';
        // Initialize only if not already a DataTable instance to prevent errors on multiple loads/ajax updates
        if (!$.fn.DataTable.isDataTable(tableId)) {
            $(tableId).DataTable({
                "responsive": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "paging": true,
                "pageLength": 25,
                "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                "order": [[ 3, "desc" ]], // Default sort: Date column (index 3), descending
                "columnDefs": [
                    { "targets": [1], "orderable": false }, // 'Explanation' non-sortable
                    { "type": "num", "targets": [0, 2] },   // 'Code' and 'Cycle' as numeric
                    { "type": "date", "targets": [3] },    // 'Date' as date type
                    { "type": "num-fmt", "targets": [4] }  // 'Amount' as formatted number
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search transactions...",
                    "lengthMenu": "Show _MENU_ entries"
                }
            });
        }
    });
</script>
@endif