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
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />


<style>
    /* --- Dark Violet & Slate Theme --- */
    :root {
        --theme-font-family: 'Poppins', sans-serif;
        
        /* -- NEW: Primary Color Palette (Violet) -- */
        --theme-primary: #8B5CF6; /* violet-500 */
        --theme-primary-hover: #7C3AED; /* violet-600 */
        --theme-primary-light: rgba(139, 92, 246, 0.15); /* Subtle violet background */
        --theme-primary-dark: #A78BFA; /* violet-400 (Lighter for contrast on dark) */
        --theme-primary-text-on-light: var(--theme-primary-dark);
        --theme-primary-rgb: 139, 92, 246;

        /* -- NEW: Accent & Semantic Colors -- */
        --theme-accent: #14B8A6;
        --theme-accent-hover: #0D9488;
        --theme-accent-light: rgba(20, 184, 166, 0.1);
        --theme-success: #22C55E; /* green-500 */
        --theme-warning: #F59E0B; /* amber-500 */
        --theme-danger: #EF4444;  /* red-500 */
        --theme-info: #3B82F6;    /* blue-500 */

        /* -- NEW: Backgrounds (Dark Slate) -- */
        --theme-bg-main: #111827;      /* gray-900 */
        --theme-bg-card: #1F2937;      /* gray-800 */
        --theme-bg-card-alt: #374151;  /* gray-700 */

        /* -- NEW: Text Colors (Light on Dark) -- */
        --theme-text-dark: #F9FAFB;        /* gray-50 */
        --theme-text-medium: #D1D5DB;      /* gray-300 */
        --theme-text-light: #6B728D;       /* gray-500 */
        --theme-text-inverted: #1F2937;    /* gray-800 */

        /* -- NEW: Borders (Subtle on Dark) -- */
        --theme-border-strong: #4B5563; /* gray-600 */
        --theme-border-soft: #374151;   /* gray-700 */
        --theme-border-interactive: var(--theme-primary);
        
        /* -- NEW: Shadows for Dark Mode -- */
        --theme-shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.15);
        --theme-shadow-card: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 2px 6px 2px rgba(0, 0, 0, 0.1);
        --theme-shadow-interactive: 0 0 0 3px rgba(var(--theme-primary-rgb), 0.3);

        /* -- General & Bootstrap Overrides -- */
        --theme-border-radius-sm: 0.15rem;
        --theme-border-radius-md: 0.25rem;
        --theme-border-radius-lg: 0.4rem;
        
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
        --bs-gutter-x: 0.75rem;
        --bs-gutter-y: 0.75rem;
        
        --bs-primary-subtle: var(--theme-primary-light);
        --bs-primary-text-emphasis: var(--theme-primary-dark);
        --bs-secondary-subtle: #374151;
        --bs-secondary-text-emphasis: #E5E7EB;
        --bs-info-subtle: rgba(59, 130, 246, 0.15);
        --bs-info-text-emphasis: #93C5FD;
        --bs-warning-subtle: rgba(245, 158, 11, 0.15);
        --bs-warning-text-emphasis: #FCD34D;
        --bs-light-subtle: var(--theme-bg-card-alt);
        --bs-card-bg: var(--theme-bg-card);
        --bs-card-border-color: var(--theme-border-soft);
        --bs-modal-bg: var(--theme-bg-card);
        --bs-modal-header-border-color: var(--theme-border-soft);
        --bs-dropdown-bg: var(--theme-bg-card);
        --bs-dropdown-link-color: var(--theme-text-medium);
        --bs-dropdown-link-hover-color: var(--theme-text-dark);
        --bs-dropdown-link-hover-bg: var(--theme-bg-card-alt);
        --bs-dropdown-border-color: var(--theme-border-strong);
        --bs-dropdown-divider-bg: var(--theme-border-soft);
    }

    body {
        font-family: var(--theme-font-family);
        color: var(--theme-text-medium);
        font-size: 0.725rem;
        letter-spacing: 0.005em;
        background: var(--theme-bg-main);
        transition: background-color 0.3s ease;
    }

    .container-xxl, .container-fluid {
        padding-top: 0; padding-bottom: 0; max-width: 100% !important;
    }
    a { color: var(--theme-primary); text-decoration: none; }
    a:hover { color: var(--theme-primary-hover); }
    hr { border-top: 1px solid var(--theme-border-soft); margin: 0.5rem 0; }

    .card {
        border: 1px solid var(--theme-border-soft);
        box-shadow: var(--theme-shadow-card);
        background-color: var(--theme-bg-card);
        border-radius: var(--theme-border-radius-md);
    }
    
    .card-header {
        background-color: var(--theme-primary-light);
        border-bottom: 1px solid var(--theme-primary);
        padding: 0.35rem 0.6rem;
        font-weight: 600; display: flex; align-items: center;
    }
     .card-header .card-title-icon {
        font-size: 0.9rem; color: var(--theme-primary-text-on-light); margin-right: 0.3rem;
    }
     .card-title {
        margin-bottom: 0; font-size: 0.75rem; font-weight: 600;
        color: var(--theme-primary-text-on-light); flex-grow: 1;
    }
    
    .card-body {
        padding: 0.7rem; font-size: 0.7rem; color: var(--theme-text-medium);
    }
    .card-body-compact { padding: 0.4rem 0.6rem; }

    .client-profile-header {
        background: linear-gradient(135deg, var(--theme-bg-card) 0%, var(--theme-bg-card-alt) 100%);
        box-shadow: var(--theme-shadow-card);
    }
    .client-profile-header .card-body { padding: 0.8rem; }
    .client-profile-header .client-avatar img {
        width: 50px; height: 50px; border-radius: 50%;
        border: 2px solid var(--theme-primary-light);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .client-profile-header .client-info-main h4 {
        font-size: 1.1rem; font-weight: 600; color: var(--theme-text-dark);
    }
    .client-profile-header .client-contact-info {
        font-size: 0.7rem; color: var(--theme-text-medium); margin-top: 0.2rem; flex-wrap: wrap;
    }
    .client-profile-header .client-contact-info > span, 
    .client-profile-header .client-contact-info > a {
        display: inline-flex; align-items: center; margin-right: 0.6rem; margin-bottom: 0.15rem;
    }
    .client-profile-header .client-contact-info i {
        color: var(--theme-primary); font-size: 0.8rem;
    }
    
    .case-status-indicator-header {
        border: 1px solid var(--theme-border-soft);
        padding: 0.2rem 0.6rem; border-radius: 1rem;
        background-color: var(--theme-bg-main); /* Darker background for contrast */
        flex-shrink: 0;
    }
    .case-status-indicator-header .status-dot { width: 8px; height: 8px; border-radius: 50%; }
    .case-status-indicator-header h5 { font-size: 0.7rem; font-weight: 600; margin-bottom: 0; }
    .case-status-indicator-header .dropdown-toggle { width: 20px; height: 20px; }

    .client-profile-header .client-stats-bar {
        gap: 2rem; flex-wrap: wrap; text-align: center;
    }
    .client-profile-header .client-stats-bar .header-stat-item,
    .client-profile-header .client-stats-bar .tax-owed-info {
        display: flex; flex-direction: column; align-items: center;
    }
    .client-profile-header .client-stats-bar p {
        font-size: 0.6rem; color: var(--theme-text-light);
        margin-bottom: 0.05rem; text-transform: uppercase; font-weight: 500;
    }
    .client-profile-header .client-stats-bar h5 {
        font-size: 1rem; font-weight: 600; color: var(--theme-text-dark); margin-bottom: 0;
    }
    .client-profile-header .tax-owed-info h5.value-unknown {
        color: var(--theme-text-light); font-style: italic; font-weight: 500;
    }
    
    .status-dot {
        width: 8px; height: 8px; border-radius: 50%; display: inline-block; flex-shrink: 0;
    }
    .status-unknown .status-dot, .bg-secondary .status-dot { background-color: var(--theme-text-light); }
    .status-open .status-dot, .bg-success .status-dot { background-color: var(--theme-success); }
    .status-closed .status-dot, .bg-danger .status-dot { background-color: var(--theme-danger); }
    .status-in-progress .status-dot, .bg-info .status-dot { background-color: var(--theme-info); }
    .status-on-hold .status-dot, .bg-warning .status-dot { background-color: var(--theme-warning); }
    
    .status-unknown h5 { color: var(--theme-text-light); }
    .status-open h5 { color: var(--theme-success); }
    .status-closed h5 { color: var(--theme-danger); }
    .status-in-progress h5 { color: var(--theme-info); }
    .status-on-hold h5 { color: var(--theme-warning); }

    #clientProfileTabs {
        border: 1px solid var(--theme-border-soft);
        border-bottom: none;
        background-color: #111827; /* Darker bg for tab bar */
        padding: 0.15rem 0.3rem 0;
        border-top-left-radius: var(--theme-border-radius-md);
        border-top-right-radius: var(--theme-border-radius-md);
    }
    #clientProfileTabs .nav-link {
        color: var(--theme-text-medium);
        font-size: 0.725rem; font-weight: 500;
        padding: 0.4rem 0.7rem; border: none;
        border-bottom: 3px solid transparent;
        margin-bottom: -1px;
    }
    #clientProfileTabs .nav-link:hover,
    #clientProfileTabs .nav-link:focus {
        color: var(--theme-primary-dark);
        border-bottom-color: var(--theme-primary-light);
    }
    #clientProfileTabs .nav-link.active {
        color: var(--theme-primary-dark);
        background-color: var(--theme-bg-card);
        border-bottom-color: var(--theme-primary);
        font-weight: 600;
    }
    #clientProfileTabsContent {
        background-color: var(--theme-bg-card);
        border: 1px solid var(--theme-border-soft);
        border-top: none; padding: 0 0.2rem;
        border-bottom-left-radius: var(--theme-border-radius-md);
        border-bottom-right-radius: var(--theme-border-radius-md);
        min-height: 220px;
    }
    .tab-pane-title {
        font-size: 0.9rem; font-weight: 600; color: var(--theme-text-dark); margin-bottom: 0.75rem;
    }
    #overview-tab-pane .tab-pane-title { border-bottom: none; }

    .tab-content .row { display: flex; flex-wrap: wrap; }
    .tab-content .row > [class^="col-"] { display: flex; flex-direction: column; }
    .tab-content .row > [class^="col-"] .card { flex-grow: 1; }
    
    .tab-pane .card-header {
        background-color: var(--theme-bg-card-alt);
        border-bottom: 1px solid var(--theme-border-strong);
        color: var(--theme-text-dark);
    }
    .tab-pane .card-header .card-title, .tab-pane .card-header .card-title-icon {
        color: var(--theme-text-dark);
    }
    .tab-pane .card-header .card-title-icon { color: var(--theme-primary); }

    .btn {
        font-size: 0.7rem; font-weight: 500; border-radius: var(--theme-border-radius-sm);
        padding: 0.25rem 0.5rem; letter-spacing: 0.01em; box-shadow: var(--theme-shadow-subtle);
        transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .btn:hover { box-shadow: var(--theme-shadow-card); }
    .btn-xs { padding: 0.15rem 0.35rem; font-size: 0.6rem; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 0; }
    .btn-icon.btn-sm.rounded-circle { width: 28px; height: 28px; }
    /* Redefine btn-light for dark mode */
    .btn-light {
        color: var(--bs-body-color);
        background-color: var(--theme-bg-card-alt);
        border-color: var(--theme-border-strong);
    }
    .btn-light:hover {
        color: var(--theme-text-dark);
        background-color: #4B5563; /* gray-600 */
        border-color: #6B728D; /* gray-500 */
    }
    
    .form-control, .form-select {
        font-size: 0.7rem; border-radius: var(--theme-border-radius-sm);
        border: 1px solid var(--theme-border-strong); padding: 0.25rem 0.4rem;
        background-color: var(--theme-bg-main); color: var(--theme-text-medium);
    }
    .form-control::placeholder { color: var(--theme-text-light); }
    .form-control:focus, .form-select:focus {
        border-color: var(--theme-primary);
        box-shadow: var(--theme-shadow-interactive);
        background-color: var(--theme-bg-main);
        color: var(--theme-text-dark);
    }
    label.form-label {
        font-weight: 500; margin-bottom: 0.15rem; font-size: 0.68rem; color: var(--theme-text-dark);
    }
    
    #page-load-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: var(--theme-bg-main); z-index: 1060; opacity: 1; visibility: visible;
        transition: opacity 0.7s ease, visibility 0.7s ease;
        display: flex; justify-content: center; align-items: center; flex-direction: column;
    }
    #page-load-overlay.fade-out { opacity: 0; visibility: hidden; }
    #page-load-overlay h3 { font-weight: 500; color: var(--theme-text-medium); font-family: 'Poppins', sans-serif; }
    #page-load-overlay .spinner-border { margin-top: 1rem; color: var(--theme-primary); }
    
    .taxlab-page-container { display: flex; min-height: 100vh; }
    #taxlab-client-sidebar {
        width: 280px; flex-shrink: 0;
        background-color: var(--theme-bg-card);
        border-right: 2px solid var(--theme-bg-main);
        height: 100vh; overflow-y: auto; position: sticky;
        top: 0; display: flex; flex-direction: column;
        transition: width 0.3s ease-in-out; z-index: 1040;
    }
    .taxlab-page-container.sidebar-is-mini #taxlab-client-sidebar { width: 80px; overflow-x: hidden; }
    
    #taxlab-main-content {
        flex-grow: 1; height: 100vh; overflow-y: auto;
        background-color: var(--theme-bg-main); position: relative;
    }
    #taxlab-sidebar-toggle {
        position: fixed; top: 1rem; left: 260px;
        margin-left: 0.8rem; z-index: 1050;
        background-color: var(--theme-bg-card);
        color: var(--theme-text-medium);
        border: 1px solid var(--theme-border-soft);
        border-radius: 50%; width: 32px; height: 32px;
        transition: left 0.3s ease-in-out, background-color 0.2s, color 0.2s, transform 0.2s;
    }
     #taxlab-sidebar-toggle:hover {
        transform: scale(1.1);
        background-color: var(--theme-primary);
        color: var(--theme-text-dark);
     }
    .taxlab-page-container.sidebar-is-mini #taxlab-sidebar-toggle { left: 80px; }
    
    .sidebar-header {
        padding: 0.75rem; border-bottom: 1px solid var(--theme-border-soft);
        flex-shrink: 0; overflow: hidden;
    }
    .sidebar-title {
        font-size: 0.9rem; font-weight: 600; color: var(--theme-text-dark);
        margin-bottom: 0; white-space: nowrap; opacity: 1;
        transition: opacity 0.2s ease, width 0.2s ease;
    }
    .taxlab-page-container.sidebar-is-mini .sidebar-title,
    .taxlab-page-container.sidebar-is-mini #sidebar-search-input,
    .taxlab-page-container.sidebar-is-mini .client-list-item-text-content {
        opacity: 0; visibility: hidden; width: 0;
    }

    #sidebar-search-input { transition: opacity 0.2s ease; }
    
    .client-list-container { flex-grow: 1; overflow-y: auto; }
    .client-list-item {
        display: flex; align-items: center; padding: 0.6rem 0.75rem;
        border-bottom: 1px solid var(--theme-border-soft); cursor: pointer;
        transition: background-color 0.2s ease, padding 0.2s ease;
        overflow: hidden;
    }
    .taxlab-page-container.sidebar-is-mini .client-list-item {
        justify-content: center; padding-top: 0.75rem; padding-bottom: 0.75rem;
    }
    .client-list-item:hover { background-color: var(--theme-bg-card-alt); }
    .client-list-item.active {
        background-color: var(--theme-primary-light);
        border-left: 3px solid var(--theme-primary);
        padding-left: calc(0.75rem - 3px);
    }
     .taxlab-page-container.sidebar-is-mini .client-list-item.active { padding-left: 0; }
    .client-list-item-icon {
        font-size: 1.4rem; color: var(--theme-text-light); margin-right: 0.75rem;
        transition: all 0.2s ease;
    }
    .taxlab-page-container.sidebar-is-mini .client-list-item-icon { margin-right: 0; font-size: 1.6rem; }
    .client-list-item:hover .client-list-item-icon,
    .client-list-item.active .client-list-item-icon { color: var(--theme-primary); }
    .client-list-item-info { flex-grow: 1; min-width: 0; }
    .client-list-item-text-content h6 {
        margin-bottom: 0.1rem; font-size: 0.75rem; font-weight: 600;
        color: var(--theme-text-dark);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .client-list-item.active .client-list-item-text-content h6 { color: var(--theme-primary-dark); }
    .client-list-item-text-content p {
        margin-bottom: 0; font-size: 0.65rem; color: var(--theme-text-medium); white-space: nowrap;
    }
    .client-list-item-details {
        display: flex; align-items: center; gap: 0.75rem;
        transition: opacity 0.2s ease, width 0.2s ease;
    }
    .taxlab-page-container.sidebar-is-mini .client-list-item-details { opacity: 0; visibility: hidden; width: 0; }
    .notification-indicator {
        position: relative; font-size: 1.1rem; color: var(--theme-text-light);
    }
    .notification-indicator .badge {
        position: absolute; top: -5px; right: -8px;
        font-size: 0.55rem; padding: 2px 4px; line-height: 1;
    }
    
    @media (max-width: 991.98px) {
      .taxlab-page-container { flex-direction: column; }
      #taxlab-client-sidebar, #taxlab-main-content {
        height: auto; position: static; overflow-y: visible; border-right: none; width: 100% !important;
      }
      .taxlab-page-container.sidebar-is-mini #taxlab-client-sidebar { width: 100% !important; overflow-x: visible; }
      .taxlab-page-container.sidebar-is-mini .sidebar-title,
      .taxlab-page-container.sidebar-is-mini #sidebar-search-input,
      .taxlab-page-container.sidebar-is-mini .client-list-item-text-content,
      .taxlab-page-container.sidebar-is-mini .client-list-item-details {
         opacity: 1; visibility: visible; width: auto;
      }
      .taxlab-page-container.sidebar-is-mini .client-list-item { justify-content: flex-start; }
      #taxlab-sidebar-toggle { display: none; }
    }
