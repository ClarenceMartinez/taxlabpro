@extends('components.layout')
@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" /> {{-- Keep if used by file manager --}}
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

    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header {
        background-color: var(--theme-bg-card);
        border-bottom: 1px solid var(--theme-border-soft);
    }
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header .card-title,
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header .card-title-icon,
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header .card-color-picker-btn,
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header .card-header-reset-color-btn,
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header .btn-collapse {
        color: var(--theme-text-dark);
    }
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-header .card-title-icon {
        color: var(--theme-primary);
    }
    #card-tabbed-content.draggable-card:not([data-is-tabbed]) .card-body {
        background-color: var(--theme-bg-card);
    }

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

    #card-tabbed-content .nav-tabs, #user-profile-tabs .nav-tabs, .icon-tabs-container .icon-tabs {
        border-bottom: 1px solid var(--theme-border-soft);
    }
    #card-tabbed-content .nav-tabs {
        padding: 0.3rem 0.3rem 0 0.3rem;
        background-color: var(--theme-bg-card-alt);
        border-top-left-radius: var(--theme-border-radius-md);
        border-top-right-radius: var(--theme-border-radius-md);
    }
    #card-tabbed-content .nav-link, #user-profile-tabs .nav-link, .icon-tabs .nav-link {
        padding: 0.5rem 0.8rem;
        font-size: 0.8rem;
        border-bottom-width: 2px;
        margin-bottom: -1px;
        color: var(--theme-text-medium);
        border-color: transparent;
    }
    #card-tabbed-content .nav-link:hover, #user-profile-tabs .nav-link:hover, .icon-tabs .nav-link:hover {
        color: var(--theme-primary);
        border-bottom-color: var(--theme-primary-light);
    }
    #card-tabbed-content .nav-link.active, #user-profile-tabs .nav-link.active, .icon-tabs .nav-link.active {
        color: var(--theme-primary-dark);
        border-color: var(--theme-primary) !important;
        background-color: var(--theme-bg-card);
        font-weight: 600;
    }
    #card-tabbed-content .tab-content, #user-profile-tabs .tab-content {
        padding: 1rem;
        background-color: var(--theme-bg-card);
        border: 1px solid var(--theme-border-soft);
        border-top: none;
        border-bottom-left-radius: var(--theme-border-radius-md);
        border-bottom-right-radius: var(--theme-border-radius-md);
    }
    .icon-tabs-container { padding: 0.1rem 0.3rem; background-color: var(--theme-bg-card-alt); }
    .icon-tabs .nav-link { padding: 0.3rem 0.5rem; font-size: 0.7rem; }
    .icon-tabs .nav-link .tab-icon { font-size: 0.9rem; }
    .icon-tabs .nav-link .tab-filename { font-size: 0.65rem; }

    .table-compact-transcripts th, .table-compact-transcripts td { padding: 0.3rem 0.5rem; font-size: 0.75rem; }
    .table-compact-transcripts th { background-color: var(--theme-bg-card-alt); }

    .notes-list-container, .chat-messages-container, .file-list-container {
        overflow-y: auto;
        padding-right: 5px;
        resize: vertical; 
        min-height: 150px;
    }
    #card-notes .notes-list-container { max-height: 350px; }
    #card-chat .chat-messages-container { max-height: 350px; padding: 0.3rem; }
    #card-file-manager .file-list-container { max-height: 200px; }

    #notes-list { background-color: var(--theme-bg-main); padding: 0.3rem; }
    #notes-list .card { margin-bottom: 0.3rem !important; border: 1px solid var(--theme-border-soft); }
    #notes-list .card-body { padding: 0.6rem 0.8rem; background-color: var(--theme-bg-card) !important; }
    #notes-list .avatar img { width: 24px !important; height: 24px !important; border-radius: 50%; }
    #notes-list .text-heading.h5 { font-size: 0.8rem !important; color: var(--theme-text-dark); }
    #notes-list .text-heading.h5 small { font-size: 0.65rem !important; color: var(--theme-text-medium); }
    #notes-list .card-body p.text-dark { font-size: 0.78rem !important; color: var(--theme-text-medium) !important; }
    #frm-add-notes textarea#note-textarea { min-height: 60px; background-color: var(--theme-bg-card); border-color: var(--theme-border-strong); }

    .chat-message { margin-bottom: 0.5rem; }
    .chat-message .message-content { padding: 0.5rem 0.8rem; border-radius: 12px; }
    .chat-message.sent .message-content { background-color: var(--theme-primary); color: var(--theme-text-inverted); }
    .chat-message.received .message-content { background-color: var(--theme-bg-card-alt); color: var(--theme-text-dark); border: 1px solid var(--theme-border-soft); }
    .chat-message .message-meta { font-size: 0.65rem; color: var(--theme-text-light); }
    .chat-input-group .form-control { background-color: var(--theme-bg-card); border-color: var(--theme-border-strong); }

    #card-file-manager .dropzone { padding: 1rem; min-height: 80px; border: 2px dashed var(--theme-border-strong); background-color: var(--theme-bg-card-alt); }
    #card-file-manager .dropzone.dz-drag-hover { background-color: var(--theme-primary-light); border-color: var(--theme-primary); }
    .file-list-compact .file-item-compact { padding: 0.4rem 0.1rem; font-size: 0.75rem; border-bottom: 1px solid var(--theme-border-soft); }
    .file-item-compact .file-icon img { width: 20px; }
    .file-item-compact .file-name { font-size: 0.8rem; color: var(--theme-primary); }
    .file-item-compact .file-meta { font-size: 0.65rem; color: var(--theme-text-light); }

    #card-notes .card-body, 
    #card-chat .card-body, 
    #card-file-manager .card-body,
    #card-transcripts .card-body,
    #card-history .card-body,
    #card-quick-actions .card-body,
    #card-tasks .card-body,
    #card-client-overview .card-body {
        background-color: var(--theme-bg-card-alt);
    }

    .ps__thumb-y, .ps__thumb-x { 
        background-color: var(--theme-primary) !important; opacity: 0.4; 
        border-radius: 3px !important;
    }
    .ps__thumb-y:hover, .ps__thumb-x:hover { opacity: 0.6; }
    .ps__rail-y, .ps__rail-x { background-color: transparent !important; opacity: 0 !important; }

    .badge { padding: 0.25em 0.5em; font-size: 0.7rem; font-weight: 500; border-radius: var(--theme-border-radius-sm); }

    #card-quick-actions .card-body a.fs-xs, 
    #card-quick-actions .card-body .quick-actions-layout-controls a {
        padding: 0.25rem 0.1rem; font-weight: 400; font-size: 0.75rem;
    }
    #card-quick-actions .card-body .btn-group .btn,
    #card-quick-actions .card-body a.btn.item-edit {
        margin-bottom: 0.3rem; font-size: 0.75rem;
    }

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

        #card-tabbed-content .nav-link, #user-profile-tabs .nav-link { padding: 0.4rem 0.6rem; font-size: 0.75rem; }
        #card-tabbed-content .nav-link .d-none.d-sm-block { display: none !important; }
        #card-tabbed-content .nav-link i.d-sm-none { display: inline-block !important; margin-right: 0 !important; }
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
            <p>Task Pending</p>
            <h5>23</h5> 
        </div>
        <div class="header-stat-item">
            <p>Task Completed</p>
            <h5>105</h5>
        </div>
        <div class="header-stat-item">
            <p>Deal</p>
            <h5>$7,988</h5> 
        </div>
        <div class="tax-owed-info"> 
            <p>Total Amount Owed</p>
            @php
                $summary = [
                'account_balance_plus_accruals' => 0,
                // ... other summary calculations if needed ...
                ];
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

             <div class="card sidebar-card draggable-card" id="card-quick-actions">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingQuickActions">
                    <i class="ri-sparkling-2-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Quick Actions</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuickActions" aria-expanded="false" aria-controls="collapseQuickActions" title="Toggle Quick Actions"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                 <div id="collapseQuickActions" class="collapse" aria-labelledby="headingQuickActions">
                    <div class="card-body">
                        <hr class="my-3">
                        <p class="mb-2 fs-xs fw-medium">Client Management:</p>
                        <a href="javascript:;" class="btn btn-xs btn-outline-primary item-edit edit-client mb-2" data-idx="{{$client->id}}"> <i class="ri-edit-line ri-tiny align-middle me-1"></i> Edit profile</a>
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-outline-secondary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-flag-line ri-tiny align-middle me-1"></i> Change Status </button>
                            <ul class="dropdown-menu dropdown-menu-end fs-sm">
                                @php $textStatusMapForDropdown = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ]; @endphp
                                @foreach($textStatusMapForDropdown as $code => $text)
                                    <li><a class="dropdown-item change-case-status" href="javascript:;" data-idx="{{ $client->id }}" data-case="{{ $code }}">Set {{ $text }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-outline-secondary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-settings-3-line ri-tiny align-middle me-1"></i> Change form </button>
                            <ul class="dropdown-menu dropdown-menu-end fs-sm">
                                <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433A">Set 433A</a></li>
                                <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433B">Set 433B</a></li>
                                <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433A OIC">Set 433A OIC</a></li>
                                <li><a class="dropdown-item change-form-type" href="javascript:;" data-idx="{{ $client->id }}" data-type="433B OIC">Set 433B OIC</a></li>
                            </ul>
                        </div>
                        <a href="#" class="fs-xs d-block">Invite client to portal</a>
                        <a href="/clients" class="fs-xs d-block">See all clients</a>
                         <hr class="my-3">
                         <p class="mb-2 fs-xs fw-medium">Quick files:</p>
                         <a class="dropdown-item waves-effect fs-xs ps-0 pb-1 pt-0 d-block" href="{{route('clients.pdf_f2848', $client->id)}}" target="_new"><i class="ri-printer-line ri-tiny me-1"></i>Form 2848</a>
                         <a class="dropdown-item waves-effect fs-xs ps-0 pb-1 pt-0 d-block" href="{{route('clients.pdf_f8821', $client->id)}}" target="_new"><i class="ri-printer-line ri-tiny me-1"></i>Form 8821</a>
                         <a class="dropdown-item waves-effect fs-xs ps-0 pb-1 pt-0 d-block" href="{{route('clients.pdf_f433a', $client->id)}}" target="_new"><i class="ri-printer-line ri-tiny me-1"></i>Form 433-A</a>
                         <a class="dropdown-item waves-effect fs-xs ps-0 pb-0 pt-0 d-block" href="{{route('clients.pdf_f433b', $client->id)}}" target="_new"><i class="ri-printer-line ri-tiny me-1"></i>Form 433-B</a>
                         <hr class="my-3">
                         <p class="mb-2 fs-xs fw-medium">Layout:</p>
                         <div class="quick-actions-layout-controls">
                             <a href="#" class="fs-xs d-block" id="delete-saved-layout-btn" style="color: var(--bs-danger);">Delete Saved Layout</a>
                             <a href="#" class="fs-xs d-block" id="restore-default-layout-btn">Restore Default Layout</a>
                        </div>
                        <hr class="my-3">
                        <p class="mb-2 fs-xs fw-medium">Visibility:</p>
                        <div class="quick-actions-layout-controls"> 
                            <a href="#" class="fs-xs d-block toggle-all-cards-icon-btn" data-action="collapse">Collapse All Panels</a>
                            <a href="#" class="fs-xs d-block toggle-all-cards-icon-btn" data-action="expand">Expand All Panels</a>
                        </div>
                    </div>
                 </div>
            </div>

            <div class="card sidebar-card draggable-card" id="card-client-overview">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingClientOverview">
                    <i class="ri-user-search-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Client Details</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClientOverview" aria-expanded="false" aria-controls="collapseClientOverview" title="Toggle Client Details"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseClientOverview" class="collapse" aria-labelledby="headingClientOverview">
                     @include('client.partials.overview')
                </div>
            </div>

            <div class="card right-sidebar-card draggable-card" id="card-tabbed-content">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingTabbedContent">
                    <i class="ri-information-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Tab Group</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTabbedContent" aria-expanded="false" aria-controls="collapseTabbedContent" title="Toggle More Info"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseTabbedContent" class="collapse" aria-labelledby="headingTabbedContent">
                    <div class="card-body p-0">
                        <div class="nav-align-top">
                            <ul class="nav nav-tabs nav-fill" role="tablist" id="more-info-nav-tabs"></ul>
                            <div class="tab-content" id="more-info-dynamic-tab-content" style="min-height: 100px; padding: 1rem; border: 1px solid #eeeeee; border-top:none; background-color: #ffffff;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card sidebar-card draggable-card" id="card-tasks">
              <div class="card-header d-flex justify-content-between align-items-center" id="headingTasks">
                <i class="ri-list-ordered card-title-icon"></i>
                <h6 class="card-title me-auto">Tasks</h6>
                <button class="btn btn-sm btn-outline-primary open-modal-task me-1" data-bs-toggle="modal" data-bs-target="#addTaskModal"> <!-- Added me-1 -->
                    + Add
                </button>
                <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                <input type="color" class="card-color-input">
                <div class="d-flex align-items-center"> 
                  <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTasks" aria-expanded="false" aria-controls="collapseTasks" title="Toggle Tasks">
                    <i class="ri-arrow-down-s-line"></i>
                  </button>
                </div>
              </div>
              <div id="collapseTasks" class="collapse" aria-labelledby="headingTasks">
                @include('client.partials.tasks')
              </div>
            </div>

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

            <div class="card right-sidebar-card draggable-card" id="card-chat">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingChat">
                    <i class="ri-chat-4-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Chat</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                     <button class="btn btn-icon btn-sm btn-outline-secondary rounded-pill me-1" type="button" title="Chat Settings" style="color: var(--theme-primary-text-on-light); border-color: var(--theme-primary-text-on-light);"> <i class="ri-settings-3-line ri-small"></i> </button>
                    <div class="d-flex align-items-center"> 
                        <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChat" aria-expanded="false" aria-controls="collapseChat" title="Toggle Chat"> <i class="ri-arrow-down-s-line"></i> </button>
                    </div>
                </div>
                <div id="collapseChat" class="collapse" aria-labelledby="headingChat">
                    @include('client.partials.chat')
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
            
            <div class="card right-sidebar-card draggable-card" id="card-transcripts">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingTranscripts">
                    <i class="ri-money-dollar-circle-line card-title-icon"></i>
                    <h6 class="card-title me-auto">Transcripts</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTranscripts" aria-expanded="false" aria-controls="collapseTranscripts" title="Toggle Transcripts"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseTranscripts" class="collapse" aria-labelledby="headingTranscripts">
                    @include('client.partials.transcripts')
                </div>
            </div>

            <div class="card right-sidebar-card draggable-card" id="card-history">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingHistory">
                    <i class="ri-history-line card-title-icon"></i>
                    <h6 class="card-title me-auto">History</h6>
                    <button class="btn btn-icon btn-sm rounded-pill card-header-reset-color-btn me-1" type="button" title="Reset Section Color"> <i class="ri-arrow-go-back-line ri-small"></i> </button>
                    <button class="btn btn-icon btn-sm rounded-pill card-color-picker-btn me-1" type="button" title="Change Section Color"> <i class="ri-palette-line ri-small"></i> </button>
                    <input type="color" class="card-color-input">
                    <button class="btn btn-icon btn-sm rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory" title="Toggle History"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory">
                    @include('client.partials.timeline')
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
                                <div class="btn-group">
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="default" title="Default Layout"> <i class="ri-layout-column-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="left_sidebar" title="Left Sidebar Layout"> <i class="ri-layout-left-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="right_sidebar" title="Right Sidebar Layout"> <i class="ri-layout-right-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="center_stacked" title="Center Stacked Layout"> <i class="ri-layout-top-line ri-small"></i> </button>
                                </div>
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

          <div id="right-column" class="drop-column col-sm-12 col-12 order-2 px-2">
          </div>

        </div> 
    </div> 
  </div> 

</div> 


{{-- Modals --}}
@include('client.modal.new')
@include('client.modal.add-task') 
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
<script src="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.min.js"></script>

<script>
jQuery(document).ready(function($) {

    const client_id_val = $('#client_idx').val();
    const layoutStorageKey = 'clientLayout_' + client_id_val;
    let psInstances = {};
    const moreInfoTabContentId = 'more-info-dynamic-tab-content';
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
        $('#' + moreInfoTabContentId + ' > .tab-pane.active .perfect-scrollbar').each(function() {
            const psId = $(this).data('ps-id');
            if (psId && psInstances[psId] && psInstances[psId].update && $(this).is(':visible')) {
                try { psInstances[psId].update(); } catch(e) { console.error("Error updating PS in active tab:", e); }
            }
        });
    }

    function removeColumnClasses($el) {
        $el.removeClass((index, className) => (className.match(/(^|\s)col-(xl|lg|md|sm)-\d+/g) || []).join(' ') + ' ' + (className.match(/(^|\s)d-(xl|lg|md|sm|xs)-none/g) || []).join(' '));
    }

    function updateColumnLayout() {
        const $leftCol = $('#left-column'), $centerCol = $('#center-column'), $rightCol = $('#right-column');
        const leftCount = $leftCol.find('.draggable-card:not(.ui-sortable-placeholder)').length;
        const rightCount = $rightCol.find('.draggable-card:not(.ui-sortable-placeholder)').length;

        removeColumnClasses($leftCol); removeColumnClasses($centerCol); removeColumnClasses($rightCol);
        $leftCol.addClass('col-12 order-1 order-md-0 px-2');
        $centerCol.addClass('col-12 order-0 order-md-1 px-2');
        $rightCol.addClass('col-12 order-2 px-2');

        ['md', 'lg', 'xl'].forEach(bp => {
            let lw, cw, rw;
            const widths = {
                standard: { md: [4,5,3], lg: [4,5,3], xl: [3,6,3] },
                leftCenter: { md: [4,8,0], lg: [4,8,0], xl: [3,9,0] },
                centerRight: { md: [0,8,4], lg: [0,8,4], xl: [0,9,3] },
                centerOnly: { md: [0,12,0], lg: [0,12,0], xl: [0,12,0] }
            };
            if (leftCount > 0 && rightCount > 0) [lw,cw,rw] = widths.standard[bp];
            else if (leftCount > 0) [lw,cw,rw] = widths.leftCenter[bp];
            else if (rightCount > 0) [lw,cw,rw] = widths.centerRight[bp];
            else [lw,cw,rw] = widths.centerOnly[bp];

            if (lw > 0) $leftCol.addClass(`col-${bp}-${lw}`).removeClass(`d-${bp}-none`); else $leftCol.addClass(`d-${bp}-none`);
            if (cw > 0) $centerCol.addClass(`col-${bp}-${cw}`);
            if (rw > 0) $rightCol.addClass(`col-${bp}-${rw}`).removeClass(`d-${bp}-none`); else $rightCol.addClass(`d-${bp}-none`);
        });
        setTimeout(updateScrollbars, 50);
    }

    function getLayoutFromDOM(captureCollapseState = false) {
        const layout = [];
        $('.drop-column, #' + moreInfoTabContentId).each(function() {
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
                if (columnId === moreInfoTabContentId) cardData.isTabInMoreInfo = true;
                layout.push(cardData);
            });
        });
        return layout;
    }

    function rebuildMoreInfoTabs(justDroppedCardId = null) {
        const $navTabs = $('#more-info-nav-tabs'), $tabContent = $('#' + moreInfoTabContentId);
        let activeTabSet = false;
        $navTabs.find('li[data-dynamic-tab="true"]').remove(); 
        $('#more-info-placeholder-msg').remove(); 

        $tabContent.children('.draggable-card').each(function(index) {
            const card = $(this), cardId = card.attr('id'); if (!cardId) return;
            const title = card.find('.card-header .card-title').text().trim() || card.find('.card-header h6').text().trim() || `Tab ${index + 1}`;
            const tabLinkId = `more-info-tablink-${cardId}`;
            card.find('.card-header').first().hide();
            const $collapse = card.find('> .collapse').first();
            if ($collapse.length) {
                let bsCollapse = bootstrap.Collapse.getInstance($collapse[0]) || new bootstrap.Collapse($collapse[0], { toggle: false });
                if (!$collapse.hasClass('show')) bsCollapse.show(); 
            } else card.find('.card-body').show();
            card.addClass('tab-pane fade').data('is-tabbed', true);
            $navTabs.append(`<li class="nav-item" role="presentation" data-dynamic-tab="true" data-controls-card="${cardId}"><button class="nav-link" id="${tabLinkId}" data-bs-toggle="tab" data-bs-target="#${cardId}" type="button" role="tab" aria-controls="${cardId}" aria-selected="false">${title}</button></li>`);
            if (justDroppedCardId === cardId || (!activeTabSet && index === 0)) {
                $navTabs.find('.nav-link.active').removeClass('active').attr('aria-selected', 'false');
                $tabContent.find('.tab-pane.active').removeClass('show active');
                $(`#${tabLinkId}`).addClass('active').attr('aria-selected', 'true');
                card.addClass('show active'); activeTabSet = true;
            }
        });
        if ($navTabs.find('li[data-dynamic-tab="true"]').length === 0) $tabContent.append('<p class="text-muted text-center p-3" id="more-info-placeholder-msg">Drag sections here to add them as tabs.</p>');
        setTimeout(updateScrollbars, 100); 
    }

    function getCurrentLayout() { return getLayoutFromDOM(true); }

    function saveLayout(layoutToSave) {
        try {
            localStorage.setItem(layoutStorageKey, JSON.stringify(layoutToSave || getCurrentLayout()));
        } catch (e) { console.error('Failed to save layout:', e); if (typeof toast_msg === 'function') toast_msg('Failed to save layout!', 'error', 'Error'); }
    }

    function applyLayout(layoutData) {
        if (!layoutData || layoutData.length === 0) return false;
        const allCards = {}; $('.draggable-card').each(function() { if(this.id) allCards[this.id] = $(this).detach(); });
        const colContent = { 'left-column': [], 'center-column': [], 'right-column': [], [moreInfoTabContentId]: [] };

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
                    $header.find('button[title="Chat Settings"]').css('color', item.headerTextColor).css('border-color', item.headerTextColor);
                }
                if (item.column !== moreInfoTabContentId) {
                    $card.removeClass('tab-pane fade show active').removeData('is-tabbed');
                    $header.show();
                }
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
        rebuildMoreInfoTabs(); return true;
    }
    
    const presets = {
        default: [ 
            { id: 'card-tasks', column: 'left-column', order: 0, isExpanded: false },
            { id: 'card-quick-actions', column: 'left-column', order: 1, isExpanded: false },
            { id: 'card-client-overview', column: 'left-column', order: 2, isExpanded: false }, 
            
            { id: 'card-notes', column: 'right-column', order: 0, isExpanded: false },
            { id: 'card-chat', column: 'right-column', order: 1, isExpanded: false },
            { id: 'card-tabbed-content', column: 'right-column', order: 2, isExpanded: true }, 
            { id: 'card-file-manager', column: 'right-column', order: 3, isExpanded: false },
            { id: 'card-transcripts', column: 'right-column', order: 4, isExpanded: false },
            { id: 'card-history', column: 'right-column', order: 5, isExpanded: false },
        ],
        left_sidebar: [ { id: 'card-client-overview', column: 'left-column', order: 0, isExpanded: true }, { id: 'card-tasks', column: 'left-column', order: 1, isExpanded: false }, { id: 'card-quick-actions', column: 'left-column', order: 2, isExpanded: false }, { id: 'card-notes', column: 'left-column', order: 3, isExpanded: false }, { id: 'card-chat', column: 'left-column', order: 4, isExpanded: false }, { id: 'card-tabbed-content', column: 'left-column', order: 5, isExpanded: true },  { id: 'card-file-manager', column: 'left-column', order: 6, isExpanded: false }, { id: 'card-transcripts', column: 'left-column', order: 7, isExpanded: false }, { id: 'card-history', column: 'left-column', order: 8, isExpanded: false } ],
        right_sidebar: [ { id: 'card-client-overview', column: 'right-column', order: 0, isExpanded: true }, { id: 'card-notes', column: 'right-column', order: 1, isExpanded: true }, { id: 'card-chat', column: 'right-column', order: 2, isExpanded: false }, { id: 'card-tabbed-content', column: 'right-column', order: 3, isExpanded: true }, { id: 'card-file-manager', column: 'right-column', order: 4, isExpanded: false }, { id: 'card-transcripts', column: 'right-column', order: 5, isExpanded: false }, { id: 'card-history', column: 'right-column', order: 6, isExpanded: false }, { id: 'card-tasks', column: 'right-column', order: 7, isExpanded: true }, { id: 'card-quick-actions', column: 'right-column', order: 8, isExpanded: false }, ],
        center_stacked: [ { id: 'card-client-overview', column: 'center-column', order: 0, isExpanded: true }, { id: 'card-tasks', column: 'center-column', order: 1, isExpanded: false }, { id: 'card-quick-actions', column: 'center-column', order: 2, isExpanded: false }, { id: 'card-notes', column: 'center-column', order: 3, isExpanded: false }, { id: 'card-chat', column: 'center-column', order: 4, isExpanded: false }, { id: 'card-tabbed-content', column: 'center-column', order: 5, isExpanded: true }, { id: 'card-file-manager', column: moreInfoTabContentId, order: 0, isExpanded: true, isTabInMoreInfo: true }, { id: 'card-history', column: moreInfoTabContentId, order: 1, isExpanded: true, isTabInMoreInfo: true }, { id: 'card-transcripts', column: 'center-column', order: 6, isExpanded: false } ]
    };

    function resetAllHeaderColorsToDefault() {
        $('.draggable-card .card-header').each(function() {
            const $header = $(this);
            $header.css('background-color', ''); 
            const defaultTextColor = 'var(--theme-primary-text-on-light)';
            $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
                   .css('color', ''); 
            const $chatSettingsBtn = $header.find('button[title="Chat Settings"]');
            if ($chatSettingsBtn.length) {
                $chatSettingsBtn.css('color', '').css('border-color', '');
            }
        });
    }

    function applyPreset(presetName) {
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
                if ($card.data('is-tabbed')) { 
                    const $collapseContent = $card.find('> .collapse').first();
                     if ($collapseContent.length) {
                        let bsCollapse = bootstrap.Collapse.getInstance($collapseContent[0]) || new bootstrap.Collapse($collapseContent[0], {toggle: false});
                        if (!$collapseContent.hasClass('show')) bsCollapse.show(); 
                    }
                    return; 
                }
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
    const sortableOpts = { connectWith: ".drop-column, #" + moreInfoTabContentId, handle: ".card-header", placeholder: "sortable-placeholder", forcePlaceholderSize: true, tolerance: "pointer", scroll: true, items: "> .draggable-card:not(.ui-sortable-disabled)", over: function() { $(this).addClass("ui-sortable-highlight"); }, out: function() { $(this).removeClass("ui-sortable-highlight"); }, start: function(e, ui) { ui.item.find(".card-color-input").hide(); }, stop: function(e, ui) { $(".drop-column, #" + moreInfoTabContentId).removeClass("ui-sortable-highlight"); if (ui.item.parent().attr("id") !== moreInfoTabContentId && (!ui.sender || ui.sender.attr("id") !== moreInfoTabContentId)) updateColumnLayout(); saveLayout(); setTimeout(updateScrollbars, 50); } };
    $(".drop-column").sortable(sortableOpts);
    $("#" + moreInfoTabContentId).sortable({ ...sortableOpts, receive: function(e, ui) { ui.item.removeClass("ui-sortable-helper"); rebuildMoreInfoTabs(ui.item.attr("id")); saveLayout(); setTimeout(updateScrollbars,100); }, remove: function(e, ui) { ui.item.removeClass("tab-pane fade show active ui-sortable-helper").removeData("is-tabbed"); ui.item.find(".card-header").first().show(); const cardId = ui.item.attr("id"); const layout = getCurrentLayout(); const cardState = layout.find(c => c.id === cardId); if (cardState && cardState.isExpanded !== undefined) { const $collapse = ui.item.find("> .collapse").first(); const $btn = ui.item.find(".card-header [data-bs-toggle='collapse']").first(); if($collapse.length) { let bsCollapse = bootstrap.Collapse.getInstance($collapse[0]) || new bootstrap.Collapse($collapse[0], {toggle: false}); if(cardState.isExpanded) bsCollapse.show(); else bsCollapse.hide(); if($btn.length) { if(cardState.isExpanded) $btn.removeClass("collapsed").attr("aria-expanded", "true"); else $btn.addClass("collapsed").attr("aria-expanded", "false"); } } } rebuildMoreInfoTabs(); updateColumnLayout(); saveLayout(); setTimeout(updateScrollbars,100); }, update: function(e, ui) { if (ui.sender == null) { rebuildMoreInfoTabs(ui.item.attr("id")); saveLayout(); setTimeout(updateScrollbars,100); } } }).disableSelection();
    
    let loadedLayout = false;
    const savedLayoutStr = localStorage.getItem(layoutStorageKey);
    if (savedLayoutStr) {
        try { const data = JSON.parse(savedLayoutStr); if (Array.isArray(data) && data.length > 0 && data.every(i => i.id && i.column)) { if(applyLayout(data)) loadedLayout = true; else localStorage.removeItem(layoutStorageKey); } else localStorage.removeItem(layoutStorageKey); }
        catch (e) { console.error('Failed to apply saved layout:', e); localStorage.removeItem(layoutStorageKey); }
    }
    if (!loadedLayout) applyLayout(presets.default);
    updateColumnLayout(); setTimeout(initializeScrollbars, 400); 

    $('#client-layout-row').on('shown.bs.collapse hidden.bs.collapse', '.collapse', () => setTimeout(updateScrollbars, 360));
    $('#mainContentWrapperCollapse').on('shown.bs.collapse hidden.bs.collapse', () => setTimeout(updateScrollbars, 360));
    $('#more-info-nav-tabs').on('shown.bs.tab', 'button[data-bs-toggle="tab"]', () => setTimeout(updateScrollbars, 50));
    $(document).on('click', '.apply-preset-btn, .apply-preset-icon-btn', function(e) { e.preventDefault(); applyPreset($(this).data('preset')); });
    $('#restore-default-layout-btn').on('click', e => { e.preventDefault(); restoreDefaultLayout(); });
    $('#delete-saved-layout-btn').on('click', e => { e.preventDefault(); deleteSavedLayout(); });
    $(document).on('click', '.toggle-all-cards-icon-btn', function(e) { e.preventDefault(); toggleAllCollapses($(this).data('action') === 'expand'); });
    
    $(document).on('click', '.card-color-picker-btn', function() { $(this).siblings('.card-color-input').first().trigger('click'); });
    $(document).on('change', '.card-color-input', function() {
        const newBgColor = $(this).val(); const $header = $(this).closest('.card-header');
        $header.css('background-color', newBgColor);
        const newTextColor = getContrastYIQ(newBgColor);
        $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
               .css('color', newTextColor);
        $header.find('button[title="Chat Settings"]').css('color', newTextColor).css('border-color', newTextColor);
        saveLayout(); 
    });
    $(document).on('click', '.card-header-reset-color-btn', function() {
        const $header = $(this).closest('.card-header');
        $header.css('background-color', ''); 
        $header.find('.card-title, .card-title-icon, .btn-collapse, .card-color-picker-btn i, .card-color-picker-btn, .card-header-reset-color-btn i, .card-header-reset-color-btn')
               .css('color', ''); 
        const $chatSettingsBtn = $header.find('button[title="Chat Settings"]');
        if($chatSettingsBtn.length) $chatSettingsBtn.css('color', '').css('border-color', '');
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

    $('#client-layout-row').on('click', '.chat-messages-container + .chat-input-group .btn-primary', function() { 
        const input = $(this).siblings('input'); const messageText = input.val().trim();
        if (messageText) {
            const timestamp = moment().format('MM/DD/YYYY hh:mm A'); const userName = "Your Name"; 
            const newMessageHtml = `<div class="chat-message sent"><div class="message-content">${$('<div>').text(messageText).html()}</div><div class="message-meta">${userName} - ${timestamp}</div></div>`;
            const container = $(this).closest('.card-body').find('.chat-messages-container');
            container.append(newMessageHtml); input.val(''); container.scrollTop(container[0].scrollHeight);
            const psId = container.data('ps-id'); if (psId && psInstances[psId] && psInstances[psId].update) { try { psInstances[psId].update(); } catch (e) { console.error("PS update error:", e); } }
        }
    });
    $('#client-layout-row').on('keypress', '.chat-messages-container + .chat-input-group input', function(e) { if (e.which == 13) { $(this).siblings('.btn-primary').click(); return false; } }); 
}); 
</script>

@include('client.js-cards-actions')
@include('client.js-profile')
@include('client.js-detail-client')
@include('client.js.mentions-notes')
@include('client.js.description-editor')
@include('client.js.js-task') 
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