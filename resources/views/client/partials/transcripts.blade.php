{{-- transcripts.blade.php --}}

@php
    // Determine if there is any transcript available in total
    $hasTaxReturnTranscripts = (!empty($taxReturnTranscripts) && count($taxReturnTranscripts) > 0);
    $hasAccountTranscripts = (!empty($accountTranscripts) && count($accountTranscripts) > 0);
    $allTranscriptsAvailable = $hasTaxReturnTranscripts || $hasAccountTranscripts;

    // Determine which tab should be active by default
    $defaultActiveTab = '';
    if ($hasAccountTranscripts) {
        $defaultActiveTab = 'account';
    } elseif ($hasTaxReturnTranscripts) {
        $defaultActiveTab = 'tax_return';
    }

    // Prepare data for Tax Return Charts
    $taxReturnYears = [];
    $taxableIncomes = [];
    $totalTaxLiabilities = [];
    $totalPaymentsMadeTR = [];
    $balanceDueOverpayments = [];

    if ($hasTaxReturnTranscripts) {
        $sortedTaxReturnTranscripts = collect($taxReturnTranscripts)->sortBy('tax_year')->values()->all();
        foreach ($sortedTaxReturnTranscripts as $tr) {
            $taxReturnYears[] = $tr['tax_year'] ?? 'Unknown Year';
            $taxableIncomes[] = (float)($tr['taxable_income'] ?? 0);
            $totalTaxLiabilities[] = (float)($tr['total_tax'] ?? 0);
            $totalPaymentsMadeTR[] = (float)($tr['total_payments'] ?? 0);
            $balanceDueOverpayments[] = (float)($tr['balance_due_or_overpayment'] ?? 0);
        }
    }

    // Prepare data for Account Transcript Summary & Charts
    $summary_acct_for_chart = [
        'labels' => [],
        'data' => [],
    ];
    $summary_acct = [
        'total_balance_plus_accruals' => 0,
        'total_account_balance' => 0,
        'total_accrued_interest' => 0,
        'total_accrued_penalty' => 0,
    ];
    if ($hasAccountTranscripts) {
        foreach($accountTranscripts as $t) {
            $summary_acct['total_balance_plus_accruals'] += (float)($t['account_balance_plus_accruals'] ?? 0);
            $summary_acct['total_account_balance'] += (float)($t['account_balance'] ?? 0);
            $summary_acct['total_accrued_interest'] += (float)($t['accrued_interest'] ?? 0);
            $summary_acct['total_accrued_penalty'] += (float)($t['accrued_penalty'] ?? 0);
        }
        if ($summary_acct['total_account_balance'] > 0 || $summary_acct['total_balance_plus_accruals'] > 0) { // Include if total is > 0 even if components are 0 for now
            $summary_acct_for_chart['labels'][] = 'Account Balance';
            $summary_acct_for_chart['data'][] = $summary_acct['total_account_balance'];
        }
        if ($summary_acct['total_accrued_interest'] > 0 || $summary_acct['total_balance_plus_accruals'] > 0) {
            $summary_acct_for_chart['labels'][] = 'Accrued Interest';
            $summary_acct_for_chart['data'][] = $summary_acct['total_accrued_interest'];
        }
        if ($summary_acct['total_accrued_penalty'] > 0 || $summary_acct['total_balance_plus_accruals'] > 0) {
            $summary_acct_for_chart['labels'][] = 'Accrued Penalty';
            $summary_acct_for_chart['data'][] = $summary_acct['total_accrued_penalty'];
        }
        // Ensure there's at least one item if total is zero to prevent chart errors with empty data.
        if (empty($summary_acct_for_chart['data']) && $summary_acct['total_balance_plus_accruals'] == 0 && count($accountTranscripts) > 0) {
            // If all values are zero but transcripts exist, show a "Zero Balance" segment for pie, or handle bar chart appropriately
            $summary_acct_for_chart['labels'] = ['Zero Balance'];
            $summary_acct_for_chart['data'] = [0]; // Chart.js can handle a single 0 value for pie, bar will show 0.
        }
    }
@endphp