</style>
@endsection
 
@section('content')

<!-- Page Overlay -->
<div id="page-load-overlay">
    <h3>Taxlab<span style="color: var(--bs-primary);">pro</span></h3>
    <div class="spinner-border" role="status"></div>
</div>

{{-- MODIFIED: Layout classes for mini-sidebar functionality --}}
<div class="taxlab-page-container">
    <!-- Sidebar -->
    <aside id="taxlab-client-sidebar">
       <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="sidebar-title">Clients</h5>
                <!-- MODIFIED: Filter is now an icon dropdown -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-icon btn-light" type="button" id="sidebarFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,5" title="Filter by Status">
                        <i class="ri-filter-3-line"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarFilterDropdown" id="client-status-filter-options">
                        <li><a class="dropdown-item active" href="#" data-status="all"><i class="ri-list-check me-2"></i>All Statuses</a></li>
                        <li><a class="dropdown-item" href="#" data-status="active"><span class="status-dot bg-success me-2"></span>Active</a></li>
                        <li><a class="dropdown-item" href="#" data-status="in-progress"><span class="status-dot bg-info me-2"></span>In Progress</a></li>
                        <li><a class="dropdown-item" href="#" data-status="on-hold"><span class="status-dot bg-warning me-2"></span>On Hold</a></li>
                        <li><a class="dropdown-item" href="#" data-status="closed"><span class="status-dot bg-danger me-2"></span>Closed</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <input type="text" id="sidebar-search-input" class="form-control form-control-sm" placeholder="Search clients...">
            </div>
       </div>
       <div class="client-list-container">
            @php
                // MODIFIED: Added more mock data and icons
                $clients = [
                    ['name' => 'Jhon Snow', 'type' => 'Individual', 'status_text' => 'Active', 'status_class' => 'bg-success', 'active' => true, 'notifications' => 2, 'icon' => 'ri-user-line'],
                    ['name' => 'Daenerys Targaryen', 'type' => 'Business', 'status_text' => 'In Progress', 'status_class' => 'bg-info', 'active' => false, 'notifications' => 1, 'icon' => 'ri-building-4-line'],
                    ['name' => 'Tyrion Lannister', 'type' => 'Consulting', 'status_text' => 'Active', 'status_class' => 'bg-success', 'active' => false, 'notifications' => 0, 'icon' => 'ri-briefcase-line'],
                    ['name' => 'Cersei Lannister', 'type' => 'Trust', 'status_text' => 'On Hold', 'status_class' => 'bg-warning', 'active' => false, 'notifications' => 5, 'icon' => 'ri-shield-star-line'],
                    ['name' => 'Arya Stark', 'type' => 'Individual', 'status_text' => 'Closed', 'status_class' => 'bg-danger', 'active' => false, 'notifications' => 0, 'icon' => 'ri-user-line'],
                    ['name' => 'Sansa Stark', 'type' => 'Estate', 'status_text' => 'Active', 'status_class' => 'bg-success', 'active' => false, 'notifications' => 1, 'icon' => 'ri-home-heart-line'],
                    ['name' => 'Jaime Lannister', 'type' => 'Individual', 'status_text' => 'In Progress', 'status_class' => 'bg-info', 'active' => false, 'notifications' => 3, 'icon' => 'ri-user-line'],
                    ['name' => 'Samwell Tarly', 'type' => 'Non-Profit', 'status_text' => 'Active', 'status_class' => 'bg-success', 'active' => false, 'notifications' => 0, 'icon' => 'ri-community-line'],
                    ['name' => 'Bronn of the Blackwater', 'type' => 'Business', 'status_text' => 'On Hold', 'status_class' => 'bg-warning', 'active' => false, 'notifications' => 0, 'icon' => 'ri-building-4-line'],
                    ['name' => 'Petyr Baelish', 'type' => 'Consulting', 'status_text' => 'Closed', 'status_class' => 'bg-danger', 'active' => false, 'notifications' => 0, 'icon' => 'ri-briefcase-line'],
                    ['name' => 'Lord Varys', 'type' => 'Individual', 'status_text' => 'In Progress', 'status_class' => 'bg-info', 'active' => false, 'notifications' => 8, 'icon' => 'ri-user-line'],
                    ['name' => 'Theon Greyjoy', 'type' => 'Individual', 'status_text' => 'Active', 'status_class' => 'bg-success', 'active' => false, 'notifications' => 0, 'icon' => 'ri-user-line'],
                ];
            @endphp

            @foreach($clients as $c)
            {{-- MODIFIED: Client list item structure with icon and text wrapper --}}
            <a href="#" class="client-list-item {{ $c['active'] ? 'active' : '' }}" data-name="{{ strtolower($c['name']) }}" data-status="{{ strtolower(str_replace(' ', '-', $c['status_text'])) }}">
                <i class="{{ $c['icon'] }} client-list-item-icon"></i>
                <div class="client-list-item-info">
                    <div class="client-list-item-text-content">
                        <h6>{{ $c['name'] }}</h6>
                        <p>{{ $c['type'] }}</p>
                    </div>
                </div>
                <div class="client-list-item-details">
                    @if($c['notifications'] > 0)
                    <div class="notification-indicator">
                        <i class="ri-notification-3-line"></i>
                        <span class="badge rounded-pill bg-danger">{{ $c['notifications'] }}</span>
                    </div>
                    @endif
                    <div class="status-dot {{ $c['status_class'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $c['status_text'] }}"></div>
                </div>
            </a>
            @endforeach
       </div>
    </aside>

    <!-- Main Content -->
    <div id="taxlab-main-content">
      {{-- MODIFIED: Button icon is now handled by JS --}}
      <button id="taxlab-sidebar-toggle" class="btn btn-icon btn-sm">
          <i class="ri-menu-fold-line"></i>
      </button>

      <div class="main-content-area">
        <!-- Client Header -->
        <div class="client-profile-header card">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between w-100">
                    <!-- Left Side: Avatar & Info -->
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div class="flex-shrink-0 me-4 client-avatar">
                            <img src="{{ $client->avatar_url ?? asset('assets/img/avatars/1.png') }}" alt="Client Avatar" class="d-block">
                        </div>
                        <div>
                             @php
                                $currentStatus = $client->case_status ?? 2;
                                $statusMap = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ];
                                $statusClassMap = [ 1 => 'status-unknown', 2 => 'status-open', 3 => 'status-closed', 4 => 'status-in-progress', 5 => 'status-on-hold' ];
                                $statusText = $statusMap[$currentStatus] ?? 'Unknown';
                                $statusClass = $statusClassMap[$currentStatus] ?? 'status-unknown';
                            @endphp
                            {{-- MODIFIED: Name, edit button, and status indicator are now grouped --}}
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                <h4 class="mb-0 client-info-main">
                                    {{ $client->first_name ?? 'Jhon' }} {{ $client->last_name ?? 'Snow' }}
                                </h4>
                                <a href="javascript:void(0);" class="item-edit edit-client text-primary" data-idx="{{$client->id}}" data-bs-toggle="tooltip" title="Edit Client">
                                   <i class="ri-pencil-fill ri-lg"></i>
                                </a>
                                <div class="d-flex align-items-center case-status-indicator-header {{ $statusClass }}">
                                    <span class="status-dot me-2"></span>
                                    <h5 class="me-2">{{ $statusText }}</h5>
                                    <div class="btn-group">
                                        <!-- Remove Bootstrap's default caret by using 'dropdown-toggle' with 'no-caret' and custom icon only -->
                                        <style>
                                            /* Hide Bootstrap's default caret for this specific button */
                                            #headerChangeStatusDropdown.dropdown-toggle::after {
                                                display: none !important;
                                            }
                                        </style>
                                        <button class="btn btn-xs btn-icon btn-outline-secondary rounded-circle dropdown-toggle d-flex align-items-center justify-content-center p-0" type="button" id="headerChangeStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Change Status" style="width: 20px; height: 20px; margin-left: 6px; display: flex; align-items: center; justify-content: center; position: relative;">
                                            <i class="ri-arrow-down-s-line" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="headerChangeStatusDropdown">
                                            @foreach($statusMap as $code => $text)
                                                <li><a class="dropdown-item change-case-status fs-xs" href="javascript:;" data-idx="{{ $client->id }}" data-case="{{ $code }}">Set to {{ $text }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="client-contact-info d-flex flex-wrap align-items-center">
                                <span><i class="ri-mail-line me-1"></i>{{ $client->tax_payer_email ?? 'imalexrd@gmail.com' }}</span>
                                <span class="ms-md-2"><i class="ri-phone-line me-1"></i>{{ $client->phone_home ?? ($client->cell_home ?? '6252059053') }}</span>
                                <span class="ms-md-2"><i class="ri-refresh-line me-1"></i>{{ $client->updated_at ? \Carbon\Carbon::parse($client->updated_at)->diffForHumans() : '2 weeks ago' }}</span>
                                <span class="ms-md-2" id="ssn-container">
                                    <i class="ri-fingerprint-line me-1"></i>
                                    <span class="ssn-masked">***-**-****</span>
                                    <span class="ssn-revealed" style="display: none;">{{ $client->ssn ?? '000-00-0000' }}</span>
                                    <i class="ri-eye-line ms-1" id="ssn-toggle" style="cursor: pointer;" data-bs-toggle="tooltip" title="Show/Hide SSN"></i>
                                </span>
                                @php
                                    $addressParts = array_filter([$client->street_address, $client->city, $client->state, $client->zip_code]);
                                    $fullAddress = !empty($addressParts) ? implode(', ', $addressParts) : '123 Main St, Anytown, USA 12345';
                                    $mapsQuery = urlencode($fullAddress);
                                @endphp
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $mapsQuery }}" target="_blank" class="text-muted ms-md-2">
                                    <i class="ri-map-pin-line me-1"></i>{{ $fullAddress }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Stats Bar -->
                    {{-- MODIFIED: Status indicator removed from here --}}
                    <div class="client-stats-bar d-flex flex-wrap justify-content-lg-end align-items-center">
                        <div class="header-stat-item">
                            <p>Pending Tasks</p>
                            <h5>{{ $pendingTasksCount ?? 0 }}</h5>
                        </div>
                        <div class="header-stat-item">
                            <p>Deal</p>
                            <h5>${{ number_format($dealAmount ?? 0, 2) }}</h5>
                        </div>
                        <div class="tax-owed-info">
                            <p>Total Amount Owed</p>
                            @php
                                $summary = ['account_balance_plus_accruals' => 298772.12]; // Placeholder from image
                                if (isset($accountTranscripts) && is_array($accountTranscripts)) {
                                    $summary['account_balance_plus_accruals'] = 0;
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
                </div>
            </div>
        </div>
        <input type="hidden" name="client_idx" id="client_idx" value="{{$client->id}}">

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="clientProfileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane" aria-selected="false">
                    <i class="ri-dashboard-line me-1"></i>Overview
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="true">
                    <i class="ri-briefcase-4-line me-1"></i>Management
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                    <i class="ri-user-line me-1"></i>Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar-tab-pane" type="button" role="tab" aria-controls="calendar-tab-pane" aria-selected="false">
                    <i class="ri-calendar-2-line me-1"></i>Calendar
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="financials-placeholder-tab" data-bs-toggle="tab" data-bs-target="#financials-placeholder-tab-pane" type="button" role="tab" aria-controls="financials-placeholder-tab-pane" aria-selected="false">
                    <i class="ri-bank-card-line me-1"></i>Financials
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="transcripts-tab" data-bs-toggle="tab" data-bs-target="#transcripts-tab-pane" type="button" role="tab" aria-controls="transcripts-tab-pane" aria-selected="false">
                    <i class="ri-money-dollar-circle-line me-1"></i>Transcripts
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false">
                    <i class="ri-folder-open-line me-1"></i>Documents
                </button>
            </li>
        </ul>

        <!-- Tab Content Panes -->
        <div class="tab-content" id="clientProfileTabsContent">
            {{-- Content remains the same --}}
            <div class="tab-pane fade" id="overview-tab-pane" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
                <div class="client-actions-panel-grid card p-2 mb-2">
                    <h6 class="actions-panel-heading mb-2" style="font-weight:600; color:var(--theme-text-dark); font-size:0.85rem;"></h6>
                    <div class="actions-icon-grid row row-cols-3 row-cols-sm-4 row-cols-md-6 g-1 mb-2">
                        <div class="col">
                            <button type="button" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1 edit-client" data-idx="{{$client->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile">
                                <i class="ri-edit-line mb-1 text-primary" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Edit Profile</span>
                            </button>
                        </div>
                        <div class="col">
                            <div class="dropdown w-100">
                                <button class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1 dropdown-toggle" type="button" id="overviewChangeStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="top" title="Change Status">
                                    <i class="ri-flag-line mb-1 text-warning" style="font-size:1.25rem;"></i>
                                    <span class="small fw-semibold" style="font-size:0.68rem;">Change Status</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="overviewChangeStatusDropdown">
                                    @php $textStatusMapForDropdown = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ]; @endphp
                                    @foreach($textStatusMapForDropdown as $code => $text)
                                        <li><a class="dropdown-item change-case-status fs-xs" href="javascript:;" data-idx="{{ $client->id }}" data-case="{{ $code }}">Set {{ $text }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" id="inviteClientToPortalBtn" data-client-email="{{ $client->tax_payer_email ?? '' }}" data-client-name="{{ trim(($client->first_name ?? '') . ' ' . ($client->last_name ?? '')) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Invite to Portal">
                                <i class="ri-portal-line mb-1 text-info" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Invite Portal</span>
                            </button>
                        </div>
                        <div class="col">
                            <a href="/clients" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="All Clients">
                                <i class="ri-group-line mb-1 text-secondary" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">All Clients</span>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('clients.report.pdf', $client->id) }}" target="_new" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Summary Report">
                                <i class="ri-article-line mb-1 text-primary" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Summary Report</span>
                            </a>
                        </div>
                    </div>
                    <div class="actions-icon-grid row row-cols-3 row-cols-sm-4 row-cols-md-6 g-1">
                        <div class="col">
                            <a href="{{route('clients.pdf_f2848', $client->id)}}" target="_new" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Form 2848">
                                <i class="ri-printer-line mb-1 text-success" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Form 2848</span>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{route('clients.pdf_f8821', $client->id)}}" target="_new" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Form 8821">
                                <i class="ri-printer-line mb-1 text-success" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Form 8821</span>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{route('clients.pdf_f433a', $client->id)}}" target="_new" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Form 433-A">
                                <i class="ri-printer-line mb-1 text-success" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Form 433-A</span>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{route('clients.pdf_f433b', $client->id)}}" target="_new" class="btn btn-light w-100 d-flex flex-column align-items-center py-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Form 433-B">
                                <i class="ri-printer-line mb-1 text-success" style="font-size:1.25rem;"></i>
                                <span class="small fw-semibold" style="font-size:0.68rem;">Form 433-B</span>
                            </a>
                        </div>
                    </div>
                </div>
                <style>
                    .actions-icon-grid .btn {
                        border: 1px solid var(--theme-border-soft);
                        border-radius: var(--theme-border-radius-md);
                        box-shadow: var(--theme-shadow-subtle);
                        transition: box-shadow 0.2s, border-color 0.2s, background 0.2s;
                        min-height: 56px; min-width: 0; font-size: 0.68rem;
                    }
                    .actions-icon-grid .btn:hover, .actions-icon-grid .btn:focus {
                        box-shadow: var(--theme-shadow-card);
                        border-color: var(--theme-primary);
                        background: var(--theme-primary-light);
                        color: var(--theme-primary-dark);
                    }
                    .actions-icon-grid .btn:hover .small, .actions-icon-grid .btn:focus .small {
                        color: var(--theme-primary-dark) !important;
                    }
                    .actions-panel-heading { letter-spacing: 0.02em; }
                    @media (max-width: 575.98px) {
                        .actions-icon-grid .btn { min-height: 48px; padding: 0.5rem 0.25rem; }
                        .actions-panel-heading { font-size: 0.8rem; }
                    }
                </style>
                <hr class="my-4">
                <h5 class="mb-3"><i class="ri-history-line me-1"></i>Recent Activity</h5>
                @include('client.partials.timeline')
            </div>

            <div class="tab-pane fade show active" id="management-tab-pane" role="tabpanel" aria-labelledby="management-tab" tabindex="0">
                @include('client.partials.management-tab')
            </div>
            
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">@include('client.partials.overview-adapted')</div>
            <div class="tab-pane fade" id="calendar-tab-pane" role="tabpanel" aria-labelledby="calendar-tab" tabindex="0"><h5 class="tab-pane-title">Calendar</h5><p>Calendar content will go here.</p></div>
            <div class="tab-pane fade" id="financials-placeholder-tab-pane" role="tabpanel" aria-labelledby="financials-placeholder-tab" tabindex="0"><h5 class="tab-pane-title">Financials</h5><p>Financials content will go here.</p></div>
            <div class="tab-pane fade" id="transcripts-tab-pane" role="tabpanel" aria-labelledby="transcripts-tab" tabindex="0">@include('client.partials.transcripts')</div>
            <div class="tab-pane fade" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
                 <div id="card-file-manager">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="tab-pane-title mb-0">File Manager</h5>
                    </div>
                    @include('client.partials.files')
                </div>
            </div>
        </div>
        
        {{-- Modals (unchanged) --}}
        @include('client.modal.new')
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
                            <form id="createUserForm" style="display: none;">
                                <p>This client does not have a portal account yet. Create one below:</p>
                                <div class="mb-3"> <label for="createUserName" class="form-label">Name</label> <input type="text" class="form-control" id="createUserName" required> </div>
                                <div class="mb-3"> <label for="createUserEmail" class="form-label">Email address</label> <input type="email" class="form-control" id="createUserEmail" required readonly> </div>
                                <div class="mb-3"> <label for="createUserPassword" class="form-label">Password</label> <input type="password" class="form-control" id="createUserPassword" required> </div>
                                <div class="mb-3"> <label for="createUserPasswordConfirm" class="form-label">Confirm Password</label> <input type="password" class="form-control" id="createUserPasswordConfirm" required> </div>
                                <button type="submit" class="btn btn-primary w-100">Create Portal Account</button>
                            </form>
                            <form id="changePasswordForm" style="display: none;">
                                <p>This client already has a portal account. You can reset their password below:</p>
                                <div class="mb-3"> <label for="changePasswordEmail" class="form-label">Email address</label> <input type="email" class="form-control" id="changePasswordEmail" readonly> </div>
                                <div class="mb-3"> <label for="changePasswordNew" class="form-label">New Password</label> <input type="password" class="form-control" id="changePasswordNew" required> </div>
                                <div class="mb-3"> <label for="changePasswordNewConfirm" class="form-label">Confirm New Password</label> <input type="password" class="form-control" id="changePasswordNewConfirm" required> </div>
                                <button type="submit" class="btn btn-warning w-100">Change Password</button>
                            </form>
                        </div>
                        <div id="inviteClientError" class="alert alert-danger mt-3" style="display: none;"></div>
                        <div id="inviteClientSuccess" class="alert alert-success mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection


@section('scripts')
{{-- El Javascript no necesita cambios para el nuevo tema visual --}}
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
<script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.6/purify.min.js"></script>

<script>
jQuery(document).ready(function($) {

    // --- PAGE LOAD OVERLAY ---
    const pageOverlay = $('#page-load-overlay');
    if (pageOverlay.length) {
        setTimeout(() => {
            pageOverlay.addClass('fade-out');
            setTimeout(() => pageOverlay.remove(), 750);
        }, 50);
    }
    
    // MODIFIED: --- SIDEBAR MINI-MODE TOGGLE ---
    const layoutContainer = $('.taxlab-page-container');
    const toggleButton = $('#taxlab-sidebar-toggle');
    const toggleIcon = toggleButton.find('i');
    
    // Initialize tooltip
    const toggleTooltip = new bootstrap.Tooltip(toggleButton[0]);

    toggleButton.on('click', function() {
        layoutContainer.toggleClass('sidebar-is-mini');
        
        const isMini = layoutContainer.hasClass('sidebar-is-mini');
        
        if (isMini) {
            toggleIcon.removeClass('ri-menu-fold-line').addClass('ri-menu-unfold-line');
            toggleButton.attr('data-bs-original-title', 'Expand Sidebar').tooltip('show');
        } else {
            toggleIcon.removeClass('ri-menu-unfold-line').addClass('ri-menu-fold-line');
            toggleButton.attr('data-bs-original-title', 'Minimize Sidebar').tooltip('show');
        }
    });
    
    // Set initial tooltip text
    toggleButton.attr('data-bs-original-title', 'Minimize Sidebar').tooltip('update');


    // MODIFIED: --- SIDEBAR CLIENT FILTERING (via dropdown) ---
    function applyClientFilters() {
        let searchTerm = $('#sidebar-search-input').val().toLowerCase().trim();
        // Get status from the active link in the dropdown
        let statusFilter = $('#client-status-filter-options .dropdown-item.active').data('status') || 'all';

        $('.client-list-item').each(function() {
            let clientName = $(this).data('name').toLowerCase();
            let clientStatus = $(this).data('status');

            let nameMatch = searchTerm === '' || clientName.includes(searchTerm);
            let statusMatch = (statusFilter === 'all') || (clientStatus === statusFilter);

            if (nameMatch && statusMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Event listener for search input
    $('#sidebar-search-input').on('keyup', applyClientFilters);
    
    // Event listener for filter dropdown
    $('#client-status-filter-options').on('click', '.dropdown-item', function(e) {
        e.preventDefault();
        $('#client-status-filter-options .dropdown-item').removeClass('active');
        $(this).addClass('active');
        applyClientFilters();
    });


    // Initialize Bootstrap tooltips (excluding the sidebar toggle which is handled separately)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]:not(#taxlab-sidebar-toggle)'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // SSN Toggle Functionality
    $(document).on('click', '#ssn-toggle', function() {
        var ssnContainer = $('#ssn-container');
        var masked = ssnContainer.find('.ssn-masked');
        var revealed = ssnContainer.find('.ssn-revealed');
        
        if (masked.is(':visible')) {
            masked.hide();
            revealed.show();
            $(this).removeClass('ri-eye-line').addClass('ri-eye-off-line');
        } else {
            masked.show();
            revealed.hide();
            $(this).removeClass('ri-eye-off-line').addClass('ri-eye-line');
        }
    });
    
    // Change Case Status
    $(document).on('click', '.change-case-status', function(e) {
        e.preventDefault();
        var _this = $(this);
        var fieldName = 'case_status';
        var _value = _this.attr('data-case');
        var confirmationMsg = `Are you sure you want to change the case status? This will reload the page.`;

        if (!confirm(confirmationMsg)) return;

        var $dropdownButton = _this.closest('.dropdown-menu').siblings('.dropdown-toggle');
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
                let errorMsg = `An error occurred while changing case status.`;
                try { errorMsg = JSON.parse(jqXHR.responseText).message || errorMsg; } catch (e) {}
                toast_msg(errorMsg, "error", "Error");
                if($dropdownButton.length) $dropdownButton.prop('disabled', false).find('.spinner-border').remove();
            }
        });
    });

    // --- Portal Invite Modal Logic (unchanged) ---
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
        hideElement(inviteSpinner); hideElement(createUserForm); hideElement(changePasswordForm);
        hideElement(inviteClientError); hideElement(inviteClientSuccess);
        if (createUserForm.length) createUserForm[0].reset();
        if (changePasswordForm.length) changePasswordForm[0].reset();
        inviteClientError.text(''); inviteClientSuccess.text('');
        inviteClientModalLabel.text('Invite Client to Portal');
        inviteSpinnerMessage.text('Checking client portal status...');
        showElement(inviteFormContainer);
    }

    $(document).on('click', '#inviteClientToPortalBtn', function(e) {
        e.preventDefault();
        if (!inviteModal) { console.error('Invite modal not initialized'); return; }
        resetInviteModal();
        const clientEmail = $(this).data('client-email');
        const clientName = $(this).data('client-name');
        $('#inviteClientEmailHidden').val(clientEmail);
        $('#inviteClientNameHidden').val(clientName);

        if (!clientEmail) { inviteClientError.text('Client email is not available.').show(); inviteModal.show(); return; }
        if (!currentClientId) { inviteClientError.text('Client ID is not available.').show(); inviteModal.show(); return; }
        inviteModal.show();

        $.ajax({
            url: '{{ route("clients.portal.check_status") }}', type: 'POST',
            data: { email: clientEmail, client_id: currentClientId, _token: '{{ csrf_token() }}' },
            dataType: 'json',
            beforeSend: function() { inviteSpinnerMessage.text('Checking client portal status...'); showElement(inviteSpinner); hideElement(inviteFormContainer); hideElement(inviteClientError); hideElement(inviteClientSuccess); },
            success: function(response) {
                hideElement(inviteSpinner); showElement(inviteFormContainer);
                if (response.exists) {
                    inviteClientModalLabel.text('Manage Client Portal Account'); $('#changePasswordEmail').val(clientEmail);
                    showElement(changePasswordForm); hideElement(createUserForm);
                } else {
                    inviteClientModalLabel.text('Create Client Portal Account'); $('#createUserName').val(clientName || ''); $('#createUserEmail').val(clientEmail);
                    showElement(createUserForm); hideElement(changePasswordForm);
                }
            },
            error: function(jqXHR) {
                hideElement(inviteSpinner); showElement(inviteFormContainer);
                let errorMsg = 'Error checking user status: ' + ( (jqXHR.responseJSON && (jqXHR.responseJSON.message || Object.values(jqXHR.responseJSON.errors).flat().join(' '))) || 'Please try again.' );
                inviteClientError.text(errorMsg).show();
            }
        });
    });
});
</script>

@include('client.js-profile') 
@include('client.js-detail-client')

@endsection