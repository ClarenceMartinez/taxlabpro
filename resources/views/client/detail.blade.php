@extends('components.layout')
@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />

<style>
    body, .container-xxl, .card, .list-group-item, .btn, .form-control, .nav-link, .dropdown-item, .modal-content {
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #f4f5f7; 
    }<style>
    .table-compact-transcripts th,
    .table-compact-transcripts td {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        font-size: 0.8rem; /* Mantener tamaño de fuente de tabla */
        vertical-align: middle;
    }
    .table-compact-transcripts th {
        font-weight: 500;
        background-color: #f8f9fa; /* Fondo ligeramente gris para encabezados de fila */
    }

    /* Value coloring for transcript table */
    .value-income { color: #008000; /* Green */ font-weight: 500; }
    .value-tax { color: #FFA500; /* Orange/Yellow */ font-weight: 500; }
    .value-payment { color: #1976D2; /* Blue */ font-weight: 500; }
    .value-owed { color: #dc3545; /* Red */ font-weight: 500; }
    .value-overpayment { color: #008000; /* Green */ font-weight: 500; } /* Overpayment en verde */


    .btn-xs {
        padding: 0.1rem 0.4rem;
        font-size: 0.7rem; /* Botón más pequeño */
        line-height: 1.2; /* Ajuste de altura de línea */
        border-radius: 0.2rem;
    }

    /* --- Icon Tabs Compact --- */
    .icon-tabs-container {
        border-bottom: 1px solid #dee2e6;
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
        padding-bottom: 0;
        background-color: #f8f9fa;
    }

    .icon-tabs {
        border-bottom: none;
        margin-bottom: -1px; /* Overlap for active tab border */
        flex-wrap: nowrap;
        display: flex;
    }

    .icon-tabs .nav-item {
        margin-bottom: 0;
    }

    .icon-tabs .nav-link {
        display: flex;
        align-items: center;
        border: 1px solid transparent;
        border-bottom: none;
        border-top-left-radius: 0.25rem; /* Radio más pequeño */
        border-top-right-radius: 0.25rem; /* Radio más pequeño */
        padding: 0.3rem 0.5rem; /* Padding reducido para compacidad */
        font-size: 0.75rem; /* Tamaño de fuente reducido */
        color: #5a6570;
        background-color: #f0f2f5;
        transition: all 0.2s ease-in-out;
        margin-right: 2px; /* Margen reducido */
        text-align: left;
        min-height: auto; /* Altura mínima automática */
        /* box-shadow: 0 1px 1px rgba(0,0,0,0.04); */ /* Sombra más sutil o ninguna */
    }

    .icon-tabs .nav-link .tab-icon {
        font-size: 0.9rem; /* Icono más pequeño */
        margin-right: 0.25rem; /* Margen del icono reducido */
        color: #6c757d;
        line-height: 1;
    }

    .icon-tabs .nav-link .tab-text-content {
        display: flex;
        flex-direction: column;
        line-height: 1.1; /* Altura de línea ajustada */
    }

    .icon-tabs .nav-link .tab-filename {
        font-size: 0.65rem; /* Tamaño de fuente del nombre del archivo reducido */
        color: #777;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 90px; /* Ancho máximo ajustado para nombre de archivo */
    }

    .icon-tabs .nav-link:hover {
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6 #dee2e6 transparent;
    }

    .icon-tabs .nav-link.active {
        color: #0056b3;
        background-color: #ffffff;
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        border-top: 2px solid #007bff; /* Borde superior más delgado pero distintivo */
        border-bottom: 1px solid #ffffff;
        font-weight: 600;
        position: relative;
        z-index: 2;
        /* box-shadow: 0 -1px 2px rgba(0,0,0,0.05); */ /* Sombra superior sutil */
    }
    .icon-tabs .nav-link.active .tab-icon {
        color: #007bff;
    }
    .icon-tabs .nav-link.active .tab-filename {
        color: #0056b3;
        font-weight: 600;
    }
    /* --- End Icon Tabs --- */

    /* Style for the summary items in the grid */
    .summary-item {
        background-color: #f8f9fa;
        padding: 0.75rem;
        border-radius: 0.25rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .summary-item small {
        font-size: 0.75rem;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
        color: #6c757d;
    }
    .summary-item .fs-5 {
        font-size: 1.1rem !important;
    }

    /* Ensure card header elements are vertically aligned if they wrap on very small screens */
    .transcript-info-header {
        flex-grow: 1; /* Allow transcript info to take available space */
        margin-right: 0.5rem; /* Space before the button */
        white-space: nowrap; /* Prevent filename from wrapping under Tax Year if possible */
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .transcript-info-header h6, .transcript-info-header small {
        vertical-align: middle; /* Align text nicely */
    }

    .transcript-container .tab-content > .tab-pane > .card {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .container-xxl {
        padding-top: 0.8rem; 
        padding-bottom: 0.8rem;
        padding-left: 6px;
        padding-right: 6px;
    }
    /* --- START: Card Styling (General - Minimal) --- */
    .card {
        border: none; /* Remove default card border */
        box-shadow: none; /* Remove default card shadow */
        border-radius: 4px; /* Smaller border radius */
        background-color: #ffffff; /* White background */
        overflow: hidden; /* Clip content like border-radius */
    }

    /* Header styles common to all cards (except main wrapper header) */
    .card-header {
        background-color: #ffffff; 
        border-bottom: 1px solid #eeeeee; 
        padding: 0.3rem 0.6rem;
        font-weight: 500;
        font-size: 0.85rem;
        color: #495057;
        display: flex;
        align-items: center;
    }
    .card-header .card-title-icon {
        font-size: 1.1rem; /* Adjust icon size as needed */
        color: var(--bs-primary); /* Optional: color the icon */
        margin-right: 0.5rem;
        vertical-align: middle;
    }


    /* Special styling for card headers with the 'taby' class */
    .card-header.taby {
        display: block;
        padding: 0; /* Remove padding if tabs are directly in header */
    }

    .card-title {
        margin-bottom: 0;
        font-size: 0.85rem;
        font-weight: 500;
        color: #495057;
        flex-grow: 1;
    }

    .card-body {
        padding: 0.8rem 1rem; /* Reduced standard padding */
        font-size: 0.8rem; /* Default text size within card body */
        color: #555;
    }

    /* Compact card body padding (if still needed) - Further reduced */
    .card-body-compact { padding: 0.5rem 1rem; }
    /* --- END: Card Styling (General - Minimal) --- */


    /* --- START: Client Header Card Specific Styles (Minimal) --- */
    .client-header-card {
        margin-bottom: 1.2rem; /* Space below the main header section */
        border-radius: 4px;
        border: 1px solid #e0e0e0; 
        box-shadow: none;
        background: #ffffff;
        padding: 1rem 1.25rem; 
    }

    .client-header-details p {
        font-size: 0.75rem;
        margin-bottom: 0.2rem; 
        line-height: 1.4;
        color: #566a7f;
    }
    .client-header-details p strong {
        display: inline-block;
        min-width: 90px;
        font-weight: 500;
        color: #434d58;
        margin-right: 0.4rem;
    }
    .client-header-details .value-unknown, .value-unknown {
        color: #a8b0b9;
        font-style: italic;
    }
    .client-header-details a {
        color: var(--bs-primary);
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .client-header-details a:hover {
        color: var(--bs-primary-dark); 
        text-decoration: underline;
    }

    .client-header-details .separator {
        color: #dce4ec;
        margin: 0 0.4rem;
    }

    /* Adjusted tax owed display in header */
    .tax-owed-info {
        text-align: right;
    }
    .tax-owed-info p {
        font-size: 0.65rem;
        color: #777;
        margin-bottom: 0.1rem;
    }
    .tax-owed-info h5 {
        font-size: 1rem;
        font-weight: 600;
        color: #434d58;
        margin-bottom: 0;
    }

    /* Header Action Icon Buttons (General for layout controls) */
    .header-action-buttons {
        display: flex;
        align-items: center;
        gap: 0.3rem; /* Reduced space between button groups */
        margin-top: 0.6rem; /* Reduced space above buttons */
        flex-wrap: wrap;
    }
    .header-action-buttons .btn-group {
        gap: 0.15rem; /* Very small space between buttons within a group */
    }
    .header-action-buttons .btn {
        padding: 0.15rem 0.4rem; /* Further reduced padding */
        line-height: 1;
        font-size: 0.7rem; /* Match button text size */
        border-radius: 3px;
        border-color: #dce4ec;
        color: #6c757d;
        transition: all 0.2s ease-in-out;
        font-weight: 400;
    }
    .header-action-buttons .btn:hover,
    .header-action-buttons .btn:focus {
        color: var(--bs-primary);
        border-color: rgba(var(--bs-primary-rgb), 0.3); /* Assuming --bs-primary-rgb is defined */
        background-color: rgba(var(--bs-primary-rgb), 0.07);
    }

    .header-action-buttons .ri-small {
        font-size: 1em;
        vertical-align: middle;
    }

    /* Mini Icon Buttons in Client Header for specific client actions */
    .client-mini-actions {
        display: flex;
        align-items: center;
    }
    .client-mini-actions .btn-icon.btn-sm {
        padding: 0.2rem 0.35rem; /* Tiny padding */
    }
    .client-mini-actions .btn-icon.btn-sm i {
        font-size: 1rem; /* Slightly smaller icon if default is too big */
        vertical-align: middle;
    }
    .client-mini-actions .dropdown-menu {
        font-size: 0.75rem; /* Smaller dropdown items for mini buttons */
    }


    /* Collapse button for the profile content itself */
    #card-client-header .btn-collapse {
        margin-left: auto;
        align-self: flex-start;
        padding: 0.2rem 0.3rem; /* Match other header icon buttons */
        color: #8a919a;
    }
    #card-client-header .btn-collapse:hover {
        background-color: rgba(0,0,0,0.04);
        color: #566a7f;
    }
    /* --- END: Client Header Card Specific Styles --- */


    /* --- START: Draggable Card & Column Styles --- */
    .drop-column {
        padding-bottom: 0.5rem;
        min-height: 40px;
        transition: background-color 0.3s ease;
        border-radius: 4px;
    }

    .drop-column.ui-sortable-highlight {
        background-color: rgba(var(--bs-primary-rgb), 0.05); /* Assuming --bs-primary-rgb is defined */
    }


    .draggable-card {
        margin-bottom: 0.8rem;
        border: 1px solid #e7e7e7; /* Slightly more defined border */
        border-radius: 4px;
        box-shadow: none;
        background-color: #ffffff; /* Ensure white background for the card itself */
    }

    .draggable-card .card-header {
    cursor: grab;
    background-color: #f9f9f9; /* Light gray for header contrast */
    border-bottom: 1px solid #e0e0e0; /* Clearer separator */
    padding: 0.5rem 0.8rem; /* Compact padding */
    }
    .draggable-card .card-header:active {
        cursor: grabbing;
    }
    .draggable-card .card-title,
    .draggable-card .card-header h6 { /* Target h6 if used for title */
        color: #383838; /* Darker title text */
        font-size: 0.8rem; /* Compact title */
        font-weight: 500;
    }
    .draggable-card .card-body {
        padding: 0.8rem 1rem;
    }


    /* Placeholder style during drag */
    .sortable-placeholder {
        border: 1px dashed #cccccc;
        background-color: #fcfcfc;
        height: 60px;
        margin-bottom: 0.8rem;
        box-sizing: border-box;
        border-radius: 4px;
    }
    /* --- END: Draggable Card & Column Styles --- */

    /* --- START: Main Collapsible Wrapper Card --- */
    .main-wrapper-card {
        border: none;
        box-shadow: none;
        background-color: transparent;
        margin-bottom: 0 !important;
    }
    .main-wrapper-card .card-header.main-wrapper-card-header { /* Specificity for main header */
        border: 1px solid #e0e0e0;
        box-shadow: none;
        border-radius: 4px;
        background-color: #ffffff;
        padding: 0.5rem 1rem; /* Base padding */
        transition: all 0.3s ease;
        display: flex; /* Ensure flex for alignment */
        align-items: center; /* Default alignment */
        flex-wrap: wrap; /* Allow wrapping for responsiveness */
    }

    .main-wrapper-card-header .status-indicator {
        vertical-align: middle;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .main-wrapper-card-header .client-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        color: #333;
        /* flex-grow: 1; Removed to allow natural sizing */
        transition: font-size 0.3s ease, font-weight 0.3s ease;
    }
    
    /* Styling for additional details in the main header */
    .main-wrapper-card-header .client-additional-details span {
        display: inline-block; /* Default for desktop flow */
        font-size: 0.85em; /* Slightly smaller than main name */
        color: #566a7f;
        margin-right: 0.75rem; /* Spacing between items */
        margin-bottom: 0.25rem; /* For stacking/wrapping */
    }
    .main-wrapper-card-header .client-additional-details span:last-child {
        margin-right: 0;
    }


    .main-wrapper-card-header .tax-owed-info {
        text-align: right;
        /* margin-left: 1rem; // Replaced by ms-md-auto */
        flex-shrink: 0;
        transition: margin-left 0.3s ease;
    }
    .main-wrapper-card-header .tax-owed-info p {
    font-size: 0.65rem;
    color: #777;
    margin-bottom: 0.1rem;
    }
    .main-wrapper-card-header .tax-owed-info h5 {
    font-size: 1rem;
    font-weight: 600;
    color:rgb(0, 0, 0);
    margin-bottom: 0;
    padding-right: 10px;
    }
    .main-wrapper-card-header .tax-owed-info h5.value-unknown {
            color:rgb(0, 0, 0);
            font-weight: 400;
            font-style: italic;
            padding-right: 10px;
    }

    .tax-owed-info h5.value-unknown {
            color:rgb(0, 0, 0);
            font-weight: 400;
            font-style: italic;
    }
    /* Styles when main card is collapsed */
    .main-wrapper-card-header .btn-collapse.collapsed ~ .d-flex .client-name, /* Adjust selector if structure changed */
    .main-wrapper-card-header .btn-collapse.collapsed ~ div[class*="flex-grow-1"] .client-name {
        font-size: 0.9rem;
        font-weight: 500;
    }
    .main-wrapper-card-header .btn-collapse.collapsed ~ div[class*="flex-grow-1"] .client-additional-details span {
        font-size: 0.75em;
    }


    .main-wrapper-card-header .btn-collapse {
        padding: 0.4rem 0.5rem;
        font-size: 1.3rem;
        border-radius: 50%;
        color: #6c757d;
        transition: all 0.2s ease-in-out;
        margin-left: 1rem; /* Default margin */
        flex-shrink: 0;
    }
    .main-wrapper-card-header .btn-collapse:hover {
        background-color: rgba(0,0,0,0.05);
        color: #495057;
    }

    .main-wrapper-card > .collapse > .card-body {
    padding: 5px;
    }

    .main-wrapper-card > .collapse.show {
        border: 1px solid #e0e0e0;
        border-top: none;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        box-shadow: none;
        margin-top: -1px;
        position: relative;
        z-index: 1;
        background-color: #ffffff;
    }
    .main-wrapper-card > .collapse.show > .card-body > .row {
        box-shadow: none;
        border: none;
    }

    /* Responsive adjustments for main header */
    @media (max-width: 991.98px) { /* Below LG, for when Tax Owed might wrap */
        .main-wrapper-card-header .tax-owed-info {
            margin-top: 0.5rem; /* Add space if it wraps */
        }
    }

    @media (max-width: 767.98px) { /* MD breakpoint and below */
        .main-wrapper-card-header {
            padding: 0.5rem; /* More compact padding */
        }
        .main-wrapper-card-header .flex-grow-1 { /* The block with name and details */
            width: 100%; /* Take full width to allow internal stacking */
            margin-bottom: 0.5rem; /* Space before tax info if it wraps below */
            margin-right: 0 !important; /* Remove right margin */
        }
        .main-wrapper-card-header .client-additional-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Stack additional details */
            margin-left: 0 !important; /* Remove left margin from desktop */
            margin-top: 0.25rem;
        }
        .main-wrapper-card-header .client-additional-details span {
            margin-right: 0; /* Remove right margin between items */
            margin-bottom: 0.15rem;
        }
        .main-wrapper-card-header .tax-owed-info {
            width: 100%;
            text-align: left;
            margin-left: 0 !important;
            margin-top: 0.5rem;
        }
        .main-wrapper-card-header .btn-collapse {
            margin-left: auto; /* Push to far right if not positioned absolutely */
            /* Or position absolutely if design demands it more strictly:
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            */
        }
    }
    /* --- END: Styles for Main Collapsible Wrapper Card --- */


    /* --- START: Nav Tabs (General & Specific for new section) --- */
    #user-profile-tabs .nav-tabs {
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 0;
    }
    #user-profile-tabs .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: #6c757d;
        border: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px; /* Overlap Bootstrap's border */
        transition: all 0.2s ease-in-out;
        background-color: transparent;
    }
    #user-profile-tabs .nav-link:hover,
    #user-profile-tabs .nav-link:focus {
        color: var(--bs-primary);
        border-bottom-color: #ccc; /* Lighter border for hover */
        background-color: #ededed; /* Slight background on hover */
        outline: none;
    }
    #user-profile-tabs .nav-link.active {
        color: var(--bs-primary);
        border-bottom-color: var(--bs-primary);
        background-color: #ffffff;
        font-weight: 600;
    }
    #user-profile-tabs .tab-content {
        padding: 0.8rem 0 0 0;
        border: none;
    }
    #user-profile-tabs .tab-pane {
        padding: 0; /* Content padding handled by cards inside or specific styling */
    }
    #user-profile-tabs .card {
        border: 1px solid #eeeeee;
        box-shadow: none;
        border-radius: 4px;
    }
    #user-profile-tabs .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #eeeeee;
        padding: 0.3rem 0.6rem;
    }
    #user-profile-tabs .card-body {
        padding: 0.8rem 1rem;
    }

    #card-tabbed-content .card-body {
        padding: 0;
    }
    #card-tabbed-content .nav-tabs {
        border-bottom: 1px solid #eeeeee;
        margin-bottom: 0;
        background-color: #ededed;
        padding: 0.2rem 0.5rem 0 0.5rem;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    #card-tabbed-content .nav-link {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6c757d;
        border: none; /* Remove individual borders */
        border-bottom: 2px solid transparent; /* For active state indicator */
        margin-bottom: -1px; /* Overlap tab content border */
        transition: all 0.2s ease-in-out;
        background-color: transparent;
        text-align: center;
    }
    #card-tabbed-content .nav-link:hover,
    #card-tabbed-content .nav-link:focus {
        color: var(--bs-primary);
        border-bottom-color: #ccc; /* Lighter indicator on hover */
        background-color: #ffffff; /* Match active tab bg for consistency */
        outline: none;
    }
    #card-tabbed-content .nav-link.active {
        color: var(--bs-primary);
        /* Bootstrap 5 active tab style: border on top/left/right, transparent bottom to merge */
        border-color: #eeeeee #eeeeee #ffffff; /* Using #eeeeee for side borders */
        border-width: 1px;
        border-style: solid;
        border-bottom-color: transparent; /* Key part for "connected" look */
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        background-color: #ffffff; /* Content area background */
        font-weight: 600;
        position: relative;
        z-index: 1; /* Bring active tab above tab content border */
    }
    #card-tabbed-content .nav-link .badge {
        font-size: 0.6rem;
        padding: 0.15em 0.3em;
    }
    #card-tabbed-content .nav-link i {
        font-size: 1.1em;
        vertical-align: middle;
    }

    #card-tabbed-content .tab-content {
        padding: 1rem;
        border: 1px solid #eeeeee;
        border-top: none; /* Tabs provide the top visual border */
        background-color: #ffffff;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    #card-tabbed-content .tab-pane {
        font-size: 0.8rem;
        color: #555;
    }
    /* --- END: Styles Specific to NEW Tabbed Card --- */


    /* --- START: Form/Input Styling Consistency --- */
    .form-control, .btn {
        font-family: 'Poppins', sans-serif;
        font-size: 0.8rem;
    }

    .btn-xs {
        padding: 0.15rem 0.5rem;
        font-size: 0.7rem;
        line-height: 1.2;
        border-radius: 3px;
        font-weight: 400;
    }
    .btn-xs i {
        font-size: 1em; /* Keep icon size relative to button text */
    }

    .ri-tiny { font-size: 0.9em; vertical-align: middle; }
    .ri-small { font-size: 1.1em; }
    .ri-20px { font-size: 20px !important; }

    .badge {
        padding: 0.25em 0.4em;
        font-size: 0.7rem;
        font-weight: 500;
        border-radius: 3px;
    }
    .badge.badge-center {
        position: absolute;
        top: 5px;
        right: 5px;
        transform: translate(50%, -50%);
        transform-origin: 100% 0;
    }
    .h-px-20 { height: 20px !important; }
    .w-px-20 { width: 20px !important; }

    .badge.bg-label-light {
        background-color: #f1f1f2 !important;
        color: #87909b !important;
    }
    .badge .ri-tiny {
        font-size: 0.9em;
        vertical-align: middle;
    }
    /* --- END: Form/Input Styling Consistency --- */


    /* --- START: List Item Styles (Tasks, etc.) --- */
    .list-group-item {
        padding: 0.6rem 1rem;
        border-color: #eeeeee;
        font-size: 0.8rem;
        color: #555;
        background-color: #ffffff;
    }
    .list-group-item:last-child {
        border-bottom: none; /* No border for the last item */
    }
    .list-group-item p {
        font-size: 0.75rem; /* For text within list items */
        margin-bottom: 0.15rem;
    }
    .list-group-item small {
        font-size: 0.65rem; /* For meta text like dates */
        color: #888;
    }
    /* --- END: List Item Styles --- */


    /* --- START: Notes, Chat, File Manager Specific Styles --- */
    /* General scrollable containers with resize capability */
    .notes-list-container, .chat-messages-container, .file-list-container {
        overflow-y: auto;
        padding-right: 5px; /* Space for scrollbar */
        resize: vertical; /* Allow vertical resizing */
        min-height: 120px; /* Minimum sensible height */
    }

    /* Specific max-heights (initial size before user resizes) */
    #card-notes .notes-list-container {
        max-height: 480px; /* Increased from 250px */
    }
    #card-chat .chat-messages-container {
        max-height: 480px; /* Increased from 220px */
    }
    #card-file-manager .file-list-container {
        max-height: 180px; /* Decreased from 200px for more compact list */
    }


    /* Compact Note Item Styles */
    .notes-list-compact .note-item-compact {
        background-color: #ededed;
        border: 1px solid #d7d7d7;
        border-radius: 4px;
        padding: 0.6rem 0.8rem;
        margin-bottom: 0.5rem;
        font-size: 0.75rem;
        color: #343a40;
    }
    .note-item-compact .note-header {
        display: flex;
        align-items: center;
        margin-bottom: 0.3rem;
    }
    .note-item-compact .avatar-xs {
        width: 24px;
        height: 24px;
        object-fit: cover;
        border-radius: 50%;
    }
    .note-item-compact .note-user {
        font-size: 0.7rem;
        font-weight: 500;
        color: #495057;
    }
    .note-item-compact .note-timestamp {
        font-size: 0.6rem;
        display: block;
        line-height: 1;
        color: #6c757d;
    }
    .note-item-compact .note-content {
        margin-bottom: 0;
        font-size: 0.75rem;
        line-height: 1.4;
        white-space: pre-wrap;
        word-break: break-word;
    }

    /* Notes Form Elements */
    #frm-add-notes { margin-bottom: 1rem; /* Space after form */}
    #frm-add-notes label {
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }
    #frm-add-notes textarea#note-textarea { /* Target specific textarea */
        font-size: 0.8rem;
        border-radius: 3px;
        border-color: #ced4da;
        min-height: 60px; /* Initial small height */
        line-height: 1.4;
        padding: 0.4rem 0.6rem;
    }
    #frm-add-notes .btn-submit-note { /* Style for a potential submit button */
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
    }

    /* Chat Messages */
    .chat-message {
        margin-bottom: 0.6rem;
        font-size: 0.8rem;
        display: flex;
        flex-direction: column;
    }
    .chat-message .message-content {
        padding: 0.5rem 0.8rem;
        border-radius: 12px;
        max-width: 85%;
        word-wrap: break-word;
        line-height: 1.4;
        position: relative;
    }
    .chat-message.sent { align-items: flex-end; }
    .chat-message.received { align-items: flex-start; }
    .chat-message.sent .message-content {
        background-color: var(--bs-primary);
        color: #fff;
        border-bottom-right-radius: 3px;
    }
    .chat-message.received .message-content {
        background-color: #d7d7d7;
        color: #343a40;
        border-bottom-left-radius: 3px;
    }
    .chat-message .message-meta {
        font-size: 0.6rem;
        color: #6c757d;
        margin-top: 3px;
        padding: 0 4px;
    }
    .chat-input-group {
        margin-top: 0.8rem; /* Space above input */
    }
    .chat-input-group .form-control {
        font-size: 0.8rem;
        border-radius: 3px 0 0 3px;
        border-color: #ccc;
    }
    .chat-input-group .btn {
        font-size: 0.8rem;
        border-radius: 0 3px 3px 0;
        padding: 0.4rem 0.7rem;
    }
    .chat-input-group .btn i {
        font-size: 1.1em;
    }

    /* File Manager Styles */
    #card-file-manager .dropzone {
        border: 2px dashed #dfe3e7;
        border-radius: 4px;
        padding: 1rem;
        background-color: #ededed;
        min-height: 100px;
        margin-bottom: 1rem; /* Space below dropzone */
        text-align: center;
        transition: background-color 0.2s ease-in-out;
    }
    #card-file-manager .dropzone.dz-drag-hover {
        background-color: #e9f5ff; /* Example hover color */
        border-color: var(--bs-primary);
    }
    #card-file-manager .dz-message {
        font-size: 0.9rem;
        color: #6c757d;
        margin: 0;
    }
    #card-file-manager .dz-message .note {
        font-size: 0.7rem;
        display: block;
        margin-top: 0.25rem;
    }

    /* More Compact file list item */
    .file-list-compact .file-item-compact {
        display: flex;
        align-items: center;
        padding: 0.3rem 0.1rem; /* Reduced padding */
        border-bottom: 1px solid #f0f0f0; /* Lighter border */
        font-size: 0.7rem; /* Slightly smaller base font */
        transition: background-color 0.15s ease-in-out;
    }
    .file-list-compact .file-item-compact:last-child {
        border-bottom: none;
    }
    .file-list-compact .file-item-compact:hover {
        background-color: #ededed;
    }
    .file-item-compact .file-icon img {
        width: 20px; /* Smaller icon */
        height: auto;
        margin-right: 0.4rem; /* Reduced margin */
        flex-shrink: 0;
    }
    .file-item-compact .file-details {
        flex-grow: 1;
        line-height: 1.2; /* Tighter line height */
        overflow: hidden;
    }
    .file-item-compact .file-name {
        font-weight: 500;
        color: var(--bs-primary);
        text-decoration: none;
        font-size: 0.75rem; /* Maintained size, important info */
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .file-item-compact .file-name:hover {
        text-decoration: underline;
    }
    .file-item-compact .file-meta {
        font-size: 0.6rem; /* Smaller meta text */
        color: #777; /* Slightly lighter gray */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .file-item-compact .file-actions .btn {
        padding: 0.05rem 0.25rem; /* Much smaller button padding */
        font-size: 0.6rem; /* Smaller button text */
    }
    .file-item-compact .file-actions .btn i {
        font-size: 0.85em; /* Smaller icon in button */
        vertical-align: middle;
    }
    /* --- END: Notes, Chat, File Manager Specific Styles --- */


    /* --- START: Utilities and Overrides --- */
    .fs-sm { font-size: 0.8rem !important; }
    .fs-xs { font-size: 0.7rem !important; }
    .fw-medium { font-weight: 500 !important; }
    .fw-light { font-weight: 300 !important; }

    .status-indicator {
    display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; vertical-align: middle; flex-shrink: 0;
    }
    .status-pending { background-color: var(--bs-warning); }
    .status-active { background-color: var(--bs-info); }
    .status-complete { background-color: var(--bs-success); }
    .status-urgent { background-color: var(--bs-danger); }
    .status-hold { background-color: var(--bs-secondary); }

    .text-status-unknown { color: var(--bs-secondary-text-emphasis, #6c757d); }
    .text-status-open { color: var(--bs-info-text-emphasis, #0dcaf0); }
    .text-status-closed { color: var(--bs-success-text-emphasis, #198754); }
    .text-status-inprogress { color: var(--bs-warning-text-emphasis, #ffc107); }
    .text-status-hold { color: var(--bs-secondary-text-emphasis, #6c757d); }
    .text-status-urgent { color: var(--bs-danger-text-emphasis, #dc3545); }

    .ssn-mask { font-family: monospace; }

    #user-profile-tabs .tab-pane > .card {
        border: 1px solid #eeeeee;
        box-shadow: none;
        padding: 0;
    }
    #user-profile-tabs .tab-pane > .card > .card-body {
        padding: 0.8rem 1rem;
    }

    hr {
        border-top: 1px solid #eeeeee;
        margin: 0.8rem 0;
    }

    /* Styling for links within Quick Actions card body */
    #card-quick-actions .card-body a.fs-xs,
    #card-quick-actions .card-body .quick-actions-layout-controls a {
        color: #566a7f;
        text-decoration: none;
        transition: color 0.2s ease;
        display: block;
        padding: 0.2rem 0;
    }
    #card-quick-actions .card-body > a.fs-xs:hover,
    #card-quick-actions .card-body .quick-actions-layout-controls a:hover {
        color: var(--bs-primary);
        text-decoration: underline;
    }
    #card-quick-actions .card-body .quick-actions-layout-controls a {
        font-weight: 500;
        color: var(--bs-primary); /* Make links in quick actions primary color by default */
    }
    /* Specific color for delete saved layout link */
    #card-quick-actions .card-body .quick-actions-layout-controls a#delete-saved-layout-btn {
        color: var(--bs-danger);
    }
    #card-quick-actions .card-body .quick-actions-layout-controls a#delete-saved-layout-btn:hover {
        color: #a71d2a; /* Darker red on hover */
    }

    /* Styling for moved client management buttons in Quick Actions */
    #card-quick-actions .card-body .btn-group .btn,
    #card-quick-actions .card-body a.btn.item-edit {
        font-size: 0.7rem; /* Ensure consistent small size */
        margin-bottom: 0.3rem; /* Add some space below each button/group */
        display: block; /* Make standalone anchor button block */
        width: 100%; /* Make them full width for better tap targets if stacked */
        text-align: left; /* Align text left if full width */
    }
    #card-quick-actions .card-body a.btn.item-edit {
        padding-left: 0.5rem; /* Align with dropdown button text */
    }
    #card-quick-actions .card-body .btn-group .dropdown-menu {
        width: 100%; /* Make dropdown menu full width of button */
    }
    #card-quick-actions .card-body .btn-group {
        display: block; /* Make btn-group take full width */
    }


    .ps__thumb-y, .ps__thumb-x {
        background-color: rgba(var(--bs-primary-rgb), 0.2) !important; /* Assuming --bs-primary-rgb */
        border-radius: 4px !important;
    }
    .ps__thumb-y:hover, .ps__thumb-x:hover {
        background-color: rgba(var(--bs-primary-rgb), 0.4) !important;
    }
    .ps__rail-y, .ps__rail-x {
        background-color: transparent !important; /* Make rails invisible */
    }


    .btn-collapse {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.2rem;
        border-radius: 50%;
        color: #8a919a;
        transition: all 0.2s ease-in-out;
        line-height: 1;
    }
    .btn-collapse:hover {
        background-color: rgba(0,0,0,0.04);
        color: #566a7f;
    }
    .btn-collapse i {
        font-size: 1.1rem;
        vertical-align: middle;
    }
    [data-bs-toggle="collapse"]:not(.collapsed) .ri-arrow-down-s-line:before {
        content: "\ea5f"; /* ri-arrow-up-s-line */
    }
    [data-bs-toggle="collapse"].collapsed .ri-arrow-down-s-line:before {
        content: "\ea6a"; /* ri-arrow-right-s-line for sidebars */
    }
    .main-wrapper-card-header .btn-collapse i {
        font-size: 1.3rem;
    }

    .main-wrapper-card-header .btn-collapse:not(.collapsed) > i.ri-arrow-down-s-line:before { content: "\ea5f"; /* ri-arrow-up-s-line */ }
    .main-wrapper-card-header .btn-collapse.collapsed > i.ri-arrow-down-s-line:before { content: "\ea4d"; /* ri-arrow-down-s-line */ }


    .row.gy-4 {
        --bs-gutter-y: 0.8rem;
    }
    .main-wrapper-card > .collapse.show > .card-body > .row {
        --bs-gutter-x: 0.8rem;
    }
    /* --- Estilos Corporativos Base (Define estos colores según tu tema) --- */
    :root {
        --corporate-primary-color: #0056b3; /* Un azul corporativo como ejemplo */
        --corporate-light-background: #ededed; /* Un fondo muy claro */
        --corporate-card-background: #ffffff; /* Fondo de la tarjeta (nota) */
        --corporate-text-color: #212529;      /* Texto principal oscuro */
        --corporate-text-muted: #495057;     /* Texto secundario más suave */
        --corporate-border-color: #dee2e6;    /* Color de borde sutil */
        --corporate-link-color: #007bff;      /* Color para enlaces (azul estándar) */
        --corporate-font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente legible y moderna */
    }

    /* --- Estilos para #notes-list --- */
    #notes-list {
        background-color: var(--corporate-light-background);
        padding: 8px;
        border-radius: 4px;
    }

    #notes-list .col-xl-12,
    #notes-list .col-lg-12,
    #notes-list .col-md-12 {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-bottom: 6px !important;
    }

    #notes-list .card {
        width: 100%;
        border: 1px solid var(--corporate-border-color);
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        border-radius: 3px;
        margin-bottom: 0 !important;
    }

    #notes-list .card-body {
        background-color: var(--corporate-card-background) !important;
        padding: 8px 10px;
        color: var(--corporate-text-color);
    }

    /* Header de la nota: avatar, nombre, fecha */
    #notes-list .card-body .d-flex.align-items-center {
        margin-bottom: 5px !important;
        /* Alineación para asegurar que nombre y fecha estén bien alineados verticalmente */
        align-items: baseline !important;
    }

    #notes-list .avatar {
        margin-right: 8px !important;
    }

    #notes-list .avatar img {
        width: 22px !important;
        height: 22px !important;
        border-radius: 50%;
        vertical-align: middle; /* Ayuda a alinear mejor con el texto inline */
    }

    /* Contenedor del nombre y la fecha */
    #notes-list .text-heading.h5 {
        font-size: 0.75rem !important;
        font-weight: 600;
        color: var(--corporate-text-color);
        margin-bottom: 0 !important;
        line-height: 1.2;
        /* Eliminar el display: block implícito de h5 para que small quede inline */
        display: inline;
    }

    /* Fecha - ahora inline con el nombre */
    #notes-list .text-heading.h5 small {
        font-size: 0.65rem !important;
        color: var(--corporate-primary-color) !important;
        font-weight: normal;
        /* No display: block; para que esté inline */
        margin-left: 5px; /* Pequeño espacio entre nombre y fecha */
    }

    /* Contenido (párrafo) de la nota */
    #notes-list .card-body p.text-dark {
        font-family: var(--corporate-font-family);
        font-size: 0.8rem !important;
        line-height: 1.3;
        color: var(--corporate-text-muted) !important;
        margin-bottom: 0 !important;
        text-align: left !important;

        /* Para asegurar el ajuste de texto (wrapped) */
        white-space: normal; /* Por defecto, pero aseguramos */
        overflow-wrap: break-word; /* Para palabras largas sin espacios */
        word-wrap: break-word;     /* Legado para overflow-wrap */
        word-break: break-word;    /* Para navegadores que no soportan los anteriores con ciertas palabras */

        /* Para asegurar que el texto sea seleccionable (normalmente es el comportamiento por defecto) */
        user-select: text; /* o auto */
        -webkit-user-select: text;
        -moz-user-select: text;
        -ms-user-select: text;
    }

    /* Estilo para los enlaces dentro del contenido de la nota */
    #notes-list .card-body p.text-dark a {
        color: var(--corporate-link-color);
        text-decoration: underline;
        cursor: pointer;
    }

    #notes-list .card-body p.text-dark a:hover,
    #notes-list .card-body p.text-dark a:focus {
        text-decoration: none; /* Opcional: quitar subrayado en hover/focus */
        color: color-mix(in srgb, var(--corporate-link-color) 80%, black); /* Oscurecer un poco al pasar el ratón */
    }


    /* Scrollbar (opcional, si usas perfect-scrollbar) */
    #notes-list .ps__rail-y,
    #notes-list .ps__rail-x {
        opacity: 0.6;
    }
    #notes-list .ps__thumb-y,
    #notes-list .ps__thumb-x {
        background-color: var(--corporate-primary-color);
    }

    /* --- Responsive Adjustments --- */
    @media (max-width: 1199.98px) { /* Below XL */
        .card-header, .card-body {
            padding: 0.3rem 0.4rem;
        }
        /* Re-apply specific padding for new tabs and other specific cards if overridden */
        #card-tabbed-content .card-body { padding: 0; }
        #card-tabbed-content .nav-tabs { padding: 0.2rem 0.4rem 0 0.4rem; }
        #card-tabbed-content .nav-link { padding: 0.3rem 0.6rem; font-size: 0.7rem; }
        #card-tabbed-content .tab-content { padding: 0.8rem; }

        /* Ensure other card bodies that need specific padding retain it */
        #card-notes .card-body, #card-chat .card-body, #card-file-manager .card-body,
        #card-transcripts .card-body, #card-history .card-body, #card-client-overview .card-body { /* Added new cards */
            padding: 0.6rem 0.8rem; /* Match general card body padding for responsive */
        }
        /* Draggable card headers already have specific compact padding */
        .draggable-card .card-header {
            padding: 0.3rem 0.5rem;
        }

        .main-wrapper-card .card-header.main-wrapper-card-header { /* Ensure specificity */
            padding: 0.3rem 0.6rem;
        }

        .client-header-card {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .client-header-details p strong {
            min-width: 70px;
        }
        .main-wrapper-card-header .client-name { font-size: 1rem; }
        /* .main-wrapper-card-header .business-name { font-size: 0.75rem; margin-left: 0.4rem; } // Handled by client-additional-details spans */
        .main-wrapper-card-header .tax-owed-info { margin-left: 0.5rem; }
        /* .main-wrapper-card-header .btn-collapse.collapsed ~ .d-flex .client-name { font-size: 0.9rem; font-weight: 500; } // Updated selectors */
        /* .main-wrapper-card-header .btn-collapse.collapsed ~ .d-flex .business-name { font-size: 0.7rem; } */

        .main-wrapper-card-header .btn-collapse { padding: 0.3rem 0.4rem; font-size: 1.2rem; }
        .header-action-buttons { margin-top: 0.6rem; gap: 0.3rem; }
        .header-action-buttons .btn-group { gap: 0.15rem; }
        .header-action-buttons .btn { padding: 0.2rem 0.3rem; }
        .header-action-buttons .ri-small { font-size: 0.9em; }

        .row.gy-4 { --bs-gutter-y: 0.8rem; }
        .main-wrapper-card > .collapse.show > .card-body > .row { --bs-gutter-x: 0.8rem; }
        .drop-column { min-height: 30px; padding-bottom: 0.3rem; }
        .draggable-card { margin-bottom: 0.6rem; }
        .client-header-card, #collapseProfileContent, .tab-content-wrapper { margin-bottom: 1rem !important; }
        .tab-content-wrapper .card { margin-bottom: 0.8rem; }

        /* Adjusted max-heights for scrollable containers on smaller screens */
        .notes-list-container, .chat-messages-container { max-height: 440px !important; } /* Important to override inline style if needed, or better, adjust base */
        .file-list-container { max-height: 150px !important; }

        /* .note-item, .chat-message .message-content { padding: 0.4rem 0.6rem; } Original, might conflict with compact */
        /* .note-item { margin-bottom: 0.4rem; } */
        .notes-list-compact .note-item-compact { padding: 0.5rem 0.7rem; }
        #card-file-manager .dropzone { padding: 0.8rem; min-height: 80px; }
        .file-list-compact .file-item-compact { padding: 0.3rem 0.1rem; } /* Match new compact style */

        .chat-message { margin-bottom: 0.5rem; }
        .chat-message .message-content { padding: 0.4rem 0.6rem; }
        .chat-input-group { margin-top: 0.6rem; }
        .chat-input-group .btn { padding: 0.3rem 0.6rem; }

        .list-group-item { padding: 0.5rem 0.8rem; }
        .list-group-item p { font-size: 0.7rem; margin-bottom: 0.1rem; }
        .list-group-item small { font-size: 0.6rem; }
    }

    @media (max-width: 767.98px) { /* Below MD */
        
        #card-client-overview .overview-section-container {
            display: grid;
            /* Intentar 2 columnas de secciones <dl> dentro de la columna Bootstrap */
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem 1rem; /* row-gap column-gap entre los <dl> */
        }
        .client-header-card .d-flex.flex-column.align-items-md-end {
            align-items: flex-start !important;
            margin-top: 0.8rem;
        }
        .client-header-card .tax-owed-info {
            text-align: left;
            margin-left: 0;
        }
        .client-header-card .btn-collapse.ms-md-auto { margin-left: 0 !important; }

        .client-header-card .client-header-actions-block { /* Target the new parent of mini icons and view form btn */
            flex-direction: column; /* Stack them on small screens */
            align-items: flex-start !important; /* Align to start */
        }
        .client-header-card .client-header-actions-block .client-mini-actions {
            margin-bottom: 0.5rem; /* Space between mini icons and view form btn when stacked */
            margin-right: 0 !important; /* Remove right margin when stacked */
        }


        .client-header-details p strong { min-width: 60px; }

        #card-tabbed-content .nav-link { padding: 0.4rem 0.5rem; }
        #card-tabbed-content .nav-link .d-none.d-sm-block { display: none !important; }
        #card-tabbed-content .nav-link i.d-sm-none { display: inline-block !important; margin-right: 0 !important; }
    }
    .avatar{
        display: none;
    }
    .container-p-y:not([class^=pt-]):not([class*=" pt-"]) {
        padding-top: 0.3rem !important;
    }
    .container-xxl{
        max-width: 100%; !important;
    }
    .text-heading {
        --bs-text-opacity: 1;
        color: var(--bs-secondary) !important;
    }