@if($allTranscriptsAvailable)
    <div class="transcript-main-container mt-0">

        <ul class="nav nav-tabs corporate-tabs" id="transcriptTypeTabs" role="tablist">
            @if($hasAccountTranscripts)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($defaultActiveTab === 'account') active @endif"
                        id="account-transcript-tab" data-bs-toggle="tab" data-bs-target="#account-transcript-content"
                        type="button" role="tab" aria-controls="account-transcript-content"
                        aria-selected="{{ $defaultActiveTab === 'account' ? 'true' : 'false' }}">
                    Tax Account<span class="badge ms-1">{{ count($accountTranscripts) }}</span>
                </button>
            </li>
            @endif
            @if($hasTaxReturnTranscripts)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($defaultActiveTab === 'tax_return') active @endif"
                        id="tax-return-tab" data-bs-toggle="tab" data-bs-target="#tax-return-content"
                        type="button" role="tab" aria-controls="tax-return-content"
                        aria-selected="{{ $defaultActiveTab === 'tax_return' ? 'true' : 'false' }}">
                    Tax Returns <span class="badge ms-1">{{ count($taxReturnTranscripts) }}</span>
                </button>
            </li>
            @endif
        </ul>

        <div class="tab-content corporate-tab-content" id="transcriptTypeTabContent">
            {{-- ############ TAX RETURN TRANSCRIPTS TAB ############ --}}
            @if($hasTaxReturnTranscripts)
            <div class="tab-pane fade @if($defaultActiveTab === 'tax_return') show active @endif"
                 id="tax-return-content" role="tabpanel" aria-labelledby="tax-return-tab">
                <div class="transcript-container mt-2">
                    @php
                        $summary_tr_display = [
                            'total_amount_owed' => 0,
                            'total_taxable_income' => 0,
                            'total_tax_liability' => 0,
                            'total_payments_made' => 0,
                        ];
                        foreach($taxReturnTranscripts as $t) {
                            if (isset($t['balance_due_or_overpayment']) && $t['balance_due_or_overpayment'] > 0) {
                                $summary_tr_display['total_amount_owed'] += (float)($t['balance_due_or_overpayment'] ?? 0);
                            }
                            $summary_tr_display['total_taxable_income'] += (float)($t['taxable_income'] ?? 0);
                            $summary_tr_display['total_tax_liability'] += (float)($t['total_tax'] ?? 0);
                            $summary_tr_display['total_payments_made'] += (float)($t['total_payments'] ?? 0);
                        }
                    @endphp
                    <div class="card mb-2 shadow-sm summary-card-container">
                        <div class="card-body p-2">
                            <div class="row g-2 summary-items-row">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL TAXABLE INCOME</small>
                                        <span class="fw-bold summary-item-value value-income">${{ number_format($summary_tr_display['total_taxable_income'], 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL TAX LIABILITY</small>
                                        <span class="fw-bold summary-item-value value-tax">${{ number_format($summary_tr_display['total_tax_liability'], 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL PAYMENTS MADE</small>
                                        <span class="fw-bold summary-item-value value-payment">${{ number_format($summary_tr_display['total_payments_made'], 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL AMOUNT OWED</small>
                                        <span class="fw-bold summary-item-value value-owed">${{ number_format($summary_tr_display['total_amount_owed'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($taxReturnTranscripts) > 0)
                    <div class="charts-container mt-3 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-7 mb-3 mb-lg-0">
                                        <div class="chart-wrapper" style="height: 220px;">
                                            <canvas id="taxReturnComparisonChart"></canvas>
                                        </div>
                                        <p class="text-center text-muted small mt-1 mb-0">Income, Liability & Payments by Year</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="chart-wrapper" style="height: 220px;">
                                            <canvas id="taxReturnBalanceTrendChart"></canvas>
                                        </div>
                                        <p class="text-center text-muted small mt-1 mb-0">Balance Due / Overpayment Trend</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(count($taxReturnTranscripts) > 1)
                        <div class="icon-tabs-container mb-0 tabs-outer-container">
                            <ul class="nav icon-tabs" id="taxReturnFileTabs" role="tablist">
                                @foreach($taxReturnTranscripts as $index => $transcript)
                                    @php
                                        $fullFilenameForTab = basename($transcript['source_filename']);
                                        $filenameWithoutExtForTab = pathinfo($fullFilenameForTab, PATHINFO_FILENAME);
                                        $tabDisplayName = 'TY'.$transcript['tax_year'] . ' (' . Str::limit($filenameWithoutExtForTab, 12) . ')';
                                        $uniqueFileId = 'tr-' . $transcript['file_id'];
                                    @endphp
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if($loop->first) active @endif"
                                                id="tab-{{ $uniqueFileId }}"
                                                data-bs-toggle="tab"
                                                data-bs-target="#content-{{ $uniqueFileId }}"
                                                type="button" role="tab"
                                                aria-controls="content-{{ $uniqueFileId }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <div class="tab-icon"><i class="ri-file-text-line"></i></div>
                                            <div class="tab-text-content">
                                                <span class="tab-filename" title="{{ $fullFilenameForTab }}">{{ $tabDisplayName }}</span>
                                            </div>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content" id="taxReturnFileTabContent">
                            @foreach($taxReturnTranscripts as $index => $transcript)
                             @php $uniqueFileId = 'tr-' . $transcript['file_id']; @endphp
                                <div class="tab-pane fade @if($loop->first) show active @else fade @endif" id="content-{{ $uniqueFileId }}" role="tabpanel" aria-labelledby="tab-{{ $uniqueFileId }}">
                                    <div class="card shadow-sm rounded-0 rounded-bottom transcript-details-card-container">
                                        <div class="card-header transcript-card-header"
                                             id="header-{{ $uniqueFileId }}"
                                             data-bs-toggle="collapse"
                                             data-bs-target="#collapse-{{ $uniqueFileId }}"
                                             aria-expanded="true" {{-- EXPANDED BY DEFAULT --}}
                                             aria-controls="collapse-{{ $uniqueFileId }}">
                                            <div class="transcript-info-header">
                                                <h6 class="mb-0 transcript-card-title">
                                                    Tax Year {{ $transcript['tax_year'] }}
                                                    <small class="text-muted transcript-filename-header">({{ basename($transcript['source_filename']) }})</small>
                                                </h6>
                                            </div>
                                            <div class="header-actions">
                                                <a href="{{ url('/clients/files/' . $transcript['file_id'] . '/view') }}" target="_blank" class="btn btn-xs btn-outline-primary view-transcript-btn" onclick="event.stopPropagation();">
                                                    <i class="ri-eye-line"></i> <span class="view-transcript-btn-text">View Original</span>
                                                </a>
                                                <span class="collapse-indicator ms-2">
                                                    <i class="ri-arrow-down-s-line"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="collapse show" id="collapse-{{ $uniqueFileId }}" aria-labelledby="header-{{ $uniqueFileId }}"> {{-- EXPANDED BY DEFAULT --}}
                                            <div class="card-body p-2">
                                                @include('client.partials._tax_return_transcript_details_table', ['transcript' => $transcript])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif(count($taxReturnTranscripts) === 1)
                        @php
                            $transcript = $taxReturnTranscripts[0];
                            $uniqueFileId = 'tr-single-' . $transcript['file_id'];
                        @endphp
                         <h6 class="text-primary small mt-3 mb-2 fw-semibold">TAX RETURN DETAILS</h6>
                        <div class="card shadow-sm transcript-details-card-container">
                             <div class="card-header transcript-card-header"
                                  id="header-{{ $uniqueFileId }}"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#collapse-{{ $uniqueFileId }}"
                                  aria-expanded="true"
                                  aria-controls="collapse-{{ $uniqueFileId }}">
                                <div class="transcript-info-header">
                                     <h6 class="mb-0 transcript-card-title">
                                        Tax Year {{ $transcript['tax_year'] }}
                                        <small class="text-muted transcript-filename-header">({{ basename($transcript['source_filename']) }})</small>
                                    </h6>
                                </div>
                                <div class="header-actions">
                                    <a href="{{ url('/clients/files/' . $transcript['file_id'] . '/view') }}" target="_blank" class="btn btn-xs btn-outline-primary view-transcript-btn" onclick="event.stopPropagation();">
                                        <i class="ri-eye-line"></i> <span class="view-transcript-btn-text">View Original</span>
                                    </a>
                                    <span class="collapse-indicator ms-2">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="collapse show" id="collapse-{{ $uniqueFileId }}" aria-labelledby="header-{{ $uniqueFileId }}">
                                <div class="card-body p-2">
                                    @include('client.partials._tax_return_transcript_details_table', ['transcript' => $transcript])
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- ############ ACCOUNT TRANSCRIPTS TAB ############ --}}
            @if($hasAccountTranscripts)
            <div class="tab-pane fade @if($defaultActiveTab === 'account') show active @endif"
                 id="account-transcript-content" role="tabpanel" aria-labelledby="account-transcript-tab">
                 <div class="transcript-container mt-2">
                    <div class="card mb-2 shadow-sm summary-card-container">
                        <div class="card-body p-2">
                            <!--<h6 class="card-title text-primary small mb-2 fw-semibold"></h6>-->
                            <div class="row g-2 summary-items-row">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL BALANCE + ACCRUALS</small>
                                        <span class="fw-bold summary-item-value value-owed">${{ number_format($summary_acct['total_balance_plus_accruals'], 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL ACCOUNT BALANCE</small>
                                        <span class="fw-bold summary-item-value">${{ number_format($summary_acct['total_account_balance'], 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL ACCRUED INTEREST</small>
                                        <span class="fw-bold summary-item-value value-interest">${{ number_format($summary_acct['total_accrued_interest'], 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-12 summary-item-col">
                                    <div class="summary-item">
                                        <small class="text-muted d-block summary-item-label">TOTAL ACCRUED PENALTY</small>
                                        <span class="fw-bold summary-item-value value-penalty">${{ number_format($summary_acct['total_accrued_penalty'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($hasAccountTranscripts && (!empty($summary_acct_for_chart['data']) || $summary_acct['total_balance_plus_accruals'] == 0) )
                    <div class="charts-container mt-3 mb-3">
                        <!--<h6 class="text-primary small mb-2 fw-semibold">ACCOUNT BALANCE COMPOSITION</h6>-->
                         <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3 mb-lg-0">
                                        <div class="chart-wrapper" style="height: 220px; max-width: 320px; margin: 0 auto;">
                                            <canvas id="accountSummaryPieChart"></canvas>
                                        </div>
                                         <p class="text-center text-muted small mt-1 mb-0">Breakdown (Doughnut)</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="chart-wrapper" style="height: 220px;">
                                            <canvas id="accountSummaryBarChart"></canvas>
                                        </div>
                                         <p class="text-center text-muted small mt-1 mb-0">Breakdown (Bar)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($hasAccountTranscripts && $summary_acct['total_balance_plus_accruals'] == 0) {{-- This case might be covered above already --}}
                     <div class="alert alert-success text-center small py-2 mt-3 mb-3" role="alert">
                        Account balances are zero. No outstanding amounts or accruals to visualize.
                    </div>
                    @endif


                    @if(count($accountTranscripts) > 1)
                        <!--<h6 class="text-primary small mt-3 mb-2 fw-semibold">INDIVIDUAL ACCOUNT TRANSCRIPT DETAILS</h6>-->
                        <div class="icon-tabs-container mb-0 tabs-outer-container">
                            <ul class="nav icon-tabs" id="accountFileTabs" role="tablist">
                                @foreach($accountTranscripts as $index => $transcript)
                                    @php
                                        $fullFilenameForTab = basename($transcript['source_filename']);
                                        $filenameWithoutExtForTab = pathinfo($fullFilenameForTab, PATHINFO_FILENAME);
                                        $tabDisplayName = 'TY'.$transcript['tax_year'] . ' (' . Str::limit($filenameWithoutExtForTab, 12) . ')';
                                        $uniqueFileId = 'acct-' . $transcript['file_id'];
                                    @endphp
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if($loop->first) active @endif"
                                                id="tab-{{ $uniqueFileId }}"
                                                data-bs-toggle="tab"
                                                data-bs-target="#content-{{ $uniqueFileId }}"
                                                type="button" role="tab"
                                                aria-controls="content-{{ $uniqueFileId }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <div class="tab-icon"><i class="ri-profile-line"></i></div>
                                            <div class="tab-text-content">
                                                <span class="tab-filename" title="{{ $fullFilenameForTab }}">{{ $tabDisplayName }}</span>
                                            </div>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content" id="accountFileTabContent">
                            @foreach($accountTranscripts as $index => $transcript)
                                @php $uniqueFileId = 'acct-' . $transcript['file_id']; @endphp
                                <div class="tab-pane fade @if($loop->first) show active @else fade @endif" id="content-{{ $uniqueFileId }}" role="tabpanel" aria-labelledby="tab-{{ $uniqueFileId }}">
                                    <div class="card shadow-sm rounded-0 rounded-bottom transcript-details-card-container">
                                        <div class="card-header transcript-card-header"
                                             id="header-{{ $uniqueFileId }}"
                                             data-bs-toggle="collapse"
                                             data-bs-target="#collapse-{{ $uniqueFileId }}"
                                             aria-expanded="true" {{-- EXPANDED BY DEFAULT --}}
                                             aria-controls="collapse-{{ $uniqueFileId }}">
                                            <div class="transcript-info-header">
                                                <h6 class="mb-0 transcript-card-title">
                                                    Tax Year {{ $transcript['tax_year'] }}
                                                    <small class="text-muted transcript-filename-header">({{ basename($transcript['source_filename']) }})</small>
                                                </h6>
                                            </div>
                                            <div class="header-actions">
                                                <a href="{{ url('/clients/files/' . $transcript['file_id'] . '/view') }}" target="_blank" class="btn btn-xs btn-outline-primary view-transcript-btn" onclick="event.stopPropagation();">
                                                    <i class="ri-eye-line"></i> <span class="view-transcript-btn-text">View Original</span>
                                                </a>
                                                <span class="collapse-indicator ms-2">
                                                    <i class="ri-arrow-down-s-line"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="collapse show" id="collapse-{{ $uniqueFileId }}" aria-labelledby="header-{{ $uniqueFileId }}"> {{-- EXPANDED BY DEFAULT --}}
                                            <div class="card-body p-2">
                                                @include('client.partials._account_transcript_details_table', ['transcript' => $transcript])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif(count($accountTranscripts) === 1)
                        @php
                            $transcript = $accountTranscripts[0];
                            $uniqueFileId = 'acct-single-' . $transcript['file_id'];
                        @endphp
                        <h6 class="text-primary small mt-3 mb-2 fw-semibold">ACCOUNT TRANSCRIPT DETAILS</h6>
                        <div class="card shadow-sm transcript-details-card-container">
                            <div class="card-header transcript-card-header"
                                  id="header-{{ $uniqueFileId }}"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#collapse-{{ $uniqueFileId }}"
                                  aria-expanded="true"
                                  aria-controls="collapse-{{ $uniqueFileId }}">
                                <div class="transcript-info-header">
                                    <h6 class="mb-0 transcript-card-title">
                                        Tax Year {{ $transcript['tax_year'] }}
                                        <small class="text-muted transcript-filename-header">({{ basename($transcript['source_filename']) }})</small>
                                    </h6>
                                </div>
                                <div class="header-actions">
                                    <a href="{{ url('/clients/files/' . $transcript['file_id'] . '/view') }}" target="_blank" class="btn btn-xs btn-outline-primary view-transcript-btn" onclick="event.stopPropagation();">
                                        <i class="ri-eye-line"></i> <span class="view-transcript-btn-text">View Original</span>
                                    </a>
                                    <span class="collapse-indicator ms-2">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="collapse show" id="collapse-{{ $uniqueFileId }}" aria-labelledby="header-{{ $uniqueFileId }}">
                                <div class="card-body p-2">
                                     @include('client.partials._account_transcript_details_table', ['transcript' => $transcript])
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
@else
    <div class="mt-2">
        <div class="alert alert-info" role="alert">
            No tax transcripts of any type found for this client.
        </div>
    </div>
@endif

<hr class="my-3">

{{-- Include Chart.js library AND Chart.js Datalabels plugin --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Register the datalabels plugin globally
    Chart.register(ChartDataLabels);

    const corporateColors = {
        blue: 'rgba(13, 110, 253, 0.8)',
        red: 'rgba(220, 53, 69, 0.8)',
        green: 'rgba(25, 135, 84, 0.8)',
        purple: 'rgba(102, 16, 242, 0.8)',
        cyan: 'rgba(13, 202, 240, 0.8)',
        orange: 'rgba(253, 126, 20, 0.8)',
        pink: 'rgba(214, 51, 132, 0.8)',
        teal: 'rgba(32, 201, 151, 0.8)',
        yellow: 'rgba(255, 193, 7, 0.8)',
    };
    const corporateBorders = {
        blue: 'rgba(13, 110, 253, 1)',
        red: 'rgba(220, 53, 69, 1)',
        green: 'rgba(25, 135, 84, 1)',
        purple: 'rgba(102, 16, 242, 1)',
        cyan: 'rgba(13, 202, 240, 1)',
        orange: 'rgba(253, 126, 20, 1)',
        pink: 'rgba(214, 51, 132, 1)',
        teal: 'rgba(32, 201, 151, 1)',
        yellow: 'rgba(255, 193, 7, 1)',
    };

    function getChartOptions(titleText = '', yAxisLabel = '', xAxisLabel = '') {
        return {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: !!yAxisLabel, text: yAxisLabel, font: { weight: '500', size: 11 }},
                    ticks: {
                        callback: function(value, index, values) {
                            if (Math.abs(value) >= 1000) {
                                return '$' + (value / 1000).toFixed(1) + 'k';
                            }
                            return '$' + value;
                        },
                        font: { size: 10 }
                    }
                },
                x: {
                    title: { display: !!xAxisLabel, text: xAxisLabel, font: { weight: '500', size: 11 } },
                    ticks: { font: { size: 10 } }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 10, usePointStyle: true, pointStyle: 'rectRounded', font: { size: 10 } }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            let value = context.parsed.y;
                            if (context.chart.config.type === 'bar' && context.dataset.indexAxis === 'y') {
                                value = context.parsed.x;
                            } else if (context.chart.config.type === 'doughnut' || context.chart.config.type === 'pie') {
                                value = context.parsed;
                            }

                            if (value !== null && typeof value !== 'undefined') {
                                label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
                            }
                            return label;
                        }
                    },
                    titleFont: { size: 12 },
                    bodyFont: { size: 11 }
                },
                title: {
                    display: !!titleText,
                    text: titleText,
                    padding: { top: 8, bottom: 15 },
                    font: { size: 13, weight: '600' }
                },
                datalabels: { // Default datalabels config, can be overridden per chart
                    display: false // Hide by default, enable per chart
                }
            }
        };
    }


    @if($hasTaxReturnTranscripts && count($taxReturnTranscripts) > 0)
        const taxReturnYearsData = @json($taxReturnYears);
        const taxableIncomesData = @json($taxableIncomes);
        const totalTaxLiabilitiesData = @json($totalTaxLiabilities);
        const totalPaymentsMadeTRData = @json($totalPaymentsMadeTR);
        const balanceDueOverpaymentsData = @json($balanceDueOverpayments);

        const trCompareCtx = document.getElementById('taxReturnComparisonChart');
        if (trCompareCtx) {
            new Chart(trCompareCtx, {
                type: 'bar',
                data: {
                    labels: taxReturnYearsData,
                    datasets: [
                        {
                            label: 'Taxable Income',
                            data: taxableIncomesData,
                            backgroundColor: corporateColors.blue,
                            borderColor: corporateBorders.blue,
                            borderWidth: 1
                        },
                        {
                            label: 'Total Tax Liability',
                            data: totalTaxLiabilitiesData,
                            backgroundColor: corporateColors.purple,
                            borderColor: corporateBorders.purple,
                            borderWidth: 1
                        },
                        {
                            label: 'Total Payments Made',
                            data: totalPaymentsMadeTRData,
                            backgroundColor: corporateColors.cyan,
                            borderColor: corporateBorders.cyan,
                            borderWidth: 1
                        }
                    ]
                },
                options: getChartOptions('', 'Amount (USD)', 'Tax Year')
            });
        }

        const trBalanceCtx = document.getElementById('taxReturnBalanceTrendChart');
        if (trBalanceCtx) {
            new Chart(trBalanceCtx, {
                type: 'line',
                data: {
                    labels: taxReturnYearsData,
                    datasets: [{
                        label: 'Balance Due (+) / Overpayment (-)',
                        data: balanceDueOverpaymentsData,
                        fill: false,
                        borderColor: corporateBorders.red,
                        backgroundColor: corporateColors.red,
                        tension: 0.1,
                        pointBackgroundColor: function(context) {
                            var value = context.dataset.data[context.dataIndex];
                            return value >= 0 ? corporateBorders.red : corporateBorders.green;
                        },
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: function(context) {
                            var value = context.dataset.data[context.dataIndex];
                            return value >= 0 ? corporateBorders.red : corporateBorders.green;
                        }
                    }]
                },
                options: getChartOptions('', 'Amount (USD)', 'Tax Year')
            });
        }
    @endif

    @if($hasAccountTranscripts && (!empty($summary_acct_for_chart['data']) || $summary_acct['total_balance_plus_accruals'] == 0) )
        const accountSummaryLabels = @json($summary_acct_for_chart['labels']);
        const accountSummaryValues = @json($summary_acct_for_chart['data']);
        const isAccountSummaryZero = {{ $summary_acct['total_balance_plus_accruals'] == 0 ? 'true' : 'false' }};


        const accPieCtx = document.getElementById('accountSummaryPieChart');
        if (accPieCtx) {
            new Chart(accPieCtx, {
                type: 'doughnut',
                data: {
                    labels: accountSummaryLabels,
                    datasets: [{
                        label: 'Account Breakdown',
                        data: accountSummaryValues,
                        backgroundColor: [
                            corporateColors.red,
                            corporateColors.orange,
                            corporateColors.yellow,
                            corporateColors.green // For Zero Balance if only one item
                        ],
                        borderColor: [
                            corporateBorders.red,
                            corporateBorders.orange,
                            corporateBorders.yellow,
                            corporateBorders.green
                        ],
                        borderWidth: 1
                    }]
                },
                options: { // Specific options for this chart
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                             labels: { padding: 8, usePointStyle: true, pointStyle: 'rectRounded', font: {size: 10} }
                        },
                        tooltip: { // Tooltip still useful for exact currency values
                             callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed);
                                    }
                                    return label;
                                }
                            },
                            titleFont: { size: 12 },
                            bodyFont: { size: 11 }
                        },
                        datalabels: {
                            display: !isAccountSummaryZero, // Don't display if sum is zero
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                if (sum === 0) return ''; // Don't show percentage if sum is 0
                                let percentage = (value*100 / sum).toFixed(1) + "%";
                                return percentage;
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 10
                            }
                        },
                        title: { display: false }
                    }
                }
            });
        }

        // New Bar Chart for Account Summary
        const accBarCtx = document.getElementById('accountSummaryBarChart');
        if (accBarCtx) {
            new Chart(accBarCtx, {
                type: 'bar',
                data: {
                    labels: accountSummaryLabels,
                    datasets: [{
                        label: 'Amount (USD)', // Simplified label for bar chart
                        data: accountSummaryValues,
                        backgroundColor: [
                            corporateColors.red,
                            corporateColors.orange,
                            corporateColors.yellow,
                            corporateColors.green // For Zero Balance
                        ],
                        borderColor: [
                            corporateBorders.red,
                            corporateBorders.orange,
                            corporateBorders.yellow,
                            corporateBorders.green
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // Horizontal bar chart
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { // Values are on X-axis for horizontal bar
                            beginAtZero: true,
                            title: { display: false }, // No X-axis title needed
                            ticks: {
                                callback: function(value) {
                                    if (Math.abs(value) >= 1000) return '$' + (value / 1000).toFixed(1) + 'k';
                                    return '$' + value;
                                },
                                font: { size: 10 }
                            }
                        },
                        y: { // Labels are on Y-axis
                            ticks: { font: { size: 10 } }
                        }
                    },
                    plugins: {
                        legend: { display: false }, // No legend needed for single dataset bar
                        tooltip: { // Standard tooltip for currency
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) { label += ': '; }
                                    if (context.parsed.x !== null) {
                                        label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.x);
                                    }
                                    return label;
                                }
                            }
                        },
                        datalabels: {
                            display: true,
                            anchor: 'end',
                            align: 'end',
                            formatter: (value, ctx) => {
                                 if (value === 0 && isAccountSummaryZero && accountSummaryLabels.length === 1 && accountSummaryLabels[0] === 'Zero Balance') return ' $0.00 ';
                                 if (value === 0 && accountSummaryValues.every(v => v === 0)) return ''; // Hide if all values are zero effectively.
                                return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
                            },
                            color: function(context) {
                                // Make label darker if background is light (e.g. yellow or if value is small)
                                const value = context.dataset.data[context.dataIndex];
                                return value > 0 ? (context.dataset.backgroundColor[context.dataIndex] === corporateColors.yellow ? corporateColors.dark : '#fff') : corporateColors.dark;
                            },
                            font: {
                                weight: 'bold',
                                size: 9
                            },
                            padding: {
                                left: 4,
                                right: 4
                            }
                        },
                        title: { display: false }
                    }
                }
            });
        }
    @endif

    const transcriptTypeTabs = document.querySelectorAll('#transcriptTypeTabs button[data-bs-toggle="tab"]');
    transcriptTypeTabs.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', event => {
            // Chart.js v3+ usually resizes automatically.
            // If not, might need to get chart instances and call .resize() or .update()
        });
    });

});
</script>

{{-- Estilos CSS (sin cambios respecto a la versión compacta anterior, pero incluidos para completitud) --}}
<style>
    :root {
        --corp-primary: #0d6efd;
        --corp-secondary: #6c757d;
        --corp-success: #198754;
        --corp-danger: #dc3545;
        --corp-warning: #ffc107;
        --corp-info: #0dcaf0;
        --corp-light: #f8f9fa;
        --corp-dark: #212529;
        --corp-text-muted: #6c757d;
        --corp-border-color: #dee2e6;
        --corp-purple: #6f42c1;
        --corp-orange: #fd7e14;
    }

    .value-owed { color: var(--corp-danger); font-weight: 600; }
    .value-overpayment { color: var(--corp-success); font-weight: 600; }
    .value-income { color: var(--corp-primary); }
    .value-tax { color: var(--corp-purple); }
    .value-payment { color: var(--corp-info); }
    .value-interest { color: var(--corp-orange); }
    .value-penalty { color: var(--corp-warning); font-weight: 500; }


    .corporate-tabs .nav-link {
        color: var(--corp-text-muted);
        border: 1px solid transparent;
        border-bottom: 2px solid transparent; /* Thinner bottom border */
        padding: 0.6rem 1rem; /* Reduced padding */
        font-size: 0.9rem; /* Reduced font size */
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.02em; /* Slightly reduced letter spacing */
        transition: color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        margin-right: 1px;
        border-top-left-radius: .25rem; /* Slightly smaller radius */
        border-top-right-radius: .25rem;
    }
    .corporate-tabs .nav-link.active {
        color: var(--corp-primary);
        background-color: #fff;
        border-color: var(--corp-border-color) var(--corp-border-color) #fff;
        border-bottom: 2px solid var(--corp-primary) !important; /* Thinner active border */
        font-weight: 600;
    }
    .corporate-tabs .nav-link:hover:not(.active) {
        border-color: #e9ecef #e9ecef var(--corp-border-color);
        color: var(--corp-dark);
        background-color: var(--corp-light);
    }
    .corporate-tabs .nav-link .badge {
        font-size: 0.65em; /* Reduced font size */
        padding: 0.25em 0.5em; /* Reduced padding */
        vertical-align: middle;
        background-color: var(--corp-secondary) !important;
        font-weight: 500;
    }
    .corporate-tabs .nav-link.active .badge {
        background-color: var(--corp-primary) !important;
        color: #fff;
    }
    .corporate-tab-content {
        border: 1px solid var(--corp-border-color);
        border-top: none;
        padding: 1rem; /* Reduced padding */
        background-color: #fff;
        border-bottom-left-radius: .25rem; /* Slightly smaller radius */
        border-bottom-right-radius: .25rem;
    }

    .summary-card-container,
    .tabs-outer-container,
    .transcript-details-card-container,
    .charts-container .card {
        container-type: inline-size;
        container-name: transcript-module-item;
    }

    .transcript-card-header {
        container-type: inline-size;
        container-name: card-header-content;
        background-color: var(--corp-light);
        border-bottom: 1px solid var(--corp-border-color);
        padding: 0.6rem 0.8rem; /* Reduced padding */
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
    }
    .transcript-card-header:hover {
        background-color: #e9ecef;
    }
    .transcript-card-header .transcript-info-header {
        flex-grow: 1;
        min-width: 0;
        margin-right: 0.4rem; /* Reduced margin */
    }
    .transcript-card-header .header-actions {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .summary-card-container .card-title {
        margin-bottom: 0.75rem !important;
    }
    .summary-item {
        padding: 0.75rem; /* Reduced padding */
        border: 1px solid #e9ecef;
        border-radius: 0.25rem; /* Slightly smaller radius */
        background-color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: left;
        box-shadow: 0 0.1rem 0.2rem rgba(0,0,0,0.04); /* Slightly reduced shadow */
    }
    .summary-item-label {
        font-size: 0.7rem; /* Reduced font size */
        line-height: 1.2; /* Adjusted line height */
        margin-bottom: 0.25rem; /* Reduced margin */
        text-transform: uppercase;
        color: var(--corp-text-muted);
        font-weight: 500;
    }
    .summary-item-value {
        font-size: 1.1rem !important; /* Reduced font size */
        line-height: 1.2; /* Adjusted line height */
        font-weight: 600; /* Slightly less bold */
    }

    @container transcript-module-item (max-width: 768px) {
        .summary-item-label { font-size: 0.68rem; }
        .summary-item-value { font-size: 1.05rem !important; }
    }
    @container transcript-module-item (max-width: 576px) {
        .summary-items-row .summary-item-col { flex: 0 0 100%; max-width: 100%; }
        .summary-item-label { font-size: 0.7rem; }
        .summary-item-value { font-size: 1.1rem !important; }
        .summary-item { padding: 0.6rem; }
    }
     @container transcript-module-item (max-width: 400px) {
        .summary-item-label { font-size: 0.65rem; }
        .summary-item-value { font-size: 1rem !important; }
    }

    .charts-container .card {
        border: 1px solid var(--corp-border-color);
    }
    .charts-container .card-body {
        padding: 0.75rem; /* Reduced padding */
    }
    .charts-container h6 {
        margin-bottom: 0.5rem !important;
    }
    .chart-wrapper {
        position: relative;
        width: 100%;
    }


    .icon-tabs-container .icon-tabs {
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        border-bottom: 1px solid var(--corp-border-color);
        background-color: var(--corp-light);
    }
    .icon-tabs-container .nav-item {
        margin-bottom: -1px;
    }
    .icon-tabs-container .nav-link {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem; /* Reduced padding */
        font-size: 0.8rem; /* Reduced font size */
        color: var(--corp-text-muted);
        border: 1px solid transparent;
        border-top-left-radius: .2rem; /* Slightly smaller radius */
        border-top-right-radius: .2rem;
        text-decoration: none;
        line-height: 1.3; /* Adjusted line height */
        font-weight: 500;
        transition: color 0.15s ease-in-out, border-color 0.15s ease-in-out, background-color 0.15s ease-in-out;
    }
    .icon-tabs-container .nav-link:hover:not(.active),
    .icon-tabs-container .nav-link:focus:not(.active) {
        border-color: #e9ecef #e9ecef var(--corp-border-color);
        background-color: #e9ecef;
        color: var(--corp-primary);
    }
    .icon-tabs-container .nav-link.active {
        color: var(--corp-primary);
        background-color: #fff; /* Matches content pane background */
        border-color: var(--corp-border-color) var(--corp-border-color) #fff;
        border-bottom: 1px solid #fff !important;
        font-weight: 600;
    }
    .icon-tabs-container .tab-icon {
        margin-right: 0.3rem; /* Reduced margin */
        font-size: 0.95rem; /* Reduced font size */
        line-height: 1;
        color: var(--corp-primary);
    }
     .icon-tabs-container .nav-link:not(.active) .tab-icon {
        color: var(--corp-secondary);
     }
    .icon-tabs-container .tab-text-content {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px; /* Reduced max-width */
        display: inline-block;
    }

    @container transcript-module-item (max-width: 700px) {
        .icon-tabs-container .tab-text-content { max-width: 90px; }
        .icon-tabs-container .nav-link { padding: 0.5rem 0.6rem; font-size: 0.78rem;}
    }
    @container transcript-module-item (max-width: 600px) {
        .icon-tabs-container .nav-link {
            flex-direction: column; text-align: center;
            padding: 0.4rem 0.3rem; font-size: 0.75rem;
        }
        .icon-tabs-container .tab-icon { margin-right: 0; margin-bottom: 0.2rem; font-size: 1.1rem; }
        .icon-tabs-container .tab-text-content { max-width: 70px; line-height: 1.1; }
    }
    @container transcript-module-item (max-width: 450px) {
        .icon-tabs-container .nav-link { padding: 0.3rem 0.2rem; font-size: 0.72rem; }
        .icon-tabs-container .tab-icon { font-size: 1rem; }
        .icon-tabs-container .tab-text-content { max-width: 60px; }
    }


    .transcript-card-header .transcript-card-title {
         font-size: 0.9rem; /* Reduced font size */
         font-weight: 600;
         color: var(--corp-dark);
    }
    .transcript-card-header .transcript-filename-header {
        display: inline-block;
        max-width: 150px; /* Reduced max-width */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: baseline;
        font-size: 0.75rem; /* Reduced font size */
        color: var(--corp-text-muted);
        font-weight: 400;
    }
    .transcript-card-header .view-transcript-btn {
        font-size: 0.78rem; /* Reduced font size */
    }
    .transcript-card-header .view-transcript-btn .ri-eye-line {
        margin-right: 0.2rem; /* Reduced margin */
        vertical-align: text-bottom;
    }
    .transcript-card-header .collapse-indicator {
        transition: transform 0.3s ease-in-out;
        display: inline-block;
        font-size: 1.1rem; /* Reduced font size */
        color: var(--corp-primary);
    }
    .transcript-card-header[aria-expanded="true"] .collapse-indicator {
        transform: rotate(-180deg);
    }
    .transcript-details-card-container .card-body { /* Padding already reduced to p-2 in HTML */
        border-top: 1px solid var(--corp-border-color);
    }
    .transcript-card-header[aria-expanded="true"] {
        border-bottom-color: transparent; /* When expanded, the header's bottom border is removed to blend with body */
    }

    /* Rounded corners for single (non-tabbed) cards */
    #tax-return-content > .card.transcript-details-card-container,
    #account-transcript-content > .card.transcript-details-card-container {
        border-radius: var(--bs-card-border-radius);
    }
     #tax-return-content > .card.transcript-details-card-container > .transcript-card-header,
    #account-transcript-content > .card.transcript-details-card-container > .transcript-card-header {
        border-top-left-radius: var(--bs-card-inner-border-radius);
        border-top-right-radius: var(--bs-card-inner-border-radius);
    }
    #tax-return-content > .card.transcript-details-card-container > .collapse > .card-body,
    #account-transcript-content > .card.transcript-details-card-container > .collapse > .card-body {
         border-bottom-left-radius: var(--bs-card-inner-border-radius);
         border-bottom-right-radius: var(--bs-card-inner-border-radius);
    }
    /* Ensure top border on card body only when expanded and it's a single card OR first tabbed card if header is not rounded bottom */
     #tax-return-content > .card.transcript-details-card-container > .collapse.show > .card-body,
    #account-transcript-content > .card.transcript-details-card-container > .collapse.show > .card-body {
        border-top: 1px solid var(--corp-border-color);
    }
     #tax-return-content > .card.transcript-details-card-container > .transcript-card-header[aria-expanded="true"],
    #account-transcript-content > .card.transcript-details-card-container > .transcript-card-header[aria-expanded="true"]{
         border-bottom-color: transparent;
    }
    /* For tabbed cards, the top border of the body should still be there if the header doesn't form a continuous border */
    .tab-content > .tab-pane > .card.rounded-0 > .collapse.show > .card-body {
        border-top: 1px solid var(--corp-border-color);
    }
    .tab-content > .tab-pane > .card.rounded-0 > .transcript-card-header[aria-expanded="true"] {
        border-bottom-color: transparent;
    }


    @container card-header-content (max-width: 520px) {
        .transcript-card-header .transcript-card-title { font-size: 0.85rem; }
        .transcript-card-header .transcript-filename-header { max-width: 100px; font-size: 0.72rem; }
        .transcript-card-header .view-transcript-btn { font-size: 0.75rem; }
    }
    @container card-header-content (max-width: 420px) {
        .transcript-card-header .transcript-filename-header { display: none; }
        .transcript-card-header .view-transcript-btn .view-transcript-btn-text { display: none; }
        .transcript-card-header .view-transcript-btn .ri-eye-line { margin-right: 0 !important; }
        .transcript-card-header .transcript-card-title { font-size: 0.82rem; }
    }

    .table-compact-transcripts {
        font-size: 0.8rem; /* Reduced font size */
        background-color: #fff;
        width: 100%;
        margin-bottom: 0;
    }
    .table-compact-transcripts th,
    .table-compact-transcripts td {
        padding: 0.4rem 0.5rem; /* Reduced padding */
        vertical-align: middle;
        line-height: 1.4; /* Adjusted line height */
        border-bottom: 1px solid #f0f0f0;
    }
    .table-compact-transcripts tr:last-child td {
        border-bottom: 0;
    }
    .table-compact-transcripts thead th {
        font-weight: 600;
        color: var(--corp-dark);
        background-color: #f8f9fa;
        border-bottom: 2px solid var(--corp-border-color);
        font-size: 0.75rem; /* Reduced font size */
        text-transform: uppercase;
        letter-spacing: 0.02em; /* Reduced letter spacing */
    }
    .table-compact-transcripts .list-unstyled { margin-bottom: 0; }
    .table-compact-transcripts .list-unstyled small {
        font-size: 0.9em; /* Adjusted relative size */
        line-height: 1.3; /* Adjusted line height */
        color: var(--corp-text-muted);
    }
    .table-compact-transcripts td .fw-bold {
        color: var(--corp-dark);
    }

    @container transcript-module-item (max-width: 700px) {
        .table-compact-transcripts { border: 0; }
        .table-compact-transcripts thead { display: none; }
        .table-compact-transcripts tr {
            display: block;
            border-bottom: 1px solid var(--corp-border-color);
            padding-bottom: 0;
        }
         .table-compact-transcripts tr:last-child { border-bottom: 0; }

        .table-compact-transcripts td {
            display: block;
            text-align: right;
            font-size: 0.9em; /* Adjusted relative size */
            border-bottom: none;
            padding-left: 45% !important;
            position: relative;
            padding-top: 0.5rem; /* Reduced padding */
            padding-bottom: 0.5rem; /* Reduced padding */
            line-height: 1.5; /* Adjusted line height */
        }
        .table-compact-transcripts td::before {
            content: attr(data-label);
            position: absolute;
            left: 0.5rem; /* Align with td padding */
            width: calc(45% - 1rem); /* Label width considering padding */
            padding-right: 8px; /* Reduced padding */
            white-space: normal;
            text-align: left;
            font-weight: 600;
            color: var(--corp-dark);
            font-size: 0.88em; /* Adjusted relative size */
            line-height: 1.3; /* Adjusted line height */
        }
    }
    @container transcript-module-item (max-width: 400px) {
        .table-compact-transcripts td {
            font-size: 0.88em; /* Further reduced */
            padding-left: 40% !important;
        }
        .table-compact-transcripts td::before {
            width: calc(40% - 1rem);
            font-size: 0.85em; /* Further reduced */
        }
    }

    @media (max-width: 767.98px) {
        .corporate-tab-content { padding: 0.75rem; } /* Further reduced padding */
    }

    @media (max-width: 576px) {
        .corporate-tabs .nav-link { font-size: 0.8rem; padding: 0.5rem 0.6rem; text-transform: none;}
        .summary-card-container .card-title, .charts-container h6 { font-size: 0.8rem; }
        .transcript-card-header .transcript-card-title { font-size: 0.85rem; }
    }
</style>