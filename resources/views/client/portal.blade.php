@extends('components.layout')
@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" /> {{-- Keep for file manager --}}
<link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.css">
<link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />


<style>
    :root {
        --theme-font-family: 'Poppins', sans-serif;
        --theme-primary: #6366F1;
        --theme-primary-hover: #4F46E5;
        --theme-primary-light: #E0E7FF;
        --theme-primary-dark: #3730A3;
        --theme-primary-text-on-light: #4338CA;
        --theme-accent: #14B8A6;
        --theme-accent-hover: #0D9488;
        --theme-accent-light: #F0FDFA;
        --theme-bg-main: #F1F5F9;
        --theme-bg-card: #FFFFFF;
        --theme-bg-card-alt: #F8FAFC;
        --theme-text-dark: #1E293B;
        --theme-text-medium: #475569;
        --theme-text-light: #94A3B8;
        --theme-text-inverted: #FFFFFF;
        --theme-border-strong: #CBD5E1;
        --theme-border-soft: #E2E8F0;
        --theme-border-interactive: var(--theme-primary);
        --theme-success: #22C55E;
        --theme-warning: #F59E0B;
        --theme-danger: #EF4444;
        --theme-info: #3B82F6;
        --theme-border-radius-sm: 0.2rem;
        --theme-border-radius-md: 0.375rem;
        --theme-border-radius-lg: 0.5rem;
        --theme-shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        --theme-shadow-card: 0 2px 4px -1px rgba(0, 0, 0, 0.05), 0 1px 2px -2px rgba(0, 0, 0, 0.05);
        --theme-shadow-interactive: 0 0 0 2px rgba(var(--theme-primary-rgb), 0.2);
        --theme-primary-rgb: 99, 102, 241;
        --bs-primary: var(--theme-primary);
        --bs-primary-rgb: var(--theme-primary-rgb);
        --bs-secondary: var(--theme-text-medium);
        --bs-success: var(--theme-success);
        --bs-info: var(--theme-info);
        --bs-warning: var(--theme-warning);
        --bs-danger: var(--theme-danger);
        --bs-light: var(--theme-bg-card-alt);
        --bs-dark: var(--theme-text-dark);
        --bs-body-color: var(--theme-text-medium);
        --bs-body-bg: var(--theme-bg-main);
        --bs-border-color: var(--theme-border-soft);
        --bs-gutter-x: 1rem;
        --bs-gutter-y: 1rem;
    }

    body {
        font-family: var(--theme-font-family);
        color: var(--theme-text-medium);
        font-size: 0.8rem;
        letter-spacing: 0.005em;
        background: linear-gradient(-45deg, #fff, rgb(244, 244, 244), rgb(234, 234, 234), #fff);
        background-size: 400% 400%;
        animation: subtleGradientShift 25s ease infinite;
        transition: background-color 0.3s ease;
    }

    @keyframes subtleGradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .container-xxl {
        padding-top: 1rem;
        padding-bottom: 1rem;
        padding-left: 10px;
        padding-right: 10px;
        max-width: 100% !important;
    }
    a { color: var(--theme-primary); text-decoration: none; }
    a:hover { color: var(--theme-primary-hover); text-decoration: underline; }
    hr { border-top: 1px solid var(--theme-border-soft); margin: 0.75rem 0; }

    .card {
        border: 1px solid var(--theme-border-soft);
        box-shadow: var(--theme-shadow-card);
        background-color: var(--theme-bg-card);
        overflow: hidden;
        border-radius: var(--theme-border-radius-md);
    }

    .card-header {
        background-color: var(--theme-primary-light);
        border-bottom: 1px solid var(--theme-primary);
        padding: 0.5rem 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .card-header .card-title-icon {
        font-size: 1.1rem;
        color: var(--theme-primary-text-on-light);
        margin-right: 0.5rem;
        line-height: 1;
        transition: color 0.3s ease;
    }

    .card-title {
        margin-bottom: 0;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--theme-primary-text-on-light);
        flex-grow: 1;
        transition: color 0.3s ease;
    }

    .card-header .card-color-picker-btn,
    .card-header .card-header-reset-color-btn {
        color: var(--theme-primary-text-on-light);
        padding: 0.25rem;
        transition: color 0.3s ease;
        background: transparent;
        border: none;
    }
    .card-header .card-color-picker-btn i,
    .card-header .card-header-reset-color-btn i {
        font-size: 0.9rem;
    }
    .card-header .card-color-input {
        width: 0; height: 0; padding: 0; border: none; opacity: 0; position: absolute;
    }

    .card-body {
        padding: 0.8rem;
        font-size: 0.78rem;
        color: var(--theme-text-medium);
    }
    .card-body-compact { padding: 0.6rem 0.8rem; }

    .main-wrapper-card {
        border: none; box-shadow: none; background-color: transparent; margin-bottom: 0 !important;
    }
    .main-wrapper-card .card-header.main-wrapper-card-header {
        border: 1px solid var(--theme-border-strong);border-bottom: none;
        box-shadow: var(--theme-shadow-card);
        background-color: var(--theme-bg-card);
        padding: 0.8rem 1.2rem;
        color: var(--theme-text-dark);
        border-top-left-radius: var(--theme-border-radius-lg);
        border-top-right-radius: var(--theme-border-radius-lg);
    }
     .main-wrapper-card .card-header.main-wrapper-card-header .card-title,
     .main-wrapper-card .card-header.main-wrapper-card-header .card-title-icon {
        color: var(--theme-text-dark);
     }
     .main-wrapper-card .card-header.main-wrapper-card-header .card-title-icon {
        color: var(--theme-primary);
     }

    .main-wrapper-card-header .status-indicator {
        width: 10px; height: 10px; margin-right: 0.6rem; border-radius: 50%; flex-shrink: 0;
        box-shadow: 0 0 6px 1px currentColor;
    }
    .status-indicator.status-pending    { background-color: var(--theme-warning); color: var(--theme-warning); }
    .status-indicator.status-active     { background-color: var(--theme-success); color: var(--theme-success); }
    .status-indicator.status-complete   { background-color: var(--theme-info);    color: var(--theme-info); }
    .status-indicator.status-urgent     { background-color: var(--theme-danger);  color: var(--theme-danger); }
    .status-indicator.status-hold       { background-color: var(--theme-text-light); color: var(--theme-text-light); }

    .text-status-unknown    { color: var(--theme-text-medium) !important; }
    .text-status-open       { color: var(--theme-success) !important; }
    .text-status-closed     { color: var(--theme-info) !important; }
    .text-status-inprogress { color: var(--theme-warning) !important; }
    .text-status-hold       { color: var(--theme-text-light) !important; }


    .main-wrapper-card-header .client-name {
        font-size: 1.3rem;
        font-weight: 700; color: var(--theme-text-dark);
    }
    .main-wrapper-card-header .client-additional-details span {
        font-size: 0.8em; color: var(--theme-text-medium); margin-right: 0.75rem; opacity: 0.8;
    }
    .main-wrapper-card-header .client-additional-details span i { color: var(--theme-primary); margin-right: 0.2rem; }

    .main-wrapper-card-header .header-stats-container {
        gap: 2.5rem;
        justify-content: flex-end;
    }

    .main-wrapper-card-header .header-stat-item,
    .main-wrapper-card-header .tax-owed-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 90px;
    }

    .main-wrapper-card-header .header-stats-container p,
    .main-wrapper-card-header .tax-owed-info p {
        font-size: 0.7rem;
        color: var(--theme-text-light);
        margin-bottom: 0.1rem;
        text-transform: uppercase;
        font-weight: 500;
        text-align: center;
        white-space: nowrap;
    }

    .main-wrapper-card-header .header-stats-container h5,
    .main-wrapper-card-header .tax-owed-info h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--theme-text-dark);
        margin-bottom: 0;
        text-align: center;
    }

    .main-wrapper-card-header .tax-owed-info h5.value-unknown {
        color: var(--theme-text-light);
        font-style: italic;
        font-weight: 500;
    }

    .main-wrapper-card > .collapse.show {
        border: 1px solid var(--theme-border-strong); border-top: none;
        box-shadow: var(--theme-shadow-card);
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom-left-radius: var(--theme-border-radius-lg);
        border-bottom-right-radius: var(--theme-border-radius-lg);
    }
    .main-wrapper-card > .collapse > .card-body { padding: 0; }
    .main-wrapper-card > .collapse.show > .card-body > .row {
        --bs-gutter-x: var(--bs-gutter-x, 1rem);
        --bs-gutter-y: var(--bs-gutter-y, 1rem);
        padding: 0.5rem;
    }

    .drop-column {
        padding-bottom: 0.8rem; min-height: 50px;
    }
    .drop-column.ui-sortable-highlight { background-color: var(--theme-primary-light); outline: 1px dashed var(--theme-primary); }

    .draggable-card {
        margin-bottom: 1rem;
        border: 1px solid var(--theme-border-soft);
        background-color: transparent;
    }
    .draggable-card .card-header {
        cursor: grab;
    }
    .draggable-card .card-header:active {
        cursor: grabbing;
    }

    .draggable-card .card-body {
        background-color: var(--theme-bg-card-alt);
        border-bottom-left-radius: var(--theme-border-radius-md);
        border-bottom-right-radius: var(--theme-border-radius-md);
    }

    /* Styles for card-tabbed-content removed as the card is removed */

    .sortable-placeholder {
        border: 1px dashed var(--theme-accent); background-color: var(--theme-accent-light);
        height: 60px; margin-bottom: 1rem; border-radius: var(--theme-border-radius-md);
    }

    #card-client-header.client-header-card {
        margin-bottom: 1rem;
        border-radius: var(--theme-border-radius-md);
        padding: 1rem;
        background-color: var(--theme-bg-card);
    }

    #card-client-header .table-sm td {
        font-size: 0.78rem;
        vertical-align: top;
        line-height: 1.4;
        padding: 0.3rem 0.5rem;
    }

    #card-client-header .table-sm td[style*="font-weight: 500"],
    #card-client-header .table-sm td strong {
        color: var(--theme-text-dark);
        font-weight: 600 !important;
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
    }

    #card-client-header .table-sm td[style*="background-color"] {
        background-color: var(--theme-bg-card-alt) !important;
        border: 1px solid var(--theme-border-soft) !important;
        border-radius: var(--theme-border-radius-sm) !important;
        color: var(--theme-text-medium);
        word-break: break-word;
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
        text-align: left;
    }

    #card-client-header h6.fw-medium[class*="text-status-"] {
        font-size: 0.9rem;
        font-weight: 600 !important;
        margin-bottom: 0;
        display: inline-block;
    }

    #card-client-header .value-unknown {
        color: var(--theme-text-light);
        font-style: italic;
    }

    #spouseInfoCollapse h6 {
        font-size: 0.85rem;
        color: var(--theme-primary-dark);
        padding-top: 0.6rem;
        border-top: 1px dashed var(--theme-border-soft);
        margin-top: 0.6rem;
        margin-bottom: 0.5rem;
    }

    .btn {
        font-size: 0.78rem; font-weight: 500; border-radius: var(--theme-border-radius-sm);
        padding: 0.4rem 0.8rem;
        letter-spacing: 0.01em; box-shadow: var(--theme-shadow-subtle);
        transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }
    .btn:hover { box-shadow: var(--theme-shadow-card); }
    .btn-xs { padding: 0.2rem 0.5rem; font-size: 0.7rem; }
    .btn-icon.btn-sm { padding: 0.35rem; }
    .btn-icon.btn-sm i { font-size: 1rem; }

    .btn-collapse {
        background: none; border: none; cursor: pointer; padding: 0.2rem;
        border-radius: 50%; color: var(--theme-text-medium); line-height: 1;
    }
    .btn-collapse:hover { background-color: rgba(0,0,0,0.04); color: var(--theme-text-dark); }
    .btn-collapse i { font-size: 1.2rem; vertical-align: middle; }

    .card-header .btn-collapse {
        color: var(--theme-primary-text-on-light);
        transition: color 0.3s ease;
    }
    .card-header .btn-collapse:hover {
        color: var(--theme-primary-dark);
        background-color: rgba(255,255,255,0.15);
    }
    .card-header[style*="background-color"] .btn-collapse:hover {
       filter: brightness(1.2);
    }
    .main-wrapper-card .card-header.main-wrapper-card-header .btn-collapse,
    #card-client-header .btn-collapse {
        color: var(--theme-text-medium);
    }
    .main-wrapper-card .card-header.main-wrapper-card-header .btn-collapse:hover,
    #card-client-header .btn-collapse:hover {
        color: var(--theme-text-dark);
    }

    .form-control, .form-select {
        font-size: 0.78rem; border-radius: var(--theme-border-radius-sm);
        border: 1px solid var(--theme-border-strong); padding: 0.4rem 0.6rem;
        background-color: var(--theme-bg-card); color: var(--theme-text-medium);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--theme-primary);
        box-shadow: var(--theme-shadow-interactive);
    }
    label { font-weight: 500; margin-bottom: 0.25rem; font-size: 0.75rem; color: var(--theme-text-dark); }

    /* Styles for #card-tabbed-content .nav-tabs, #user-profile-tabs .nav-tabs, etc. removed or simplified as they are not used */

    .icon-tabs-container { padding: 0.1rem 0.3rem; background-color: var(--theme-bg-card-alt); }
    .icon-tabs .nav-link { padding: 0.3rem 0.5rem; font-size: 0.7rem; }
    .icon-tabs .nav-link .tab-icon { font-size: 0.9rem; }
    .icon-tabs .nav-link .tab-filename { font-size: 0.65rem; }


    .notes-list-container, .file-list-container { /* .chat-messages-container removed */
        overflow-y: auto;
        padding-right: 5px;
        resize: vertical;
        min-height: 150px;
    }
    #card-notes .notes-list-container { max-height: 350px; }
    #card-file-manager .file-list-container { max-height: 200px; }

    #notes-list { background-color: var(--theme-bg-main); padding: 0.3rem; }
    #notes-list .card { margin-bottom: 0.3rem !important; border: 1px solid var(--theme-border-soft); }
    #notes-list .card-body { padding: 0.6rem 0.8rem; background-color: var(--theme-bg-card) !important; }
    #notes-list .avatar img { width: 24px !important; height: 24px !important; border-radius: 50%; }
    #notes-list .text-heading.h5 { font-size: 0.8rem !important; color: var(--theme-text-dark); }
    #notes-list .text-heading.h5 small { font-size: 0.65rem !important; color: var(--theme-text-medium); }
    #notes-list .card-body p.text-dark { font-size: 0.78rem !important; color: var(--theme-text-medium) !important; }
    #frm-add-notes textarea#note-textarea { min-height: 60px; background-color: var(--theme-bg-card); border-color: var(--theme-border-strong); }

    /* Styles for .chat-message removed */

    #card-file-manager .dropzone { padding: 1rem; min-height: 80px; border: 2px dashed var(--theme-border-strong); background-color: var(--theme-bg-card-alt); }
    #card-file-manager .dropzone.dz-drag-hover { background-color: var(--theme-primary-light); border-color: var(--theme-primary); }
    .file-list-compact .file-item-compact { padding: 0.4rem 0.1rem; font-size: 0.75rem; border-bottom: 1px solid var(--theme-border-soft); }
    .file-item-compact .file-icon img { width: 20px; }
    .file-item-compact .file-name { font-size: 0.8rem; color: var(--theme-primary); }
    .file-item-compact .file-meta { font-size: 0.65rem; color: var(--theme-text-light); }

    #card-notes .card-body,
    #card-file-manager .card-body,
    #card-help .card-body /* Added for new help card */
    /* Removed other card bodies: #card-chat, #card-transcripts, #card-history, #card-quick-actions, #card-tasks, #card-client-overview */
    {
        background-color: var(--theme-bg-card-alt);
    }

    .ps__thumb-y, .ps__thumb-x {
        background-color: var(--theme-primary) !important; opacity: 0.4;
        border-radius: 3px !important;
    }
    .ps__thumb-y:hover, .ps__thumb-x:hover { opacity: 0.6; }
    .ps__rail-y, .ps__rail-x { background-color: transparent !important; opacity: 0 !important; }

    .badge { padding: 0.25em 0.5em; font-size: 0.7rem; font-weight: 500; border-radius: var(--theme-border-radius-sm); }

    /* Styles for #card-quick-actions removed */

    #page-load-overlay {
        background: white;
        opacity: 1; visibility: visible;
        transition: opacity 0.7s ease-in-out, visibility 0.7s ease-in-out !important;
    }
    #page-load-overlay.fade-out { opacity: 0; visibility: hidden; }
    #page-load-overlay h3 { font-weight: 600; font-size: 2.2rem; color: var(--theme-text-inverted); letter-spacing: 0.05em; text-shadow: 1px 1px 3px rgba(0,0,0,0.2); }
    #page-load-overlay h3 span { color: #FFF; }
    #page-load-overlay .spinner-border { width: 2.5rem; height: 2.5rem; border-width: .25em; color: var(--theme-text-inverted); }

    .fs-sm { font-size: 0.8rem !important; }
    .fs-xs { font-size: 0.75rem !important; }
    .text-heading { color: var(--theme-text-dark) !important; }
    .avatar{ display: none; }

    @media (max-width: 767.98px) {
        body { font-size: 0.78rem; }
        .main-wrapper-card .card-header.main-wrapper-card-header {
            padding: 0.7rem 1rem;
            flex-wrap: wrap;
        }
        .main-wrapper-card-header .client-name { font-size: 1.1rem; }
        .main-wrapper-card-header .client-additional-details {
             width: 100%;
             margin-left: 0 !important;
             margin-top: 0.25rem;
        }
        .main-wrapper-card-header .header-stats-container {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 0.5rem;
            margin-left: 0 !important;
            gap: 1rem !important;
        }
        .main-wrapper-card-header .tax-owed-info {
            flex-basis: 100%;
        }
        .main-wrapper-card-header .header-stats-container p,
        .main-wrapper-card-header .tax-owed-info p {
            font-size: 0.65rem;
            white-space: normal;
        }
        .main-wrapper-card-header .header-stats-container h5,
        .main-wrapper-card-header .tax-owed-info h5 {
             font-size: 1rem;
        }

        #card-client-header.client-header-card { padding: 0.8rem; }
        #card-client-header .table-sm td {
            font-size: 0.75rem;
            padding-top: 0.25rem !important;
            padding-bottom: 0.25rem !important;
        }
        #card-client-header h6.fw-medium[class*="text-status-"] {
            font-size: 0.85rem;
        }
        #spouseInfoCollapse h6 {
            font-size: 0.8rem;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
        }
        #card-client-header .table-sm td > .badge + .btn-link {
            display: block;
            margin-left: 0 !important;
            margin-top: 0.25rem;
        }
        /* Removed responsive styles for #card-tabbed-content */
    }