</style>

@endsection

@section('content')

<!-- Page Overlay -->
<div id="page-load-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: white; z-index: 9999; opacity: 1; transition: opacity 1s ease-out; display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <h3 style="font-weight: 500; color: #566a7f; font-family: 'Poppins', sans-serif;">Taxlab<span style="color: var(--bs-primary);">pro</span></h3>
    <div class="spinner-border text-primary" role="status" style="margin-top: 1rem;"></div> 
</div>


{{-- START: Main Collapsible Card Wrapper --}}
<div class="card main-wrapper-card list-client-card" data-id="{{$client->id}}">

  {{-- Header --}}
  <div class="card-header main-wrapper-card-header">
    {{-- Status Indicator and Name/Details block --}}
    <div class="d-flex flex-column flex-md-row align-items-md-baseline flex-grow-1 me-md-3"> <!-- Flex column for mobile, row for md+, takes available space -->
        <div class="d-flex align-items-center mb-2 mb-md-0"> <!-- Status indicator + main name -->
            @php
                $indicatorStatusMap = [ 1 => 'status-pending', 2 => 'status-active', 3 => 'status-complete', 4 => 'status-urgent', 5 => 'status-hold' ];
                $indicatorStatusClass = $indicatorStatusMap[$client->case_status ?? 1] ?? 'status-pending';
            @endphp
            <span class="status-indicator {{ $indicatorStatusClass }}" title="Case Status Indicator"></span>
            <h5 class="client-name mb-0"> <!-- Main client name -->
                {{ $client->first_name ?? 'Unknown' }} {{ $client->last_name ?? 'Unknown' }}
            </h5>
        </div>

        <div class="ms-md-2 client-additional-details"> <!-- Additional details, spaced on desktop -->
            @php
            $mainHeaderSpouseFullName = null;
            if (isset($client->marital_status) && ((string)$client->marital_status === '2' || $client->marital_status === true)) { // Assuming '2' or true is married
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

    {{-- Tax Owed Info --}}
    <div class="tax-owed-info mt-2 mt-md-0 ms-md-auto"> <!-- Margin top for mobile, margin start auto for desktop -->
    <p class="mb-0">Total Amount Owed</p>
    @php
        $summary = [
        'total_amount_owed' => 0,
        'total_taxable_income' => 0,
        'total_tax_liability' => 0,
        'total_payments_made' => 0,
        ];
        if (isset($transcriptData) && is_array($transcriptData)) {
        foreach($transcriptData as $t) {
            if (isset($t['balance_due_or_overpayment']) && $t['balance_due_or_overpayment'] > 0) {
            $summary['total_amount_owed'] += $t['balance_due_or_overpayment'];
            }
            $summary['total_taxable_income'] += $t['taxable_income'] ?? 0;
            $summary['total_tax_liability'] += $t['total_tax'] ?? 0;
            $summary['total_payments_made'] += $t['total_payments'] ?? 0;
        }
        }
    @endphp
    <h5 class="{{ !$summary['total_amount_owed'] ? 'value-unknown' : ''}}">
        {{ $summary['total_amount_owed'] ? '$' . number_format($summary['total_amount_owed'], 2) : 'Unknown' }}
    </h5>
    </div>

    {{-- Expand/Collapse Button for the Main Wrapper --}}
    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainContentWrapperCollapse" aria-expanded="true" aria-controls="mainContentWrapperCollapse" title="Toggle Client Details">
      <i class="ri-arrow-down-s-line"></i>
    </button>
  </div>


  {{-- Collapsible Body (Contains the dynamic layout row) --}}
  <div id="mainContentWrapperCollapse" class="collapse show">
    <div class="card-body">
        <div class="row gy-4" id="client-layout-row">

          <!-- Left Column (Drop Target) -->
          <div id="left-column" class="drop-column col-sm-12 col-12 order-1 order-md-0 px-2">

            <!-- Quick Actions (Movable) -->
             <div class="card sidebar-card draggable-card" id="card-quick-actions">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingQuickActions">
                    <i class="ri-sparkling-2-line card-title-icon"></i>
                    <h6 class="card-title me-2">Quick Actions</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuickActions" aria-expanded="false" aria-controls="collapseQuickActions" title="Toggle Quick Actions"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                 <div id="collapseQuickActions" class="collapse" aria-labelledby="headingQuickActions">
                    <div class="card-body">
                        
                    <hr class="my-3">
                        <p class="mb-2 fs-xs fw-medium">Client Management:</p>
                        <a href="javascript:;" class="btn btn-xs btn-outline-primary item-edit edit-client mb-2" data-idx="{{$client->id}}"> <i class="ri-edit-line ri-tiny align-middle me-1"></i> Edit profile</a>

                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-outline-secondary dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-flag-line ri-tiny align-middle me-1"></i> Change Status </button>
                            <ul class="dropdown-menu dropdown-menu-end fs-sm">
                                @php
                                    // This $textStatusMap should ideally come from the controller or be a global helper
                                    // For now, defining it here for consistency with its usage in the header card
                                    $textStatusMapForDropdown = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ];
                                @endphp
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

            <!-- /Quick Actions -->



             <div class="card sidebar-card draggable-card" id="card-client-overview">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingQuickActions">
                    <i class="ri-sparkling-2-line card-title-icon"></i>
                    <h6 class="card-title me-2">Quick Actions</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuickActions" aria-expanded="false" aria-controls="collapseQuickActions" title="Toggle Quick Actions"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                 <div id="collapseQuickActions" class="collapse" aria-labelledby="headingQuickActions">
                    <div class="card-body">
                        
                  
                    </div>
                 </div>
            </div>

            <!-- START: Client Overview Card (Movable) -->
            <div class="card sidebar-card draggable-card" id="card-client-overview">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingClientOverview">
    <i class="ri-user-search-line card-title-icon"></i>
    <h6 class="card-title me-2">Client Overview</h6>
    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClientOverview" aria-expanded="false" aria-controls="collapseClientOverview" title="Toggle Client Overview">
        <i class="ri-arrow-down-s-line"></i>
    </button>
</div>
<div id="collapseClientOverview" class="collapse" aria-labelledby="headingClientOverview"> 
    
                @include('client.partials.overview')
            </div>
            </div>
            <!-- END: Client Overview Card -->


            <!-- START: New Movable Tabbed Section -->
            <div class="card right-sidebar-card draggable-card" id="card-tabbed-content">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingTabbedContent">
                    <i class="ri-information-line card-title-icon"></i>
                    <h6 class="card-title me-2">Tab Group</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTabbedContent" aria-expanded="false" aria-controls="collapseTabbedContent" title="Toggle More Info"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseTabbedContent" class="collapse" aria-labelledby="headingTabbedContent">
                    <div class="card-body p-0">
                        <div class="nav-align-top">
                            {{-- Tab Nav Links will be generated here by JS --}}
                            <ul class="nav nav-tabs nav-fill" role="tablist" id="more-info-nav-tabs">
                                {{-- Placeholder for tabs. JS will populate this. --}}
                            </ul>
                            {{-- Tab Content Panes (dropped cards) will go here --}}
                            <div class="tab-content" id="more-info-dynamic-tab-content" style="min-height: 100px; padding: 1rem; border: 1px solid #eeeeee; border-top:none; background-color: #ffffff;">
                                {{-- Placeholder message, will be managed by JS --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: New Movable Tabbed Section -->


            <!-- Client's Tasks (Movable) -->
            <div class="card sidebar-card draggable-card" id="card-tasks">
              <div class="card-header d-flex justify-content-between align-items-center" id="headingTasks">
                <i class="ri-list-ordered card-title-icon"></i>
                <h6 class="card-title me-2">Tasks</h6>
                <div class="d-flex align-items-center ms-auto">

                    <button class="btn btn-sm btn-outline-primary open-modal-task mr-1" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                        + Add
                    </button>
                  <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTasks" aria-expanded="false" aria-controls="collapseTasks" title="Toggle Tasks">
                    <i class="ri-arrow-down-s-line"></i>
                  </button>
                </div>
              </div>
              <div id="collapseTasks" class="collapse" aria-labelledby="headingTasks">
                @include('client.partials.tasks')

              </div>
            </div>
            <!-- /Client's Tasks -->

            <!-- Notes Section (Movable) -->
            <div class="card right-sidebar-card draggable-card" id="card-notes">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingNotes">
                    <i class="ri-sticky-note-2-line card-title-icon"></i>
                    <h6 class="card-title me-2">Notes</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNotes" aria-expanded="false" aria-controls="collapseNotes" title="Toggle Notes"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseNotes" class="collapse" aria-labelledby="headingNotes">
                @include('client.partials.notes')
                </div>
            </div>
            <!-- /Notes Section -->

            <!-- Chat Section (Movable) -->
            <div class="card right-sidebar-card draggable-card" id="card-chat">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingChat">
                    <i class="ri-chat-4-line card-title-icon"></i>
                    <h6 class="card-title me-2">Chat</h6>
                    <div class="d-flex align-items-center ms-auto">
                        <button class="btn btn-icon btn-sm btn-outline-secondary rounded-pill me-1" type="button" title="Chat Settings"> <i class="ri-settings-3-line ri-small"></i> </button>
                        <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChat" aria-expanded="false" aria-controls="collapseChat" title="Toggle Chat"> <i class="ri-arrow-down-s-line"></i> </button>
                    </div>
                </div>
                <div id="collapseChat" class="collapse" aria-labelledby="headingChat">
                    @include('client.partials.chat')
                </div>
            </div>
            <!-- /Chat Section -->

            <!-- START: New File Manager Section (Movable) -->
            <div class="card right-sidebar-card draggable-card" id="card-file-manager">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingFileManager">
                    <i class="ri-folder-open-line card-title-icon"></i>
                    <h6 class="card-title me-2">File Manager</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFileManager" aria-expanded="false" aria-controls="collapseFileManager" title="Toggle File Manager"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseFileManager" class="collapse" aria-labelledby="headingFileManager"><br>
                    @include('client.partials.files')
                </div>
            </div>
            <!-- END: New File Manager Section -->
            
            <!-- START: New Transcripts Section (Movable) -->
            <div class="card right-sidebar-card draggable-card" id="card-transcripts">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingTranscripts">
                    <i class="ri-money-dollar-circle-line card-title-icon"></i>
                    <h6 class="card-title me-2">Transcripts</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTranscripts" aria-expanded="false" aria-controls="collapseTranscripts" title="Toggle Transcripts"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseTranscripts" class="collapse" aria-labelledby="headingTranscripts">
                    @include('client.partials.transcripts')
                </div>
            </div>
            <!-- END: New Transcripts Section -->

            <!-- START: New History Section (Movable) -->
            <div class="card right-sidebar-card draggable-card" id="card-history">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingHistory">
                    <i class="ri-history-line card-title-icon"></i>
                    <h6 class="card-title me-2">History</h6>
                    <button class="btn btn-icon btn-sm btn-text-secondary rounded-pill btn-collapse collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory" title="Toggle History"> <i class="ri-arrow-down-s-line"></i> </button>
                </div>
                <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory">
                    @include('client.partials.timeline')
                </div>
            </div>
            <!-- END: New History Section -->

          </div>
          <!--/ Left Column -->

          <!-- Center Column (Drop Target - Contains Fixed and Movable) -->
          <div id="center-column" class="drop-column col-sm-12 col-12 order-0 order-md-1 px-2">
            <input type="hidden" name="client_idx" id="client_idx" value="{{$client->id}}">

            <!-- Client Header Details Card (FIXED - NOT MOVABLE) -->
            <div class="card client-header-card mb-4" id="card-client-header">
                <div class="row gy-3">
                    <div class="col-lg-12">
                        @php
                            $textStatusMap = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ];
                            $textColorStatusMap = [ 1 => 'text-status-unknown', 2 => 'text-status-open', 3 => 'text-status-closed', 4 => 'text-status-inprogress', 5 => 'text-status-hold'];
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
                            $taxOwed = $client->federal_tax_owed ?? null;
                        @endphp

                        {{-- Informacion de Status y Tax Owed --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
                            <div>
                                <h6 class="mb-0 fw-medium {{ $statusTextColorClass }}" style="font-size: 0.9rem;">Status: {{ $statusText }}</h6>
                            </div>
                            @php
                                $summary = [
                                    'total_amount_owed' => 0,
                                    'total_taxable_income' => 0,
                                    'total_tax_liability' => 0,
                                    'total_payments_made' => 0,
                                ];
                                if (isset($transcriptData) && is_array($transcriptData)) {
                                    foreach($transcriptData as $t) {
                                        if (isset($t['balance_due_or_overpayment']) && $t['balance_due_or_overpayment'] > 0) {
                                            $summary['total_amount_owed'] += $t['balance_due_or_overpayment'];
                                        }
                                        $summary['total_taxable_income'] += $t['taxable_income'] ?? 0;
                                        $summary['total_tax_liability'] += $t['total_tax'] ?? 0;
                                        $summary['total_payments_made'] += $t['total_payments'] ?? 0;
                                    }
                                }
                            @endphp
                            <div class="text-end">
                                <span class="d-block mb-0" style="font-size: 0.65rem; color: #6c757d;">Total Amount Owed</span>
                                <h5 class="mb-0 fw-bold {{ !$summary['total_amount_owed'] ? 'value-unknown' : ''}}" style="font-size: 1rem; color: #333;">
                                    {{ $summary['total_amount_owed'] ? '$' . number_format($summary['total_amount_owed'], 2) : 'Unknown' }}
                                </h5>
                            </div>
                        </div>
                        <hr class="my-2">

                        {{-- Tablas del Perfil del Cliente --}}
                        <div class="row g-3">
                            {{-- Columna Izquierda del Perfil --}}
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0" style="font-size: 0.73rem; line-height: 1.25;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Case ID:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->id ? 'value-unknown' : '' }}">{{ $client->id ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Full Name:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$clientFullName ? 'value-unknown' : '' }}">{{ $clientFullName ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">SSN:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    <span class="ssn-mask {{ !$client->ssn ? 'value-unknown' : '' }}" id="ssn-display-table-left" @if($client->ssn) data-full-ssn="{{ $client->ssn }}" @endif>
                                                        {!! $client->ssn ? '***-**-'.substr($client->ssn, -4) : 'Unknown' !!}
                                                    </span>
                                                    @if($client->ssn)
                                                        <i class="ri-eye-line cursor-pointer ms-1" id="toggle-ssn-table-left" style="font-size: 0.9rem; vertical-align: middle;" onclick="toggleClientSSNTable('left')"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Date of Birth:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->date_birdth ? 'value-unknown' : '' }}">{{ $client->date_birdth ? \Carbon\Carbon::parse($client->date_birdth)->format('m/d/Y') : 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Address Type:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->type_address ? 'value-unknown' : '' }}">{{ $client->type_address ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Address:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->address_1 ? 'value-unknown' : '' }}">{{ $client->address_1 ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">City:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->city ? 'value-unknown' : '' }}">{{ $client->city ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">State:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->state ? 'value-unknown' : '' }}">{{ $client->state ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Zip Code:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->zipcode ? 'value-unknown' : '' }}">{{ $client->zipcode ?? 'Unknown' }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- Columna Derecha del Perfil --}}
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0" style="font-size: 0.73rem; line-height: 1.25;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 35%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Driver's Lic. #:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->dl ? 'value-unknown' : '' }}">{{ $client->dl ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">DL State:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->dl_state ? 'value-unknown' : '' }}">{{ $client->dl_state ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Has Passport:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if ($client->has_passport === null) <span class="value-unknown">Unknown</span>
                                                    @else <span class="{{ $client->has_passport ? '' : 'value-unknown' }}">{{ $client->has_passport ? 'Yes' : 'No' }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Client Ref. #:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->client_reference ? 'value-unknown' : '' }}">{{ $client->client_reference ?? 'Unknown' }}</span></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Email:</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->tax_payer_email) <a href="mailto:{{ $client->tax_payer_email }}">{{ $client->tax_payer_email }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Phone (Home):</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->phone_home) <a href="tel:{{ $client->phone_home }}">{{ $client->phone_home }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Cellphone (Home):</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->cell_home) <a href="tel:{{ $client->cell_home }}">{{ $client->cell_home }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Phone (Work):</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->phone_work) <a href="tel:{{ $client->phone_work }}">{{ $client->phone_work }}</a>
                                                    @else <span class="value-unknown">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Cellphone (Work):</td>
                                                <td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">
                                                    @if($client->cell_work) <a href="tel:{{ $client->cell_work }}">{{ $client->cell_work }}</a>
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
                                const fullSSN = ssnDisplayElement.dataset.fullSsn; // Accede como camelCase

                                if (!fullSSN) return;

                                if (toggleIconElement.classList.contains('ri-eye-line')) {
                                    // Actualmente enmascarado, mostrar completo
                                    ssnDisplayElement.textContent = fullSSN; // Usar textContent para evitar XSS si el SSN tuviera HTML
                                    toggleIconElement.classList.remove('ri-eye-line');
                                    toggleIconElement.classList.add('ri-eye-off-line');
                                } else {
                                    // Actualmente completo, enmascarar
                                    ssnDisplayElement.textContent = '***-**-' + fullSSN.substr(-4);
                                    toggleIconElement.classList.remove('ri-eye-off-line');
                                    toggleIconElement.classList.add('ri-eye-line');
                                }
                            }
                        </script>

                        {{-- Fila para Estado Civil y tabla colapsable del Cónyuge --}}
                        <div class="row mt-2"> <div class="col-12"> <table class="table table-sm table-borderless mb-0" style="font-size: 0.73rem; line-height: 1.25;"><tbody><tr><td style="width: calc(15% - 0.5rem); font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Marital Status:</td> <td style="background-color:rgb(240, 240, 240); border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"> @if($isMarried) <span class="badge bg-label-secondary fs-xs">Married</span> <button class="btn btn-xs btn-link p-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#spouseInfoCollapse" aria-expanded="false" aria-controls="spouseInfoCollapse" style="font-size: 0.7rem; vertical-align: baseline; text-decoration: none;"> Spouse Details <i class="ri-arrow-down-s-line"></i> </button> @elseif(isset($client->marital_status) && ((string)$client->marital_status === '1' || (string)$client->marital_status === 'false')) <span class="badge bg-label-secondary fs-xs">Single</span> @else <span class="badge bg-label-light fs-xs value-unknown">{{ $client->marital_status ? 'Other' : 'Unknown' }}</span> @endif </td> </tr></tbody></table> </div> </div>

                        @if($isMarried)
                        <div class="collapse mt-1 mb-2" id="spouseInfoCollapse">
                            <h6 class="mb-1 mt-2" style="font-size: 0.78rem; color: var(--bs-primary);"><i class="ri-user-heart-line me-1"></i>Spouse Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0" style="font-size: 0.73rem; line-height: 1.25;">
                                            <tbody>
                                                <tr><td style="width: 30%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Full Name:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$spouseFullName ? 'value-unknown' : '' }}">{{ $spouseFullName ?? 'Unknown' }}</span></td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">SSN:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="ssn-mask {{ !$client->spouse_ssn ? 'value-unknown' : '' }}" id="spouse-ssn-display-table" @if($client->spouse_ssn) data-full-ssn="{{ $client->spouse_ssn }}" @endif>{!! $client->spouse_ssn ? '***-**-'.substr($client->spouse_ssn, -4) : 'Unknown' !!}</span>@if($client->spouse_ssn)<i class="ri-eye-line cursor-pointer ms-1" id="toggle-spouse-ssn-table" style="font-size: 0.9rem; vertical-align: middle;" onclick="toggleSpouseSSNTable()"></i>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Date of Birth:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->spouse_date_birdth ? 'value-unknown' : '' }}">{{ $client->spouse_date_birdth ? \Carbon\Carbon::parse($client->spouse_date_birdth)->format('m/d/Y') : 'Unknown' }}</span></td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Marital Date:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->marital_date ? 'value-unknown' : '' }}">{{ $client->marital_date ? \Carbon\Carbon::parse($client->marital_date)->format('m/d/Y') : 'Unknown' }}</span></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0" style="font-size: 0.73rem; line-height: 1.25;">
                                            <tbody>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Driver's Lic. #:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->spouse_dl ? 'value-unknown' : '' }}">{{ $client->spouse_dl ?? 'Unknown' }}</span></td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">DL State:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;"><span class="{{ !$client->spouse_dl_state ? 'value-unknown' : '' }}">{{ $client->spouse_dl_state ?? 'Unknown' }}</span></td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Has Passport:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if ($client->spouse_has_passport === null) <span class="value-unknown">Unknown</span> @else <span class="{{ $client->spouse_has_passport ? '' : 'value-unknown' }}">{{ $client->spouse_has_passport ? 'Yes' : 'No' }}</span>@endif</td></tr>
                                                <tr><td style="width: 35%; font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Email:</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_email) <a href="mailto:{{ $client->spouse_email }}">{{ $client->spouse_email }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Phone (Home):</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_phone_home) <a href="tel:{{ $client->spouse_phone_home }}">{{ $client->spouse_phone_home }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Cellphone (Home):</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_cell_home) <a href="tel:{{ $client->spouse_cell_home }}">{{ $client->spouse_cell_home }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Phone (Work):</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_phone_work) <a href="tel:{{ $client->spouse_phone_work }}">{{ $client->spouse_phone_work }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                                <tr><td style="font-weight: 500; white-space: nowrap; padding: .2rem .5rem .2rem 0; vertical-align: top;">Cellphone (Work):</td><td style="background-color: #ededed; border: 1px solid #d7d7d7; border-radius: .2rem; padding: .2rem .5rem; word-break: break-word; vertical-align: top;">@if($client->spouse_cell_work) <a href="tel:{{ $client->spouse_cell_work }}">{{ $client->spouse_cell_work }}</a>@else <span class="value-unknown">Unknown</span>@endif</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function toggleSpouseSSNTable() {
                                    const ssnDisplayElement = document.getElementById('spouse-ssn-display-table');
                                    const toggleIconElement = document.getElementById('toggle-spouse-ssn-table');
                                    const fullSSN = ssnDisplayElement.dataset.fullSsn; // Accede como camelCase

                                    if (!fullSSN) return;

                                    if (toggleIconElement.classList.contains('ri-eye-line')) {
                                        // Actualmente enmascarado, mostrar completo
                                        ssnDisplayElement.textContent = fullSSN; // Usar textContent
                                        toggleIconElement.classList.remove('ri-eye-line');
                                        toggleIconElement.classList.add('ri-eye-off-line');
                                    } else {
                                        // Actualmente completo, enmascarar
                                        ssnDisplayElement.textContent = '***-**-' + fullSSN.substr(-4);
                                        toggleIconElement.classList.remove('ri-eye-off-line');
                                        toggleIconElement.classList.add('ri-eye-line');
                                    }
                                }
                            </script>
                        </div>
                        @endif

                        {{-- Contenedor Unificado para Todos los Botones de Acción --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3">
                            <!-- Left-aligned buttons -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- Botones de Layout -->
                                <div class="btn-group">
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="default" title="Default Layout"> <i class="ri-layout-column-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="left_sidebar" title="Left Sidebar Layout"> <i class="ri-layout-left-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="right_sidebar" title="Right Sidebar Layout"> <i class="ri-layout-right-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary apply-preset-icon-btn" type="button" data-preset="center_stacked" title="Center Stacked Layout"> <i class="ri-layout-top-line ri-small"></i> </button>
                                </div>
                                <!-- Botones de Expand/Collapse All -->
                                <div class="btn-group">
                                    <button class="btn btn-icon btn-sm btn-outline-secondary toggle-all-cards-icon-btn" type="button" data-action="collapse" title="Collapse All Panels"> <i class="ri-subtract-line ri-small"></i> </button>
                                    <button class="btn btn-icon btn-sm btn-outline-secondary toggle-all-cards-icon-btn" type="button" data-action="expand" title="Expand All Panels"> <i class="ri-add-line ri-small"></i> </button>
                                </div>
                            </div>

                            <!-- Right-aligned buttons -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- MINI ICON BUTTONS FOR CLIENT ACTIONS -->
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
                                <!-- BOTONES VIEW FORM / HIDE FORM -->
                                <a href="javascript:;" id="btn-show-form" data-form-type="{{$client->form_type}}" class="btn btn-xs btn-primary waves-effect waves-light {{ !$client->form_type ? 'd-none' : '' }}"> <i class="ri-printer-line ri-tiny align-middle me-1"></i> View {{ $client->form_type ?? 'View Form' }} </a>
                                <a href="javascript:;" id="btn-show-profile" data-form-type="{{$client->form_type}}" class="d-none btn btn-xs btn-primary waves-effect waves-light"> Hide form info </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Client Header Details Card -->

            <div id="collapseProfileContent" class="collapse {{ request()->get('profile_collapsed') === 'true' ? '' : 'show' }} mb-4">
            {{-- @include('client.partials.tab-profile') This partial should contain the #user-profile-tabs structure --}}
            </div>

              <!-- TAB Section (Movable) -->
            <div class="tab-content-wrapper mb-4">
                @php $current_form_type = isset($client) ? $client->form_type : null; @endphp
                @if($current_form_type === '433A' || $current_form_type === '433A OIC')
                    @include('client.partials.tab-433a')
                @elseif($current_form_type === '433B' || $current_form_type === '433B OIC')
                    @include('client.partials.tab-433b')
                @endif
            </div>
            {{-- Draggable cards can be dropped here and will appear below the fixed content --}}


          </div>
          <!--/ Center Column -->

          <!-- Right Column (Drop Target) -->
          <div id="right-column" class="drop-column col-sm-12 col-12 order-2 px-2">


          </div>
          <!--/ Right Column -->

        </div> {{-- End Dynamic Layout .row --}}
    </div> {{-- End .card-body of the collapsible div --}}
  </div> {{-- End #mainContentWrapperCollapse --}}

</div> {{-- END: Main Collapsible Card Wrapper --}}


{{-- Modals --}}
@include('client.modal.new')
@include('client.modal.add-task') 
@endsection


@section('scripts')
{{-- Keep existing vendor scripts --}}
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
{{--<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script> REMOVED --}}
{{-- <script src="{{asset('assets/js/forms-file-upload.js')}}"></script>  REMOVED --}}
<script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
<script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- Tribute.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.css">
<!-- Tribute.js JS -->
<script src="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.min.js"></script>

<link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>

<script>
jQuery(document).ready(function($) {

    const client_id_val = $('#client_idx').val();
    const layoutStorageKey = 'clientLayout_' + client_id_val;
    let psInstances = {};
    const moreInfoTabContentId = 'more-info-dynamic-tab-content';
    let initialDefaultLayout = null;

    // --- START: DEFINE ALL HELPER FUNCTIONS ---

    function initializeScrollbars() {
        $('.perfect-scrollbar').each(function() {
            const psElement = this;
            const existingPsId = $(psElement).data('ps-id');
            if (existingPsId && psInstances[existingPsId]) {
                try {
                    psInstances[existingPsId].destroy();
                } catch (e) {
                    console.error("Error destroying existing PS instance:", e);
                }
                delete psInstances[existingPsId];
                $(psElement).removeData('ps-id'); // Clear data attribute
            }
        });

        $('.perfect-scrollbar').each(function() {
            // Only initialize if the element is visible and its parent collapse (if any) is shown
            if ($(this).is(':visible') && ($(this).closest('.collapse').length === 0 || $(this).closest('.collapse').hasClass('show'))) {
                try {
                    const elementTrackerId = $(this).attr('id') || 'ps-' + Math.random().toString(36).substr(2, 9);
                    if (!$(this).attr('id')) $(this).attr('id', elementTrackerId);

                    psInstances[elementTrackerId] = new PerfectScrollbar(this, {
                        wheelPropagation: false,
                        suppressScrollX: true
                    });
                    $(this).data('ps-id', elementTrackerId); // Mark as initialized with this ID
                } catch (e) {
                    console.error("Error initializing PS for element:", this, e);
                }
            }
        });
    }

    function updateScrollbars() {
        for (const key in psInstances) {
            const $el = $('#' + key); // Get element by its stored ID (which was ps-id or original id)
            if ($el.length && psInstances[key] && psInstances[key].update && $el.is(':visible')) {
                // Check if inside a collapse, and if that collapse is shown
                const $collapseParent = $el.closest('.collapse');
                if ($collapseParent.length > 0 && !$collapseParent.hasClass('show')) {
                    continue; // Don't update if parent collapse is not shown
                }
                try {
                    psInstances[key].update();
                } catch (e) {
                    console.error("Error updating PS for key " + key + ":", e);
                }
            }
        }
        // Specifically update scrollbars within active tabs in #more-info-dynamic-tab-content
        $('#' + moreInfoTabContentId + ' > .tab-pane.active .perfect-scrollbar').each(function() {
            const psId = $(this).data('ps-id');
            if (psId && psInstances[psId] && psInstances[psId].update && $(this).is(':visible')) {
                try { psInstances[psId].update(); } catch(e) { console.error("Error updating PS in active tab:", e); }
            }
        });
    }

    function removeColumnClasses($el) {
        $el.removeClass(function(index, className) {
            return (className.match(/(^|\s)col-(xl|lg|md|sm)-\d+/g) || []).join(' ') +
                   ' ' +
                   (className.match(/(^|\s)d-(xl|lg|md|sm|xs)-none/g) || []).join(' '); // Added d-xs-none
        });
    }

    function updateColumnLayout() {
        const $leftCol = $('#left-column');
        const $centerCol = $('#center-column');
        const $rightCol = $('#right-column');
        const leftCount = $leftCol.find('.draggable-card:not(.ui-sortable-placeholder)').length;
        const rightCount = $rightCol.find('.draggable-card:not(.ui-sortable-placeholder)').length;

        removeColumnClasses($leftCol);
        removeColumnClasses($centerCol);
        removeColumnClasses($rightCol);

        // Default to full width for small screens, then override for larger
        $leftCol.addClass('col-12 order-1 order-md-0 px-2');
        $centerCol.addClass('col-12 order-0 order-md-1 px-2');
        $rightCol.addClass('col-12 order-2 px-2');

        ['md', 'lg', 'xl'].forEach(breakpoint => {
            let left_w, center_w, right_w;
            const standardWidths = { md: [4, 5, 3], lg: [4, 5, 3], xl: [3, 6, 3] };
            const leftCenterWidths = { md: [4, 8, 0], lg: [4, 8, 0], xl: [3, 9, 0] };
            const centerRightWidths = { md: [0, 8, 4], lg: [0, 8, 4], xl: [0, 9, 3] }; // Adjusted for balance
            const centerOnlyWidths = { md: [0, 12, 0], lg: [0, 12, 0], xl: [0, 12, 0] };

            if (leftCount > 0 && rightCount > 0) {
                [left_w, center_w, right_w] = standardWidths[breakpoint];
                $leftCol.removeClass(`d-${breakpoint}-none`); $rightCol.removeClass(`d-${breakpoint}-none`);
            } else if (leftCount === 0 && rightCount > 0) {
                [left_w, center_w, right_w] = centerRightWidths[breakpoint];
                $leftCol.addClass(`d-${breakpoint}-none`); $rightCol.removeClass(`d-${breakpoint}-none`);
            } else if (leftCount > 0 && rightCount === 0) {
                [left_w, center_w, right_w] = leftCenterWidths[breakpoint];
                $leftCol.removeClass(`d-${breakpoint}-none`); $rightCol.addClass(`d-${breakpoint}-none`);
            } else { // Only center column has cards or both are empty
                [left_w, center_w, right_w] = centerOnlyWidths[breakpoint];
                $leftCol.addClass(`d-${breakpoint}-none`); $rightCol.addClass(`d-${breakpoint}-none`);
            }

            if (left_w > 0) $leftCol.addClass(`col-${breakpoint}-${left_w}`);
            if (center_w > 0) $centerCol.addClass(`col-${breakpoint}-${center_w}`);
            if (right_w > 0) $rightCol.addClass(`col-${breakpoint}-${right_w}`);
        });
        setTimeout(updateScrollbars, 50);
    }

    function getLayoutFromDOM(captureCollapseState = false) {
        const layout = [];
        $('.drop-column, #' + moreInfoTabContentId).each(function() {
            const columnId = this.id;
            $(this).children('.draggable-card:not(.ui-sortable-placeholder)').each(function(index) { // Iterate only direct children
                const card = $(this);
                const cardId = card.attr('id');
                if (!cardId) return; // Skip cards without ID

                let cardData = { id: cardId, column: columnId, order: index };
                if (captureCollapseState) {
                    const $collapseElement = card.find('> .collapse').first(); // Direct child collapse
                    if ($collapseElement.length) {
                        cardData.isExpanded = $collapseElement.hasClass('show');
                    }
                }
                if (columnId === moreInfoTabContentId) {
                    cardData.isTabInMoreInfo = true;
                }
                layout.push(cardData);
            });
        });
        return layout;
    }

    function rebuildMoreInfoTabs(justDroppedCardId = null) {
        const $navTabs = $('#more-info-nav-tabs');
        const $tabContent = $('#' + moreInfoTabContentId);
        let activeTabSet = false;

        $navTabs.find('li[data-dynamic-tab="true"]').remove(); // Clear previous dynamic tabs
        $('#more-info-placeholder-msg').remove(); // Remove placeholder before rebuilding

        $tabContent.children('.draggable-card').each(function(index) {
            const card = $(this);
            const cardId = card.attr('id');
            if (!cardId) return;

            const cardTitle = card.find('.card-header .card-title').text().trim() ||
                              card.find('.card-header h6').text().trim() ||
                              'Tab ' + (index + 1);
            const tabLinkId = 'more-info-tablink-' + cardId;

            card.find('.card-header').first().hide();
            const $collapseContent = card.find('> .collapse').first();
            if ($collapseContent.length) {
                 // Ensure Bootstrap collapse instance is available and show it
                let bsCollapse = bootstrap.Collapse.getInstance($collapseContent[0]);
                if (!bsCollapse) {
                    bsCollapse = new bootstrap.Collapse($collapseContent[0], { toggle: false });
                }
                if (!$collapseContent.hasClass('show')) {
                    bsCollapse.show(); // Programmatically show
                }
            } else { // If no .collapse, assume .card-body is the content
                card.find('.card-body').show();
            }
            card.addClass('tab-pane fade').data('is-tabbed', true);

            const navLinkHtml = `
                <li class="nav-item" role="presentation" data-dynamic-tab="true" data-controls-card="${cardId}">
                    <button class="nav-link" id="${tabLinkId}" data-bs-toggle="tab" data-bs-target="#${cardId}" type="button" role="tab" aria-controls="${cardId}" aria-selected="false">
                        ${cardTitle}
                    </button>
                </li>`;
            $navTabs.append(navLinkHtml);

            if (justDroppedCardId === cardId || (!activeTabSet && index === 0)) {
                $navTabs.find('.nav-link.active').removeClass('active').attr('aria-selected', 'false');
                $tabContent.find('.tab-pane.active').removeClass('show active');
                $('#' + tabLinkId).addClass('active').attr('aria-selected', 'true');
                card.addClass('show active');
                activeTabSet = true;
            }
        });

        if ($navTabs.find('li[data-dynamic-tab="true"]').length === 0) {
            $tabContent.append('<p class="text-muted text-center p-3" id="more-info-placeholder-msg">Drag sections here to add them as tabs.</p>');
        }
        setTimeout(updateScrollbars, 100); // After DOM changes for tabs
    }

    function getCurrentLayout() {
        return getLayoutFromDOM(true); // Always capture collapse state for saving
    }

    function saveLayout(layoutToSave) {
        try {
            const layout = layoutToSave || getCurrentLayout();
            localStorage.setItem(layoutStorageKey, JSON.stringify(layout));
            if (typeof toast_msg === 'function') {
                toast_msg('Layout saved!', 'success', 'Success');
            } else { console.log('Layout saved.'); }
        } catch (e) {
            console.error('Failed to save layout to localStorage:', e);
            if (typeof toast_msg === 'function') {
                toast_msg('Failed to save layout!', 'error', 'Error');
            } else { alert('Failed to save layout.'); }
        }
    }

    function applyLayout(layoutData) {
        if (!layoutData || layoutData.length === 0) {
            console.warn("applyLayout called with no or empty layoutData.");
            return false;
        }

        const allKnownCardIds = $('.draggable-card').map(function() { return this.id; }).get();
        const cardElements = {};
        allKnownCardIds.forEach(id => {
            if (id) cardElements[id] = $('#' + id).detach(); // Detach all known cards
        });


        const targetColumnsContent = {
            'left-column': [], 'center-column': [], 'right-column': [],
            [moreInfoTabContentId]: []
        };

        layoutData.forEach(item => {
            if (!item || !item.id || !item.column) {
                 console.warn("Invalid item in layoutData:", item);
                 return;
            }
            const $card = cardElements[item.id];
            if ($card && $card.length && targetColumnsContent[item.column]) {
                targetColumnsContent[item.column][item.order] = $card; // Place card in order

                // Restore original appearance for cards not in tabs
                if (item.column !== moreInfoTabContentId) {
                    $card.removeClass('tab-pane fade show active').removeData('is-tabbed');
                    $card.find('.card-header').first().show();
                }

                if (item.isExpanded !== undefined) {
                    const $collapseElement = $card.find('> .collapse').first();
                    const $collapseButton = $card.find('.card-header [data-bs-toggle="collapse"]').first();

                    if ($collapseElement.length) {
                        let bsCollapse = bootstrap.Collapse.getInstance($collapseElement[0]);
                        if (!bsCollapse) {
                            bsCollapse = new bootstrap.Collapse($collapseElement[0], { toggle: false });
                        }

                        if (item.isExpanded) {
                            if (!$collapseElement.hasClass('show')) bsCollapse.show();
                            if ($collapseButton.length) $collapseButton.removeClass('collapsed').attr('aria-expanded', 'true');
                        } else {
                            if ($collapseElement.hasClass('show')) bsCollapse.hide();
                            if ($collapseButton.length) $collapseButton.addClass('collapsed').attr('aria-expanded', 'false');
                        }
                    }
                }
            } else {
                console.warn("Card or target column not found for layout item:", item, "Card:", $card);
            }
        });

        for (const columnId in targetColumnsContent) {
            const $targetCol = $(`#${columnId}`);
            if (!$targetCol.length) continue;

            const cardsToAppend = targetColumnsContent[columnId].filter(Boolean); // Removes undefined/null
            cardsToAppend.forEach($card => { $targetCol.append($card); });
        }

        rebuildMoreInfoTabs(); // Crucial: rebuilds tab UI after all cards are placed
        return true;
    }
    
    const presets = {
        default: [
            { id: 'card-tasks', column: 'left-column', order: 0, isExpanded: false },
            { id: 'card-quick-actions', column: 'left-column', order: 1, isExpanded: false },
            
            { id: 'card-notes', column: 'right-column', order: 0, isExpanded: false },
            { id: 'card-chat', column: 'right-column', order: 1, isExpanded: false },
            { id: 'card-client-overview', column: 'right-column', order: 2, isExpanded: false }, // New card
            { id: 'card-tabbed-content', column: 'right-column', order: 3, isExpanded: true }, 
            { id: 'card-file-manager', column: 'right-column', order: 4, isExpanded: false },
            { id: 'card-transcripts', column: 'right-column', order: 5, isExpanded: false },
            { id: 'card-history', column: 'right-column', order: 6, isExpanded: false },
        ],
        left_sidebar: [
            { id: 'card-tasks', column: 'left-column', order: 0, isExpanded: false },
            { id: 'card-quick-actions', column: 'left-column', order: 1, isExpanded: false },
            { id: 'card-client-overview', column: 'left-column', order: 2, isExpanded: false }, // New card
            { id: 'card-notes', column: 'left-column', order: 3, isExpanded: false },
            { id: 'card-chat', column: 'left-column', order: 4, isExpanded: false },
            { id: 'card-tabbed-content', column: 'left-column', order: 5, isExpanded: true }, 
            { id: 'card-file-manager', column: 'left-column', order: 6, isExpanded: false },
            { id: 'card-transcripts', column: 'left-column', order: 7, isExpanded: false },
            { id: 'card-history', column: 'left-column', order: 8, isExpanded: false }
        ],
        right_sidebar: [
            { id: 'card-client-overview', column: 'right-column', order: 0, isExpanded: true }, // New card, perhaps prominent
            { id: 'card-notes', column: 'right-column', order: 1, isExpanded: true },
            { id: 'card-chat', column: 'right-column', order: 2, isExpanded: false },
            { id: 'card-tabbed-content', column: 'right-column', order: 3, isExpanded: true },
            { id: 'card-file-manager', column: 'right-column', order: 4, isExpanded: false },
            { id: 'card-transcripts', column: 'right-column', order: 5, isExpanded: false },
            { id: 'card-history', column: 'right-column', order: 6, isExpanded: false },
            { id: 'card-tasks', column: 'right-column', order: 7, isExpanded: true },
            { id: 'card-quick-actions', column: 'right-column', order: 8, isExpanded: false },
        ],
        center_stacked: [
            { id: 'card-client-overview', column: 'center-column', order: 0, isExpanded: true }, // New card, prominent
            { id: 'card-tasks', column: 'center-column', order: 1, isExpanded: false }, 
            { id: 'card-quick-actions', column: 'center-column', order: 2, isExpanded: false },
            { id: 'card-notes', column: 'center-column', order: 3, isExpanded: false },
            { id: 'card-chat', column: 'center-column', order: 4, isExpanded: false },
            { id: 'card-tabbed-content', column: 'center-column', order: 5, isExpanded: true }, 
            { id: 'card-file-manager', column: moreInfoTabContentId, order: 0, isExpanded: true, isTabInMoreInfo: true },
            { id: 'card-history', column: moreInfoTabContentId, order: 1, isExpanded: true, isTabInMoreInfo: true },
            { id: 'card-transcripts', column: 'center-column', order: 6, isExpanded: false }
        ]
    };


    function applyPreset(presetName) {
        const presetData = presets[presetName];
        if (!presetData) {
            if (typeof toast_msg === 'function') toast_msg('Preset not found!', 'error', 'Error');
            return;
        }
        if (applyLayout(presetData)) {
            updateColumnLayout();
            saveLayout(presetData); // Save this preset as the current layout
            if (typeof toast_msg === 'function') {
                let displayName = presetName.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                if (presetName === 'default') displayName = 'Default Combined';
                toast_msg(`${displayName} layout applied!`, 'success', 'Layout Applied');
            }
        } else {
            if (typeof toast_msg === 'function') toast_msg('Failed to apply preset!', 'error', 'Error');
        }
    }

    function restoreDefaultLayout() {
        // The 'initialDefaultLayout' now correctly reflects the HTML structure, including the new card.
        // Or, if 'presets.default' is the desired restore point:
        const defaultPresetToRestore = presets.default; 

        if (!defaultPresetToRestore || defaultPresetToRestore.length === 0) {
            if (typeof toast_msg === 'function') toast_msg('Default layout not available.', 'error', 'Error');
            return;
        }
        if (confirm('Are you sure you want to restore the default layout? Your current custom layout will be lost.')) {
            if (applyLayout(defaultPresetToRestore)) {
                updateColumnLayout();
                saveLayout(defaultPresetToRestore); // Save the restored default
                if (typeof toast_msg === 'function') toast_msg('Default layout restored!', 'success', 'Success');
            } else {
                if (typeof toast_msg === 'function') toast_msg('Failed to restore default layout!', 'error', 'Error');
            }
        }
    }


    function deleteSavedLayout() {
        if (confirm('Are you sure you want to delete your saved layout? This will revert to the default layout upon next visit if not saved again.')) {
            try {
                localStorage.removeItem(layoutStorageKey);
                if (typeof toast_msg === 'function') {
                    toast_msg('Saved layout deleted! Reverting to default on next load.', 'info', 'Layout Reset');
                }
                // Apply the 'presets.default' layout immediately
                const defaultPresetToApply = presets.default;
                if (applyLayout(defaultPresetToApply)) {
                    updateColumnLayout();
                }
            } catch (e) {
                console.error('Failed to delete layout from localStorage:', e);
                if (typeof toast_msg === 'function') toast_msg('Failed to delete saved layout!', 'error', 'Error');
            }
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
                        if (!$collapseContent.hasClass('show')) bsCollapse.show(); // Tabs content always shown
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

    // --- END: DEFINE ALL HELPER FUNCTIONS ---


    // --- START: INITIALIZATION LOGIC ---
    const pageOverlay = document.getElementById('page-load-overlay');
    if (pageOverlay) {
        setTimeout(() => {
            pageOverlay.style.opacity = '0';
            setTimeout(() => {
                pageOverlay.style.display = 'none';
            }, 1000);
        }, 50);
    }

    initialDefaultLayout = getLayoutFromDOM(true); 

    const sortableOptions = {
        connectWith: `.drop-column, #${moreInfoTabContentId}`,
        handle: '.card-header',
        placeholder: 'sortable-placeholder',
        forcePlaceholderSize: true,
        tolerance: 'pointer',
        scroll: true,
        items: '> .draggable-card:not(.ui-sortable-disabled)', 
        over: function(event, ui) { $(this).addClass('ui-sortable-highlight'); },
        out: function(event, ui) { $(this).removeClass('ui-sortable-highlight'); },
        stop: function(event, ui) {
            $('.drop-column, #' + moreInfoTabContentId).removeClass('ui-sortable-highlight');
            const targetParentId = ui.item.parent().attr('id');
            if (targetParentId !== moreInfoTabContentId && (!ui.sender || ui.sender.attr('id') !== moreInfoTabContentId)) {
                updateColumnLayout();
            }
            saveLayout();
            setTimeout(updateScrollbars, 50);
        }
    };

    $('.drop-column').sortable(sortableOptions);

    $('#' + moreInfoTabContentId).sortable({
        ...sortableOptions,
        receive: function(event, ui) {
            ui.item.removeClass('ui-sortable-helper');
            rebuildMoreInfoTabs(ui.item.attr('id'));
            saveLayout();
            setTimeout(updateScrollbars, 100);
        },
        remove: function(event, ui) {
            ui.item.removeClass('tab-pane fade show active ui-sortable-helper').removeData('is-tabbed');
            ui.item.find('.card-header').first().show();
            const cardId = ui.item.attr('id');
            const currentLayout = getCurrentLayout(); 
            const cardState = currentLayout.find(c => c.id === cardId);
            if (cardState && cardState.isExpanded !== undefined) {
                 const $collapseElement = ui.item.find('> .collapse').first();
                 const $collapseButton = ui.item.find('.card-header [data-bs-toggle="collapse"]').first();
                 if($collapseElement.length) {
                    let bsCollapse = bootstrap.Collapse.getInstance($collapseElement[0]) || new bootstrap.Collapse($collapseElement[0], {toggle: false});
                    if(cardState.isExpanded) bsCollapse.show(); else bsCollapse.hide();
                    if($collapseButton.length) {
                        if(cardState.isExpanded) $collapseButton.removeClass('collapsed').attr('aria-expanded', 'true');
                        else $collapseButton.addClass('collapsed').attr('aria-expanded', 'false');
                    }
                 }
            }
            rebuildMoreInfoTabs();
            updateColumnLayout();
            saveLayout();
            setTimeout(updateScrollbars, 100);
        },
        update: function(event, ui) { 
            if (ui.sender == null) {
                rebuildMoreInfoTabs(ui.item.attr('id')); 
                saveLayout();
                setTimeout(updateScrollbars, 100);
            }
        }
    }).disableSelection();


    const savedLayoutString = localStorage.getItem(layoutStorageKey);
    let layoutLoaded = false;

    if (savedLayoutString) {
        try {
            const layoutData = JSON.parse(savedLayoutString);
            if (Array.isArray(layoutData) && layoutData.length > 0 && layoutData.every(item => item.id && item.column)) {
                if (applyLayout(layoutData)) {
                    layoutLoaded = true;
                } else {
                     localStorage.removeItem(layoutStorageKey);
                }
            } else {
                localStorage.removeItem(layoutStorageKey);
            }
        } catch (e) {
            console.error('Failed to parse or apply saved layout:', e);
            localStorage.removeItem(layoutStorageKey);
        }
    }

    if (!layoutLoaded) {
        // If no saved layout, apply the 'presets.default'
        applyLayout(presets.default); 
    }

    updateColumnLayout();
    setTimeout(initializeScrollbars, 400); 

    // --- END: INITIALIZATION LOGIC ---


    // --- START: EVENT HANDLERS ---
    $('#client-layout-row').on('shown.bs.collapse hidden.bs.collapse', '.collapse', function () {
        setTimeout(updateScrollbars, 360); 
    });
    $('#mainContentWrapperCollapse').on('shown.bs.collapse hidden.bs.collapse', function() {
        setTimeout(updateScrollbars, 360);
    });

    $('#more-info-nav-tabs').on('shown.bs.tab', 'button[data-bs-toggle="tab"]', function (e) {
        setTimeout(updateScrollbars, 50);
    });

    $(document).on('click', '.apply-preset-btn, .apply-preset-icon-btn', function(e) {
        e.preventDefault();
        applyPreset($(this).data('preset'));
    });
    $('#restore-default-layout-btn').on('click', function(e) { e.preventDefault(); restoreDefaultLayout(); });
    $('#delete-saved-layout-btn').on('click', function(e) { e.preventDefault(); deleteSavedLayout(); });

    $(document).on('click', '.quick-actions-layout-controls a[data-action="collapse"], .toggle-all-cards-icon-btn[data-action="collapse"]', function(e) {
        e.preventDefault(); toggleAllCollapses(false);
    });
    $(document).on('click', '.quick-actions-layout-controls a[data-action="expand"], .toggle-all-cards-icon-btn[data-action="expand"]', function(e) {
        e.preventDefault(); toggleAllCollapses(true);
    });

    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            updateColumnLayout(); 
        }, 200);
    });

    // --- AJAX call to change FORM type ---
    $(document).on('click', '.change-form-type', function(e) {
        e.preventDefault();
        var _this = $(this);
        var current_client_id = $('#client_idx').val();
        var _value = _this.attr('data-type');
        var confirmationMsg = _value === '' ? 'Are you sure you want to clear the form type? This will reload the page.' : 'Are you sure you want to change the form type to ' + _value + '? This will reload the page.';

        if (!confirm(confirmationMsg)) return;

        var $dropdownButton = _this.closest('.btn-group').find('.dropdown-toggle');
        $dropdownButton.prop('disabled', true).html($dropdownButton.html() + ' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        var dataPayload = { name: 'form_type', value: _value };
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ route('clients.update_info_question', ['id' => $client->id]) }}", 
            type: 'PUT',
            data: dataPayload,
            success: function(r) {
                if (typeof toast_msg === 'function') {
                    toast_msg(r.msg || 'Form type updated. Reloading...', r.type || 'success', r.title || 'Success');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    alert('Form type updated. Reloading.'); location.reload();
                }
            },
            error: function(jqXHR) {
                let errorMsg = "An error occurred while changing form type.";
                try { errorMsg = JSON.parse(jqXHR.responseText).message || errorMsg; } catch (e) {}
                if (typeof toast_msg === 'function') toast_msg(errorMsg, "error", "Error");
                else alert(errorMsg);
            },
            complete: function() {
                if($dropdownButton.length) {
                    $dropdownButton.prop('disabled', false).find('.spinner-border').remove();
                }
            }
        });
    });

    // --- AJAX call to change CASE STATUS ---
    $(document).on('click', '.change-case-status',function(e) {
      e.preventDefault();
      var _this = $(this);
      var current_client_id = $('#client_idx').val();
      var _value = _this.attr('data-case');
      var $dropdownButton = _this.closest('.btn-group').find('.dropdown-toggle');

      $dropdownButton.prop('disabled', true).html($dropdownButton.html() + ' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

      var dataPayload = {name:'case_status', value : _value};
      $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{route('clients.update_info_question', ['id' => $client->id]) }}", 
            type: 'PUT',
            data: dataPayload,
            success: function (r) {
                if (typeof toast_msg === 'function') {
                    toast_msg(r.msg || 'Case status updated. Reloading...', r.type || 'success', r.title || 'Success');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    alert('Case status updated. Reloading.'); location.reload();
                }
            },
            error: function (jqXHR) {
                let errorMsg = "An error occurred while changing case status.";
                try { errorMsg = JSON.parse(jqXHR.responseText).message || errorMsg; } catch (e) {}
                if (typeof toast_msg === 'function') toast_msg(errorMsg, "error", "Error");
                else alert(errorMsg);
            },
            complete: function() {
                 if($dropdownButton.length) {
                    $dropdownButton.prop('disabled', false).find('.spinner-border').remove();
                }
            }
      });
    });

    // --- Chat Interactions ---
    $('#client-layout-row').on('click', '.chat-messages-container + .chat-input-group .btn-primary', function() {
        const input = $(this).siblings('input');
        const messageText = input.val().trim();
        if (messageText) {
            const timestamp = moment().format('MM/DD/YYYY hh:mm A');
            const userName = "Your Name"; // Replace with actual user name
            const newMessageHtml = `<div class="chat-message sent"><div class="message-content">${$('<div>').text(messageText).html()}</div><div class="message-meta">${userName} - ${timestamp}</div></div>`;
            const container = $(this).closest('.card-body').find('.chat-messages-container');
            container.append(newMessageHtml);
            input.val('');
            container.scrollTop(container[0].scrollHeight);

            const psId = container.data('ps-id');
            if (psId && psInstances[psId] && psInstances[psId].update) {
                try { psInstances[psId].update(); } catch (e) { console.error("Error updating PS on chat add:", e); }
            }
        }
    });
    $('#client-layout-row').on('keypress', '.chat-messages-container + .chat-input-group input', function(e) {
        if (e.which == 13) { $(this).siblings('.btn-primary').click(); return false; }
    });

    // --- END: EVENT HANDLERS ---

}); // End document ready
</script>
<!-- caret.js (requerido por At.js) -->



{{-- Include JS partials --}}
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