</style>

@endsection

@section('content')

<!-- Page Overlay -->
<div id="page-load-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; opacity: 1; transition: opacity 1s ease-out; display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <h3 style="font-weight: 500; color: #566a7f; font-family: 'Poppins', sans-serif;">Taxlab<span style="color: var(--bs-primary);">pro</span></h3>
    <div class="spinner-border text-primary" role="status" style="margin-top: 1rem;"></div>
</div>


{{-- START: Main Collapsible Card Wrapper --}}
<div class="card main-wrapper-card">

  {{-- Header --}}
  <div class="card-header main-wrapper-card-header">
    <div class="d-flex flex-column flex-md-row align-items-md-baseline flex-grow-1 me-md-3">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            @php
                $indicatorStatusMap = [
                    1 => 'status-pending',
                    2 => 'status-active',
                    3 => 'status-complete',
                    4 => 'status-pending',    // Mapped "In Progress" to pending visual
                    5 => 'status-hold'
                ];
                $indicatorStatusClass = $indicatorStatusMap[$client->case_status ?? 1] ?? 'status-pending';
            @endphp
            <span class="status-indicator {{ $indicatorStatusClass }}" title="Case Status Indicator"></span>
            <h5 class="client-name mb-0">
                {{ $client->first_name ?? 'Unknown' }} {{ $client->last_name ?? 'Unknown' }}
            </h5>
        </div>

        <div class="ms-md-2 client-additional-details">
            @php
            $mainHeaderSpouseFullName = null;
            if (isset($client->marital_status) && ((string)$client->marital_status === '2' || $client->marital_status === true)) {
                $mainHeaderSpouseFirstName = $client->spouse_first_name ?? '';
                $mainHeaderSpouseLastName = $client->spouse_last_name ?? '';
                $tempSpouseFullName = trim($mainHeaderSpouseFirstName . ' ' . $mainHeaderSpouseLastName);
                if (!empty($tempSpouseFullName)) {
                $mainHeaderSpouseFullName = $tempSpouseFullName;
                }
            }
            @endphp
            @if($mainHeaderSpouseFullName)
            <span class="header-spouse-name">
                <i class="ri-user-heart-line ri-tiny"></i>  {{ $mainHeaderSpouseFullName }}
            </span>
            @endif
            @if($client->business_name)
            <span class="header-business-name">
                <i class="ri-briefcase-line ri-tiny"></i> {{ $client->business_name }}
            </span>
            @endif
            @if($client->updated_at)
            <span class="header-last-update">
                <i class="ri-time-line ri-tiny"></i> {{ \Carbon\Carbon::parse($client->updated_at)->format('m/d/y H:i') }}
            </span>
            @endif
        </div>
    </div>

    <div class="d-flex flex-wrap align-items-center ms-md-auto header-stats-container">

        <div class="header-stat-item">
            <p>Deal</p>
            <h5>$7,988</h5> 
        </div>
        <div class="tax-owed-info">
            <p>Total Amount Owed</p>
            @php
                $summary = [ 'account_balance_plus_accruals' => 0 ];
                if (isset($accountTranscripts) && is_array($accountTranscripts)) {
                    foreach($accountTranscripts as $t) {
                        if (isset($t['account_balance_plus_accruals']) && $t['account_balance_plus_accruals'] > 0) {
                        $summary['account_balance_plus_accruals'] += $t['account_balance_plus_accruals'];
                        }
                    }
                }
            @endphp
            <h5 class="{{ !$summary['account_balance_plus_accruals'] ? 'value-unknown' : ''}}">
                {{ $summary['account_balance_plus_accruals'] ? '$' . number_format($summary['account_balance_plus_accruals'], 2) : 'Unknown' }}
            </h5>
        </div>
    </div>

    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainContentWrapperCollapse" aria-expanded="true" aria-controls="mainContentWrapperCollapse" title="Toggle Client Details">
      <i class="ri-arrow-down-s-line"></i>
    </button>
  </div>


  <div id="mainContentWrapperCollapse" class="collapse show">
    <div class="card-body">
        <div class="row gy-4" id="client-layout-row">

          <div id="left-column" class="drop-column col-sm-12 col-12 order-1 order-md-0 px-2">
            {{-- Sections Notes, File Manager, Help will go here --}}

            <div class="card right-sidebar-card draggable-card" id="card-notes">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingNotes">
                    <i class="ri-sticky-note-2-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Notes</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNotes" aria-expanded="false" aria-controls="collapseNotes" title="Toggle Notes"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseNotes" class="collapse" aria-labelledby="headingNotes">
                @include('client.partials.notes')
                </div>
            </div>

            <div class="card right-sidebar-card draggable-card" id="card-file-manager">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingFileManager">
                    <i class="ri-folder-open-line card-title-icon"></i>
                    <h6 class="card-title me-auto">File Manager</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFileManager" aria-expanded="false" aria-controls="collapseFileManager" title="Toggle File Manager"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseFileManager" class="collapse" aria-labelledby="headingFileManager"><br>
                    @include('client.partials.files')
                </div>
            </div>

            <div class="card draggable-card" id="card-help">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingHelp">
                    <i class="ri-question-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Help / Ayuda</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp" title="Toggle Help"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseHelp" class="collapse" aria-labelledby="headingHelp">
                    <div class="card-body">
                        <p>Esta sección te ayuda a entender cómo utilizar las diferentes partes de esta vista:</p>
                        <hr>
                        <h6><i class="ri-dashboard-line me-1"></i> Dashboard / Main Info (Información Principal)</h6>
                        <p>Esta es la vista principal cuando abres el perfil de un cliente. Aquí encontrarás:</p>
                        <ul>
                            <li><strong>Encabezado Superior:</strong> Nombre del cliente, estado del caso (con un indicador de color), detalles del cónyuge (si aplica), nombre del negocio (si aplica) y fecha de última actualización. También muestra estadísticas rápidas como tareas pendientes/completadas, valor del trato y la cantidad total adeudada por el cliente según los transcritos.</li>
                            <li><strong>Bloque Central de Información:</strong> Muestra información detallada como:
                                <ul>
                                    <li>Estado del caso (Unknown, Open, Closed, In Progress, On Hold).</li>
                                    <li>Nombre completo del contribuyente, SSN (parcialmente oculto, con opción para mostrar completo), y fecha de nacimiento.</li>
                                    <li>Dirección, email y números de teléfono.</li>
                                    <li>Estado civil: Si está casado, puedes expandir para ver los detalles del cónyuge (nombre, SSN, fecha de nacimiento, email, teléfonos).</li>
                                    <li>Botones de acción rápida: Editar perfil, cambiar estado del caso, cambiar tipo de formulario (si aplica), ver el formulario fiscal correspondiente.</li>
                                    <li>Controles de visibilidad: Botones para colapsar o expandir todos los paneles de información.</li>
                                </ul>
                            </li>
                            <li><strong>Formularios Fiscales:</strong> Si se ha seleccionado un tipo de formulario (ej. 433A, 433B), el contenido de dicho formulario se mostrará debajo del bloque de información principal.</li>
                        </ul>
                        <hr>
                        <h6><i class="ri-sticky-note-2-line me-1"></i> Notes (Notas)</h6>
                        <p>Esta sección es para la comunicación interna del equipo y el seguimiento de interacciones o detalles importantes sobre el cliente:</p>
                        <ul>
                            <li><strong>Agregar Notas:</strong> Escribe en el área de texto. Puedes usar formato enriquecido y @mencionar a otros usuarios del equipo.</li>
                            <li><strong>Ver Notas:</strong> Las notas existentes se muestran en una lista cronológica.</li>
                            <li><strong>Funcionalidades:</strong> Editor de texto enriquecido, menciones a usuarios.</li>
                        </ul>
                        <hr>
                        <h6><i class="ri-folder-open-line me-1"></i> File Manager (Administrador de Archivos)</h6>
                        <p>Gestiona todos los documentos relacionados con el cliente:</p>
                        <ul>
                            <li><strong>Subir Archivos:</strong> Arrastra y suelta archivos en la zona designada ("Drop files here or click to upload") o haz clic para seleccionarlos desde tu computadora.</li>
                            <li><strong>Ver Archivos:</strong> Los archivos subidos se listan con su nombre, tamaño y fecha. Puedes descargarlos o previsualizarlos si el formato es compatible.</li>
                            <li><strong>Organización:</strong> Puedes crear carpetas para organizar mejor los archivos.</li>
                        </ul>
                        <hr>
                        <h6><i class="ri-drag-move-2-line me-1"></i> Personalización General</h6>
                        <ul>
                            <li><strong>Paneles Colapsables:</strong> La mayoría de las secciones (Notas, Administrador de Archivos, Ayuda) tienen un ícono de flecha <i class="ri-arrow-down-s-line"></i> en su encabezado para mostrar u ocultar su contenido.</li>
                            <li><strong>Arrastrar y Soltar:</strong> Puedes reorganizar las secciones (Notas, Administrador de Archivos, Ayuda) arrastrándolas desde su encabezado y soltándolas en la columna deseada.</li>
                            <li><strong>Cambio de Color:</strong> Cada panel tiene un icono de paleta <i class="ri-palette-line"></i> para cambiar el color de su encabezado y un icono de reinicio <i class="ri-arrow-go-back-line"></i> para volver al color por defecto.</li>
                        </ul>
                    </div>
                </div>
            </div>

          </div>

          <div id="center-column" class="drop-column col-sm-12 col-12 order-0 order-md-1 px-2">
            <input type="hidden" name="client_idx" id="client_idx" value="{{$client->id}}">

            <div class="card client-header-card mb-4" id="card-client-header">
                <div class="row gy-3">
                    <div class="col-lg-12">
                        @php
                            $textStatusMap = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ];
                            $textColorStatusMap = [
                                1 => 'text-status-unknown',
                                2 => 'text-status-open',
                                3 => 'text-status-closed',
                                4 => 'text-status-inprogress',
                                5 => 'text-status-hold'
                            ];
                            $currentStatus = $client->case_status ?? 1;
                            $statusText = $textStatusMap[$currentStatus] ?? 'Unknown';
                            $statusTextColorClass = $textColorStatusMap[$currentStatus] ?? 'text-status-unknown';

                            $clientFullName = trim( ($client->first_name ?? '') . ' ' . (!empty($client->mi) ? $client->mi . '. ' : '') . ($client->last_name ?? '') );
                            if (empty($clientFullName)) $clientFullName = null;

                            $spouseFullName = null;
                            $isMarried = false;
                            if (isset($client->marital_status)) {
                                $status_val = (string)$client->marital_status;
                                if ($status_val === '2' || $client->marital_status === true) {
                                    $isMarried = true;
                                }
                            }
                            if ($isMarried) {
                                $spouseFullName = trim( ($client->spouse_first_name ?? '') . ' ' . (!empty($client->spouse_mi) ? $client->spouse_mi . '. ' : '') . ($client->spouse_last_name ?? '') );
                                if (empty($spouseFullName)) $spouseFullName = null;
                            }
                        @endphp

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Status:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    <h6 class="mb-0 fw-medium {{ $statusTextColorClass }}" style="font-size: 0.9rem;">{{ $statusText }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Full Name:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$clientFullName ? 'value-unknown' : '' }}">{{ $clientFullName ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">SSN:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    <span class="ssn-mask {{ !$client->ssn ? 'value-unknown' : '' }}" id="ssn-display-table-left" @if($client->ssn) data-full-ssn="{{ $client->ssn }}" @endif>
                                                        {!! $client->ssn ? '***-**-'.substr($client->ssn, -4) : '<span class="value-unknown">Unknown</span>' !!}
                                                    </span>
                                                    @if($client->ssn)
                                                        <i class="ri-eye-line cursor-pointer ms-1" id="toggle-ssn-table-left" style="font-size: 0.9rem; vertical-align: middle;" onclick="toggleClientSSNTable('left')"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Date of Birth:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->date_birdth ? 'value-unknown' : '' }}">{{ $client->date_birdth ? \Carbon\Carbon::parse($client->date_birdth)->format('m/d/Y') : 'Unknown' }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Address:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    <span class="{{ !($client->address_1 || $client->city) ? 'value-unknown' : '' }}">
                                                        {{ $client->address_1 ?? '' }}@if($client->address_1 && $client->city),@endif {{ $client->city ?? '' }}
                                                        @if(!($client->address_1 || $client->city)) Unknown @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Email:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->tax_payer_email) <a href="mailto:{{ $client->tax_payer_email }}">{{ $client->tax_payer_email }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Phone (Home):</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->phone_home) <a href="tel:{{ $client->phone_home }}">{{ $client->phone_home }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Cellphone:</td>
                                                <td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->cell_home) <a href="tel:{{ $client->cell_home }}">{{ $client->cell_home }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <script>
                            function toggleClientSSNTable(side) {
                                const ssnDisplayElement = document.getElementById(`ssn-display-table-${side}`);
                                const toggleIconElement = document.getElementById(`toggle-ssn-table-${side}`);
                                const fullSSN = ssnDisplayElement.dataset.fullSsn;
                                if (!fullSSN) return;
                                if (toggleIconElement.classList.contains('ri-eye-line')) {
                                    ssnDisplayElement.textContent = fullSSN;
                                    toggleIconElement.classList.remove('ri-eye-line');
                                    toggleIconElement.classList.add('ri-eye-off-line');
                                } else {
                                    ssnDisplayElement.innerHTML = '***-**-' + fullSSN.substr(-4); // Use innerHTML if you might have spans for value-unknown
                                    toggleIconElement.classList.remove('ri-eye-off-line');
                                    toggleIconElement.classList.add('ri-eye-line');
                                }
                            }
                        </script>

                        <div class="row mt-2"> <div class="col-12"> <table class="table table-sm table-borderless mb-0"><tbody><tr><td style="font-weight: 500; padding: .2rem 0.1rem .2rem 0; vertical-align: top; width: auto; white-space:nowrap;">Marital Status:</td> <td style="background-color:var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem 0.2rem; word-break: break-word; vertical-align: top;"> @if($isMarried) <span class="badge bg-label-secondary fs-xs">Married</span> <button class="btn btn-xs btn-link p-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#spouseInfoCollapse" aria-expanded="false" aria-controls="spouseInfoCollapse" style="font-size: 0.7rem; vertical-align: baseline; text-decoration: none;"> Spouse Details <i class="ri-arrow-down-s-line"></i> </button> @elseif(isset($client->marital_status) && ((string)$client->marital_status === '1' || (string)$client->marital_status === 'false')) <span class="badge bg-label-secondary fs-xs">Single</span> @else <span class="badge bg-label-light fs-xs value-unknown">{{ $client->marital_status ? 'Other' : 'Unknown' }}</span> @endif </td> </tr></tbody></table> </div> </div>

                        @if($isMarried)
                        <div class="collapse mt-1 mb-2" id="spouseInfoCollapse">
                            <h6 class="mb-1 mt-2"><i class="ri-user-heart-line me-1"></i>Spouse Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tbody>
                                                <tr><td style="width: 30%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Full Name:</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$spouseFullName ? 'value-unknown' : '' }}">{{ $spouseFullName ?? 'Unknown' }}</span></td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">SSN:</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="ssn-mask {{ !$client->spouse_ssn ? 'value-unknown' : '' }}" id="spouse-ssn-display-table" @if($client->spouse_ssn) data-full-ssn="{{ $client->spouse_ssn }}" @endif>{!! $client->spouse_ssn ? '***-**-'.substr($client->spouse_ssn, -4) : '<span class="value-unknown">Unknown</span>' !!}</span>@if($client->spouse_ssn)<i class="ri-eye-line cursor-pointer ms-1" id="toggle-spouse-ssn-table" style="font-size: 0.9rem; vertical-align: middle;" onclick="toggleSpouseSSNTable()"></i>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Date of Birth:</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->spouse_date_birdth ? 'value-unknown' : '' }}">{{ $client->spouse_date_birdth ? \Carbon\Carbon::parse($client->spouse_date_birdth)->format('m/d/Y') : 'Unknown' }}</span></td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Marital Date:</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->marital_date ? 'value-unknown' : '' }}">{{ $client->marital_date ? \Carbon\Carbon::parse($client->marital_date)->format('m/d/Y') : 'Unknown' }}</span></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tbody>
                                                <tr><td style="width: 35%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Email:</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_email) <a href="mailto:{{ $client->spouse_email }}">{{ $client->spouse_email }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Phone (Home):</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_phone_home) <a href="tel:{{ $client->spouse_phone_home }}">{{ $client->spouse_phone_home }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Cellphone:</td><td style="background-color: var(--theme-bg-card-alt); border: 1px solid var(--theme-border-soft); border-radius: var(--theme-border-radius-sm); padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_cell_home) <a href="tel:{{ $client->spouse_cell_home }}">{{ $client->spouse_cell_home }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function toggleSpouseSSNTable() {
                                    const ssnDisplayElement = document.getElementById('spouse-ssn-display-table');
                                    const toggleIconElement = document.getElementById('toggle-spouse-ssn-table');
                                    const fullSSN = ssnDisplayElement.dataset.fullSsn;
                                    if (!fullSSN) return;
                                    if (toggleIconElement.classList.contains('ri-eye-line')) {
                                        ssnDisplayElement.textContent = fullSSN;
                                        toggleIconElement.classList.remove('ri-eye-line');
                                        toggleIconElement.classList.add('ri-eye-off-line');
                                    } else {
                                        ssnDisplayElement.innerHTML = '***-**-' + fullSSN.substr(-4);
                                        toggleIconElement.classList.remove('ri-eye-off-line');
                                        toggleIconElement.classList.add('ri-eye-line');
                                    }
                                }
                            </script>
                        </div>
                        @endif

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3">
                            <div class="d-flex align-items-center gap-2">
                                {{-- Botones de preset de layout eliminados ya que la mayoría no aplican --}}
                                <div class="btn-group">
                                    <button class="btn btn-icon btn-sm btn-outline-secondary toggle-all-cards-icon-btn" type="button" data-action="collapse" title="Collapse All Panels"> <i class="ri-subtract-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary toggle-all-cards-icon-btn" type="button" data-action="expand" title="Expand All Panels"> <i class="ri-add-line ri-small"></i> </button>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <div class="client-mini-actions d-flex align-items-center">
                                    <a href="javascript:;" class="btn btn-icon btn-sm btn-text-secondary rounded-pill item-edit edit-client" data-idx="{{$client->id}}" title="Edit Profile">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                    <div class="btn-group ms-1">
                                        <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill dropdown-toggle waves-effect" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change Status">
                                            <i class="ri-flag-line"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end fs-sm">
                                            @php if(!isset($textStatusMapForDropdown)) { $textStatusMapForDropdown = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ]; } @endphp
                                            @foreach($textStatusMapForDropdown as $code => $text)
                                                <li><a class="dropdown-item change-case-status" href="javascript:;" data-idx="{{ $client->id }}" data-case="{{ $code }}">Set {{ $text }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="btn-group ms-1">
                                        <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill dropdown-toggle waves-effect" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change Form">
                                            <i class="ri-settings-3-line"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end fs-sm">
                                            <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433A">Set 433A</a></li>
                                            <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433B">Set 433B</a></li>
                                            <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433A OIC">Set 433A OIC</a></li>
                                            <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433B OIC">Set 433B OIC</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <a href="javascript:;" id="btn-show-form" data-form-type="{{$client->form_type}}" class="btn btn-xs btn-primary waves-effect waves-light {{ !$client->form_type ? 'd-none' : '' }}"> <i class="ri-printer-line ri-tiny align-middle me-1"></i> View {{ $client->form_type ?? 'View Form' }} </a>
                                <a href="javascript:;" id="btn-show-profile" data-form-type="{{$client->form_type}}" class="d-none btn btn-xs btn-primary waves-effect waves-light"> Hide form info </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="collapseProfileContent" class="collapse {{ request()->get('profile_collapsed') === 'true' ? '' : 'show' }} mb-4">
                 {{-- If you have a general profile tab section (like user-profile-tabs from old code), include it here --}}
                 {{-- @include('client.partials.tab-profile') --}}
            </div>

            <div class="tab-content-wrapper mb-4">
                @php $current_form_type = isset($client) ? $client->form_type : null; @endphp
                @if($current_form_type === '433A' || $current_form_type === '433A OIC')
                    @include('client.partials.tab-433a')
                @elseif($current_form_type === '433B' || $current_form_type === '433B OIC')
                    @include('client.partials.tab-433b')
                @endif
            </div>

          </div>

          {{-- <div id="right-column" class="drop-column col-sm-12 col-12 order-2 px-2"> --}}
            {{-- This column is removed as no cards are designated for it --}}
          {{-- </div> --}}

        </div>
    </div>
  </div>

</div>


{{-- Modals --}}
<!-- Invite Client to Portal Modal (kept as it might be useful, though not directly requested for modification) -->
<div class="modal fade" id="inviteClientModal" tabindex="-1" aria-labelledby="inviteClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteClientModalLabel">Invite Client to Portal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="inviteClientSpinner" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p id="inviteClientSpinnerMessage">Checking client portal status...</p>
                </div>

                <div id="inviteClientFormContainer">
                    <input type="hidden" id="inviteClientEmailHidden" value="">
                    <input type="hidden" id="inviteClientNameHidden" value="">

                    <!-- Create User Form (Initially hidden) -->
                    <form id="createUserForm" style="display: none;">
                        <p>This client does not have a portal account yet. Create one below:</p>
                        <div class="mb-3">
                            <label for="createUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="createUserName" required>
                        </div>
                        <div class="mb-3">
                            <label for="createUserEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="createUserEmail" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="createUserPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="createUserPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="createUserPasswordConfirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="createUserPasswordConfirm" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create Portal Account</button>
                    </form>

                    <!-- Change Password Form (Initially hidden) -->
                    <form id="changePasswordForm" style="display: none;">
                        <p>This client already has a portal account. You can reset their password below:</p>
                        <div class="mb-3">
                            <label for="changePasswordEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="changePasswordEmail" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="changePasswordNew" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="changePasswordNew" required>
                        </div>
                        <div class="mb-3">
                            <label for="changePasswordNewConfirm" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="changePasswordNewConfirm" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Change Password</button>
                    </form>
                </div>
                <div id="inviteClientError" class="alert alert-danger mt-3" style="display: none;"></div>
                <div id="inviteClientSuccess" class="alert alert-success mt-3" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>


@include('client.modal.new')
@include('client.modal.add-task') {{-- This modal might be for a removed feature, but keeping it for now --}}
@endsection


@section('scripts')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
<script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.min.js"></script>
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.css">
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.6/purify.min.js"></script>

<script>
jQuery(document).ready(function($) {

    const client_id_val = $('#client_idx').val();
    const layoutStorageKey = 'clientLayout_v2_' + client_id_val; // Changed key to avoid conflict with old layout
    let psInstances = {};
    // const moreInfoTabContentId = 'more-info-dynamic-tab-content'; // Removed as card-tabbed-content is removed
    let initialDefaultLayout = null;

    function getContrastYIQ(hexcolor){
        if (!hexcolor) return 'var(--theme-primary-text-on-light)';
        hexcolor = hexcolor.replace("#", "");
        if (hexcolor.startsWith('rgb')) { // Handle rgb(a)
            let rgbValues = hexcolor.match(/\d+/g);
            if (rgbValues && rgbValues.length >= 3) {
                const r = parseInt(rgbValues[0]);
                const g = parseInt(rgbValues[1]);
                const b = parseInt(rgbValues[2]);
                const yiq = ((r*299)+(g*587)+(b*114))/1000;
                return (yiq >= 128) ? 'var(--theme-text-dark)' : 'var(--theme-text-inverted)';
            }
            return 'var(--theme-primary-text-on-light)'; // Fallback for invalid rgb
        }
        if (hexcolor.length === 3) {
            hexcolor = hexcolor.split('').map(function (hex) { return hex + hex; }).join('');
        }
        const r = parseInt(hexcolor.substr(0,2),16);
        const g = parseInt(hexcolor.substr(2,2),16);
        const b = parseInt(hexcolor.substr(4,2),16);
        const yiq = ((r*299)+(g*587)+(b*114))/1000;
        return (yiq >= 128) ? 'var(--theme-text-dark)' : 'var(--theme-text-inverted)';
    }

    function initializeScrollbars() {
        $('.perfect-scrollbar').each(function() {
            const psElement = this;
            if ($(psElement).data('ps-id') && psInstances[$(psElement).data('ps-id')]) {
                try { psInstances[$(psElement).data('ps-id')].destroy(); } catch (e) {}
                delete psInstances[$(psElement).data('ps-id')];
            }
        });
        psInstances = {}; // Clear all stored instances

        $('.perfect-scrollbar').each(function() {
            if ($(this).is(':visible') && ($(this).closest('.collapse').length === 0 || $(this).closest('.collapse').hasClass('show'))) {
                try {
                    const elementTrackerId = $(this).attr('id') || 'ps-' + Math.random().toString(36).substr(2, 9);
                    if (!$(this).attr('id')) $(this).attr('id', elementTrackerId);
                    psInstances[elementTrackerId] = new PerfectScrollbar(this, { wheelPropagation: false, suppressScrollX: true });
                    $(this).data('ps-id', elementTrackerId);
                } catch (e) { console.error("Error initializing PS:", this, e); }
            }
        });
    }

    function updateScrollbars() {
        Object.keys(psInstances).forEach(key => {
            const $el = $('#' + key);
            if ($el.length && psInstances[key] && psInstances[key].update && $el.is(':visible')) {
                const $collapseParent = $el.closest('.collapse');
                if (!($collapseParent.length > 0 && !$collapseParent.hasClass('show'))) {
                    try { psInstances[key].update(); } catch (e) { console.error("Error updating PS for " + key + ":", e); }
                }
            }
        });
        // Logic for updating scrollbars in active tabs removed as card-tabbed-content is removed
    }

    function removeColumnClasses($el) {
        $el.removeClass((index, className) => (className.match(/(^|\s)col-(xl|lg|md|sm)-\d+/g) || []).join(' ') + ' ' + (className.match(/(^|\s)d-(xl|lg|md|sm|xs)-none/g) || []).join(' '));
    }

    function updateColumnLayout() {
        const $leftCol = $('#left-column'), $centerCol = $('#center-column') // $rightCol removed
        const leftCount = $leftCol.find('.draggable-card:not(.ui-sortable-placeholder)').length;
        // const rightCount = $rightCol.find('.draggable-card:not(.ui-sortable-placeholder)').length; // rightCol removed

        removeColumnClasses($leftCol); removeColumnClasses($centerCol); // $rightCol removed
        $leftCol.addClass('col-12 order-1 order-md-0 px-2');
        $centerCol.addClass('col-12 order-0 order-md-1 px-2');
        // $rightCol.addClass('col-12 order-2 px-2'); // rightCol removed

        ['md', 'lg', 'xl'].forEach(bp => {
            let lw, cw; // rw removed
            // Simplified layout: left column for draggable cards, center for main info
            // If left column has cards, use a split like 4/8, 3/9. If not, center is full width.
            const widths = {
                leftAndCenter: { md: [4,8], lg: [4,8], xl: [3,9] },
                centerOnly: { md: [0,12], lg: [0,12], xl: [0,12] }
            };

            if (leftCount > 0) [lw,cw] = widths.leftAndCenter[bp];
            else [lw,cw] = widths.centerOnly[bp];


            if (lw > 0) $leftCol.addClass(`col-${bp}-${lw}`).removeClass(`d-${bp}-none`); else $leftCol.addClass(`d-${bp}-none`);
            if (cw > 0) $centerCol.addClass(`col-${bp}-${cw}`);
            // $rightCol logic removed
        });
        setTimeout(updateScrollbars, 50);
    }

    function getLayoutFromDOM(captureCollapseState = false) {
        const layout = [];
        // $('.drop-column, #' + moreInfoTabContentId).each(function() { // moreInfoTabContentId removed
        $('.drop-column').each(function() {
            const columnId = this.id;
            $(this).children('.draggable-card:not(.ui-sortable-placeholder)').each(function(index) {
                const card = $(this); const cardId = card.attr('id'); if (!cardId) return;
                let cardData = { id: cardId, column: columnId, order: index };
                const $header = card.find('.card-header').first();
                cardData.headerColor = $header.css('background-color');
                cardData.headerTextColor = $header.find('.card-title').css('color');
                if (captureCollapseState) {
                    const $collapse = card.find('> .collapse').first();
                    if ($collapse.length) cardData.isExpanded = $collapse.hasClass('show');
                }
                // if (columnId === moreInfoTabContentId) cardData.isTabInMoreInfo = true; // Removed
                layout.push(cardData);
            });
        });
        return layout;
    }

    // function rebuildMoreInfoTabs(justDroppedCardId = null) { // Function removed
    // }

    function getCurrentLayout() { return getLayoutFromDOM(true); }

    function saveLayout(layoutToSave) {
        try {
            localStorage.setItem(layoutStorageKey, JSON.stringify(layoutToSave || getCurrentLayout()));
        } catch (e) { console.error('Failed to save layout:', e); if (typeof toast_msg === 'function') toast_msg('Failed to save layout!', 'error', 'Error'); }
    }

    function applyLayout(layoutData) {
        if (!layoutData || layoutData.length === 0) return false;
        const allCards = {}; $('.draggable-card').each(function() { if(this.id) allCards[this.id] = $(this).detach(); });
        // const colContent = { 'left-column': [], 'center-column': [], 'right-column': [], [moreInfoTabContentId]: [] }; // Simplified
        const colContent = { 'left-column': [], 'center-column': [] };


        layoutData.forEach(item => {
            if (!item || !item.id || !item.column) return;
            const $card = allCards[item.id];
            if ($card && $card.length && colContent[item.column]) {
                colContent[item.column][item.order] = $card;
                const $header = $card.find('.card-header').first();
                if (item.headerColor) $header.css('background-color', item.headerColor);
                if (item.headerTextColor) {
                    $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
                           .css('color', item.headerTextColor);
                    $header.find('button[title="Chat Settings"]').css('color', item.headerTextColor).css('border-color', item.headerTextColor); // This button might be gone if it was only in chat
                }
                // if (item.column !== moreInfoTabContentId) { // Simplified
                //     $card.removeClass('tab-pane fade show active').removeData('is-tabbed');
                //     $header.show();
                // }
                $card.removeClass('tab-pane fade show active').removeData('is-tabbed'); // No tabs anymore
                $header.show();

                if (item.isExpanded !== undefined) {
                    const $collapse = $card.find('> .collapse').first();
                    const $btn = $card.find('.card-header [data-bs-toggle="collapse"]').first();
                    if ($collapse.length) {
                        let bsCollapse = bootstrap.Collapse.getInstance($collapse[0]) || new bootstrap.Collapse($collapse[0], { toggle: false });
                        if (item.isExpanded) { if (!$collapse.hasClass('show')) bsCollapse.show(); if ($btn.length) $btn.removeClass('collapsed').attr('aria-expanded', 'true'); }
                        else { if ($collapse.hasClass('show')) bsCollapse.hide(); if ($btn.length) $btn.addClass('collapsed').attr('aria-expanded', 'false'); }
                    }
                }
            }
        });
        for (const colId in colContent) {
            const $target = $(`#${colId}`); if (!$target.length) continue;
            colContent[colId].filter(Boolean).forEach($c => $target.append($c));
        }
        // rebuildMoreInfoTabs(); // Removed
        return true;
    }

    const presets = { // Simplified presets
        default: [
            { id: 'card-notes', column: 'left-column', order: 0, isExpanded: true },
            { id: 'card-file-manager', column: 'left-column', order: 1, isExpanded: false },
            { id: 'card-help', column: 'left-column', order: 2, isExpanded: false },
        ]
        // Other presets removed as they relied on more columns/tabbed content
    };

    function resetAllHeaderColorsToDefault() {
        $('.draggable-card .card-header').each(function() {
            const $header = $(this);
            $header.css('background-color', '');
            const defaultTextColor = 'var(--theme-primary-text-on-light)';
            $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
                   .css('color', '');
            // const $chatSettingsBtn = $header.find('button[title="Chat Settings"]'); // Chat card removed
            // if ($chatSettingsBtn.length) {
            //     $chatSettingsBtn.css('color', '').css('border-color', '');
            // }
        });
    }

    function applyPreset(presetName) { // This function is less relevant now with only one preset
        const presetData = presets[presetName];
        if (!presetData) { if (typeof toast_msg === 'function') toast_msg('Preset not found!', 'error', 'Error'); return; }
        resetAllHeaderColorsToDefault();
        if (applyLayout(presetData)) {
            updateColumnLayout(); saveLayout(presetData);
            if (typeof toast_msg === 'function') toast_msg(`${presetName.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())} layout applied!`, 'success', 'Layout Applied');
        } else { if (typeof toast_msg === 'function') toast_msg('Failed to apply preset!', 'error', 'Error'); }
    }

    function restoreDefaultLayout() {
        if (confirm('Are you sure you want to restore the default layout? Your current custom layout will be lost.')) {
            resetAllHeaderColorsToDefault();
            if (applyLayout(presets.default)) {
                updateColumnLayout(); saveLayout(presets.default);
                if (typeof toast_msg === 'function') toast_msg('Default layout restored!', 'success', 'Success');
            } else { if (typeof toast_msg === 'function') toast_msg('Failed to restore default!', 'error', 'Error'); }
        }
    }

    function deleteSavedLayout() {
        if (confirm('Are you sure you want to delete your saved layout? This will revert to the default layout.')) {
            localStorage.removeItem(layoutStorageKey);
            resetAllHeaderColorsToDefault();
            if (applyLayout(presets.default)) updateColumnLayout();
            if (typeof toast_msg === 'function') toast_msg('Saved layout deleted. Default layout applied.', 'info', 'Layout Reset');
        }
    }

    function toggleAllCollapses(expand) {
        setTimeout(() => {
            $('.draggable-card').each(function() {
                const $card = $(this);
                // if ($card.data('is-tabbed')) { // No tabbed cards anymore
                //     const $collapseContent = $card.find('> .collapse').first();
                //      if ($collapseContent.length) {
                //         let bsCollapse = bootstrap.Collapse.getInstance($collapseContent[0]) || new bootstrap.Collapse($collapseContent[0], {toggle: false});
                //         if (!$collapseContent.hasClass('show')) bsCollapse.show();
                //     }
                //     return;
                // }
                const $collapseElement = $card.find('> .collapse').first();
                const $collapseButton = $card.find('.card-header [data-bs-toggle="collapse"]').first();
                if ($collapseElement.length) {
                    let bsCollapse = bootstrap.Collapse.getInstance($collapseElement[0]) || new bootstrap.Collapse($collapseElement[0], {toggle: false});
                    const isShown = $collapseElement.hasClass('show');
                    if (expand && !isShown) {
                        bsCollapse.show();
                        if ($collapseButton.length) $collapseButton.removeClass('collapsed').attr('aria-expanded', 'true');
                    } else if (!expand && isShown) {
                        bsCollapse.hide();
                        if ($collapseButton.length) $collapseButton.addClass('collapsed').attr('aria-expanded', 'false');
                    }
                }
            });
            setTimeout(updateScrollbars, 400);
        }, 50);
    }

    const pageOverlay = $('#page-load-overlay');
    if (pageOverlay.length) {
        setTimeout(() => { pageOverlay.addClass('fade-out'); }, 50);
    }

    initialDefaultLayout = getLayoutFromDOM(true);
    // const sortableOpts = { connectWith: ".drop-column, #" + moreInfoTabContentId, handle: ".card-header", placeholder: "sortable-placeholder", forcePlaceholderSize: true, tolerance: "pointer", scroll: true, items: "> .draggable-card:not(.ui-sortable-disabled)", over: function() { $(this).addClass("ui-sortable-highlight"); }, out: function() { $(this).removeClass("ui-sortable-highlight"); }, start: function(e, ui) { ui.item.find(".card-color-input").hide(); }, stop: function(e, ui) { $(".drop-column, #" + moreInfoTabContentId).removeClass("ui-sortable-highlight"); if (ui.item.parent().attr("id") !== moreInfoTabContentId && (!ui.sender || ui.sender.attr("id") !== moreInfoTabContentId)) updateColumnLayout(); saveLayout(); setTimeout(updateScrollbars, 50); } };
    const sortableOpts = {
        connectWith: ".drop-column", // Only connect with other drop columns
        handle: ".card-header",
        placeholder: "sortable-placeholder",
        forcePlaceholderSize: true,
        tolerance: "pointer",
        scroll: true,
        items: "> .draggable-card:not(.ui-sortable-disabled)",
        over: function() { $(this).addClass("ui-sortable-highlight"); },
        out: function() { $(this).removeClass("ui-sortable-highlight"); },
        start: function(e, ui) { ui.item.find(".card-color-input").hide(); },
        stop: function(e, ui) {
            $(".drop-column").removeClass("ui-sortable-highlight");
            updateColumnLayout(); // Always update column layout as there's no special tab container
            saveLayout();
            setTimeout(updateScrollbars, 50);
        }
    };
    $(".drop-column").sortable(sortableOpts).disableSelection();
    // $("#" + moreInfoTabContentId).sortable({ ... }); // Removed

    let loadedLayout = false;
    const savedLayoutStr = localStorage.getItem(layoutStorageKey);
    if (savedLayoutStr) {
        try { const data = JSON.parse(savedLayoutStr); if (Array.isArray(data) && data.length > 0 && data.every(i => i.id && i.column)) { if(applyLayout(data)) loadedLayout = true; else localStorage.removeItem(layoutStorageKey); } else localStorage.removeItem(layoutStorageKey); }
        catch (e) { console.error('Failed to apply saved layout:', e); localStorage.removeItem(layoutStorageKey); }
    }
    if (!loadedLayout) applyLayout(presets.default); // Apply simplified default
    updateColumnLayout(); setTimeout(initializeScrollbars, 400);

    $('#client-layout-row').on('shown.bs.collapse hidden.bs.collapse', '.collapse', () => setTimeout(updateScrollbars, 360));
    $('#mainContentWrapperCollapse').on('shown.bs.collapse hidden.bs.collapse', () => setTimeout(updateScrollbars, 360));
    // $('#more-info-nav-tabs').on('shown.bs.tab', ...); // Removed
    // $(document).on('click', '.apply-preset-btn, .apply-preset-icon-btn', ...); // Apply preset buttons might be removed from HTML
    $('#restore-default-layout-btn').on('click', e => { e.preventDefault(); restoreDefaultLayout(); }); // This button might be in a removed card (quick actions)
    $('#delete-saved-layout-btn').on('click', e => { e.preventDefault(); deleteSavedLayout(); }); // This button might be in a removed card

    $(document).on('click', '.toggle-all-cards-icon-btn', function(e) { e.preventDefault(); toggleAllCollapses($(this).data('action') === 'expand'); });

    $(document).on('click', '.card-color-picker-btn', function() { $(this).siblings('.card-color-input').first().trigger('click'); });
    $(document).on('change', '.card-color-input', function() {
        const newBgColor = $(this).val(); const $header = $(this).closest('.card-header');
        $header.css('background-color', newBgColor);
        const newTextColor = getContrastYIQ(newBgColor);
        $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
               .css('color', newTextColor);
        // $header.find('button[title="Chat Settings"]').css('color', newTextColor).css('border-color', newTextColor); // Chat card removed
        saveLayout();
    });
    $(document).on('click', '.card-header-reset-color-btn', function() {
        const $header = $(this).closest('.card-header');
        $header.css('background-color', '');
        $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
               .css('color', '');
        // const $chatSettingsBtn = $header.find('button[title="Chat Settings"]'); // Chat card removed
        // if($chatSettingsBtn.length) $chatSettingsBtn.css('color', '').css('border-color', '');
        saveLayout();
    });

    let resizeTimer; $(window).on('resize', () => { clearTimeout(resizeTimer); resizeTimer = setTimeout(() => updateColumnLayout(), 200); });
    $(document).on('click', '.change-form-type, .change-case-status', function(e) {
        e.preventDefault();
        var _this = $(this);
        var isCaseStatus = _this.hasClass('change-case-status');
        var fieldName = isCaseStatus ? 'case_status' : 'form_type';
        var _value = isCaseStatus ? _this.attr('data-case') : _this.attr('data-type');
        var confirmationMsg = `Are you sure you want to change ${isCaseStatus ? 'case status' : 'form type'} to "${_value}"? This will reload the page.`;
        if (_value === '' && !isCaseStatus) confirmationMsg = 'Are you sure you want to clear the form type? This will reload the page.';

        if (!confirm(confirmationMsg)) return;

        var $dropdownButton = _this.closest('.btn-group').find('.dropdown-toggle');
        $dropdownButton.prop('disabled', true).append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ route('clients.update_info_question', ['id' => $client->id]) }}",
            type: 'PUT',
            data: { name: fieldName, value: _value },
            success: function(r) {
                toast_msg(r.msg || 'Update successful. Reloading...', r.type || 'success', r.title || 'Success');
                setTimeout(() => location.reload(), 1200);
            },
            error: function(jqXHR) {
                let errorMsg = `An error occurred while changing ${isCaseStatus ? 'case status' : 'form type'}.`;
                try { errorMsg = JSON.parse(jqXHR.responseText).message || errorMsg; } catch (e) {}
                toast_msg(errorMsg, "error", "Error");
            },
            complete: function() {
                if($dropdownButton.length) $dropdownButton.prop('disabled', false).find('.spinner-border').remove();
            }
        });
    });

    // Chat related event handlers removed

    // --- START: Invite Client to Portal Modal Logic (Kept as is) ---
    const inviteModalElement = document.getElementById('inviteClientModal');
    const inviteModal = inviteModalElement ? new bootstrap.Modal(inviteModalElement) : null;
    const inviteSpinner = $('#inviteClientSpinner');
    const inviteSpinnerMessage = $('#inviteClientSpinnerMessage');
    const inviteFormContainer = $('#inviteClientFormContainer');
    const createUserForm = $('#createUserForm');
    const changePasswordForm = $('#changePasswordForm');
    const inviteClientModalLabel = $('#inviteClientModalLabel');
    const inviteClientError = $('#inviteClientError');
    const inviteClientSuccess = $('#inviteClientSuccess');
    const currentClientId = $('#client_idx').val();

    function showElement(el) { el.show(); }
    function hideElement(el) { el.hide(); }

    function resetInviteModal() {
        hideElement(inviteSpinner);
        hideElement(createUserForm);
        hideElement(changePasswordForm);
        hideElement(inviteClientError);
        hideElement(inviteClientSuccess);
        if (createUserForm.length) createUserForm[0].reset();
        if (changePasswordForm.length) changePasswordForm[0].reset();
        inviteClientError.text('');
        inviteClientSuccess.text('');
        inviteClientModalLabel.text('Invite Client to Portal');
        inviteSpinnerMessage.text('Checking client portal status...');
        showElement(inviteFormContainer);
    }

    $('#inviteClientToPortalBtn').on('click', function(e) { // This button might be in a removed card (quick actions)
        e.preventDefault();
        if (!inviteModal) {
            console.error('Invite modal not initialized');
            return;
        }
        resetInviteModal();

        const clientEmail = $(this).data('client-email');
        const clientName = $(this).data('client-name');

        $('#inviteClientEmailHidden').val(clientEmail);
        $('#inviteClientNameHidden').val(clientName);

        if (!clientEmail) {
            inviteClientError.text('Client email is not available. Cannot proceed.').show();
            inviteModal.show();
            return;
        }
        if (!currentClientId) {
            inviteClientError.text('Client ID is not available. Cannot proceed.').show();
            inviteModal.show();
            return;
        }

        inviteModal.show();

        $.ajax({
            url: '{{ route("clients.portal.check_status") }}',
            type: 'POST',
            data: {
                email: clientEmail,
                client_id: currentClientId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            beforeSend: function() {
                inviteSpinnerMessage.text('Checking client portal status...');
                showElement(inviteSpinner);
                hideElement(inviteFormContainer);
                hideElement(inviteClientError);
                hideElement(inviteClientSuccess);
            },
            success: function(response) {
                hideElement(inviteSpinner);
                showElement(inviteFormContainer);
                if (response.exists) {
                    inviteClientModalLabel.text('Manage Client Portal Account');
                    $('#changePasswordEmail').val(clientEmail);
                    showElement(changePasswordForm);
                    hideElement(createUserForm);
                } else {
                    inviteClientModalLabel.text('Create Client Portal Account');
                    $('#createUserName').val(clientName || '');
                    $('#createUserEmail').val(clientEmail);
                    showElement(createUserForm);
                    hideElement(changePasswordForm);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                hideElement(inviteSpinner);
                showElement(inviteFormContainer);
                let errorMsg = 'Error checking user status: ';
                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMsg += jqXHR.responseJSON.message;
                } else if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                    errorMsg += Object.values(jqXHR.responseJSON.errors).flat().join(' ');
                } else {
                    errorMsg += (errorThrown || 'Please try again.');
                }
                inviteClientError.text(errorMsg).show();
            }
        });
    });

    createUserForm.on('submit', function(e) {
        e.preventDefault();
        hideElement(inviteClientError);
        hideElement(inviteClientSuccess);

        const name = $('#createUserName').val().trim();
        const email = $('#createUserEmail').val().trim();
        const password = $('#createUserPassword').val();
        const passwordConfirm = $('#createUserPasswordConfirm').val();

        if (!name) {
            inviteClientError.text('Name is required.').show(); return;
        }
        if (password !== passwordConfirm) {
            inviteClientError.text('Passwords do not match.').show(); return;
        }
        if (password.length < 8) {
            inviteClientError.text('Password must be at least 8 characters long.').show(); return;
        }
        if (!currentClientId) {
            inviteClientError.text('Client ID is not available for account creation.').show(); return;
        }

        $.ajax({
            url: '{{ route("clients.portal.create_user") }}',
            type: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                password_confirmation: passwordConfirm,
                client_id: currentClientId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            beforeSend: function() {
                inviteSpinnerMessage.text('Creating account...');
                showElement(inviteSpinner);
                hideElement(createUserForm);
                hideElement(changePasswordForm);
            },
            success: function(response) {
                hideElement(inviteSpinner);
                inviteClientSuccess.text(response.message || 'Portal account created successfully!').show();
                createUserForm[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                hideElement(inviteSpinner);
                showElement(createUserForm);
                let errorMsg = 'Failed to create portal account. ';
                if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                    errorMsg += Object.values(jqXHR.responseJSON.errors).flat().join(' ');
                } else if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMsg += jqXHR.responseJSON.message;
                } else {
                    errorMsg += (errorThrown || 'Please try again.');
                }
                inviteClientError.text(errorMsg).show();
            }
        });
    });

    changePasswordForm.on('submit', function(e) {
        e.preventDefault();
        hideElement(inviteClientError);
        hideElement(inviteClientSuccess);

        const email = $('#changePasswordEmail').val().trim();
        const newPassword = $('#changePasswordNew').val();
        const newPasswordConfirm = $('#changePasswordNewConfirm').val();

        if (newPassword !== newPasswordConfirm) {
            inviteClientError.text('New passwords do not match.').show(); return;
        }
        if (newPassword.length < 8) {
            inviteClientError.text('New password must be at least 8 characters long.').show(); return;
        }
        if (!currentClientId) {
            inviteClientError.text('Client ID is not available for password change.').show(); return;
        }

        $.ajax({
            url: '{{ route("clients.portal.change_password") }}',
            type: 'POST',
            data: {
                email: email,
                password: newPassword,
                password_confirmation: newPasswordConfirm,
                client_id: currentClientId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            beforeSend: function() {
                inviteSpinnerMessage.text('Changing password...');
                showElement(inviteSpinner);
                hideElement(changePasswordForm);
                hideElement(createUserForm);
            },
            success: function(response) {
                hideElement(inviteSpinner);
                inviteClientSuccess.text(response.message || 'Password changed successfully!').show();
                changePasswordForm[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                hideElement(inviteSpinner);
                showElement(changePasswordForm);
                let errorMsg = 'Failed to change password. ';
                if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                    errorMsg += Object.values(jqXHR.responseJSON.errors).flat().join(' ');
                } else if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMsg += jqXHR.responseJSON.message;
                } else {
                    errorMsg += (errorThrown || 'Please try again.');
                }
                inviteClientError.text(errorMsg).show();
            }
        });
    });

    if (inviteModalElement) {
        inviteModalElement.addEventListener('hidden.bs.modal', function () {
            resetInviteModal();
        });
    }
    // --- END: Invite Client to Portal Modal Logic ---


});
</script>

@include('client.js-cards-actions')
@include('client.js-profile')
@include('client.js-detail-client')
@include('client.js.mentions-notes')
@include('client.js.description-editor')
{{-- @include('client.js.js-task') --}} {{-- Task card removed --}}
@include('client.js.js-notes')

@php $formTypeForJs = $client->form_type ?? null; @endphp
@if($formTypeForJs === '433A' || $formTypeForJs === '433A OIC')
  @include('client.js.js-433a')
@elseif($formTypeForJs === '433B' || $formTypeForJs === '433B OIC')
    @include('client.js.js-433b-clients-general')
    @include('client.js.js-433b-assets-libiliaties')
    @include('client.js.js-433b-business-information')
    @include('client.js.js-433b-financial-information')
    @include('client.js.js-433b-income-expense')
@endif
@include('client.js.js-autocomplete')

@endsection