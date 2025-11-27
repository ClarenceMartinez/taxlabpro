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
        --theme-border-radius-sm: 0.15rem;
        --theme-border-radius-md: 0.25rem;
        --theme-border-radius-lg: 0.4rem;
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
        --bs-gutter-x: 0.5rem;
        --bs-gutter-y: 0.5rem;
        --sidebar-collapsed-width: 60px;
        --sidebar-expanded-width: 210px;
    }

    body {
        font-family: var(--theme-font-family);
        color: var(--theme-text-medium);
        font-size: 0.65rem;
        letter-spacing: 0.005em;
        background-color: #FFF;
    }

    /* --- Primary Sidebar and Main Content Wrapper --- */
    #primary-sidebar {
        width: var(--sidebar-expanded-width);
        background-color: var(--theme-bg-card-alt);
        border-right: 1px solid var(--theme-border-soft);
        height: 100vh;
        position: sticky;
        top: 0;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        z-index: 1050;
        transition: width 0.3s ease-in-out;
    }

    #primary-sidebar .sidebar-logo {
        padding: 0.8rem 1.2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--theme-text-dark);
        border-bottom: 1px solid var(--theme-border-soft);
        white-space: nowrap;
        overflow: hidden;
    }

    #primary-sidebar .nav {
        padding-top: 0.5rem;
        flex-grow: 1;
    }

    #primary-sidebar .nav-link {
        display: flex;
        align-items: center;
        padding: 0.5rem 1.2rem;
        color: var(--theme-text-medium);
        font-weight: 500;
        font-size: 0.7rem;
        border-left: 3px solid transparent;
        transition: all 0.2s ease-in-out;
        white-space: nowrap;
        overflow: hidden;
    }
    #primary-sidebar .nav-link i {
        font-size: 1.1rem;
        margin-right: 0.8rem;
        width: 18px;
        text-align: center;
        color: var(--theme-text-light);
        transition: color 0.2s ease-in-out, margin 0.3s ease-in-out;
    }
    #primary-sidebar .nav-link span {
        transition: opacity 0.2s ease-in-out;
    }
    #primary-sidebar .nav-link:hover {
        color: var(--theme-primary);
        background-color: var(--theme-primary-light);
    }
    #primary-sidebar .nav-link:hover i {
        color: var(--theme-primary);
    }
    #primary-sidebar .nav-link.active {
        color: var(--theme-primary-dark);
        background-color: var(--theme-primary-light);
        border-left-color: var(--theme-primary);
        font-weight: 600;
    }
    #primary-sidebar .nav-link.active i {
        color: var(--theme-primary);
    }

    #primary-sidebar.sidebar-collapsed {
        width: var(--sidebar-collapsed-width);
    }
    #primary-sidebar.sidebar-collapsed .sidebar-logo {
        padding-left: 0; padding-right: 0; text-align: center;
    }
    #primary-sidebar.sidebar-collapsed .sidebar-logo span {
        opacity: 0; visibility: hidden; width: 0;
    }
    #primary-sidebar.sidebar-collapsed .nav-link {
        justify-content: center; padding-left: 0; padding-right: 0;
    }
    #primary-sidebar.sidebar-collapsed .nav-link i {
        margin-right: 0;
    }
    #primary-sidebar.sidebar-collapsed .nav-link span {
        opacity: 0; visibility: hidden; width: 0;
    }

    .sidebar-footer {
        padding: 0.6rem 1.2rem;
        border-top: 1px solid var(--theme-border-soft);
        flex-shrink: 0;
        text-align: right;
        transition: padding 0.3s ease-in-out;
        white-space: nowrap;
        overflow: hidden;
    }
    #primary-sidebar.sidebar-collapsed .sidebar-footer {
        padding: 0.6rem 0; text-align: center;
    }
    #sidebar-pin-toggle {
        font-size: 1.1rem;
        color: var(--theme-text-light); cursor: pointer;
    }
    #sidebar-pin-toggle:hover { color: var(--theme-primary); }

    /* ========================================================== */
    /*               AQUÍ EMPIEZAN LOS CAMBIOS                  */
    /* ========================================================== */
    
    #primary-content-area {
        flex-grow: 1; 
        width: 0;
        height: 100vh; 
    }
    
    /* CAMBIO: Se ha añadido #onboarding-section a la lista */
    #onboarding-section, #clients-section, #dashboard-section, #chat-section, #profile-section, #calendar-section, #notifications-section, #settings-section, #billing-section, #organization-section {
        width: 100%; 
        height: 100%; 
        background-color: var(--theme-bg-main);
        overflow-y: auto;
    }

    /* ========================================================== */
    /*                AQUÍ TERMINAN LOS CAMBIOS                   */
    /* ========================================================== */

    /* --- ESTILOS GENERALES Y DE COMPONENTES NO USADOS EN LA VISTA DEL CLIENTE --- */
    .container-xxl, .container-fluid {
        padding-top: 0; padding-bottom: 0; max-width: 100% !important;
    }
    hr { border-top: 1px solid var(--theme-border-soft); margin: 0.25rem 0; }
    .card-header {
        background-color: var(--theme-primary-light);
        border-bottom: 1px solid var(--theme-primary);
        padding: 0.25rem 0.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    .card-header .card-title-icon {
        font-size: 0.8rem;
        color: var(--theme-primary-text-on-light);
        margin-right: 0.25rem;
    }
    .card-title {
        margin-bottom: 0;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--theme-primary-text-on-light);
        flex-grow: 1;
    }
    .card-body-compact { padding: 0.3rem 0.5rem; }
    #overview-tab-pane .tab-pane-title { border-bottom: none; }
    .tab-content .row { display: flex; flex-wrap: wrap; }
    .tab-content .row > [class^="col-"] { display: flex; flex-direction: column; }
    .tab-content .row > [class^="col-"] .card { flex-grow: 1; }
    .tab-pane .card-header { background-color: var(--theme-bg-card-alt); border-bottom: 1px solid var(--theme-border-soft); color: var(--theme-text-dark); }
    .tab-pane .card-header .card-title, .tab-pane .card-header .card-title-icon { color: var(--theme-text-dark); }
    .tab-pane .card-header .card-title-icon { color: var(--theme-primary); }
    .btn-icon.btn-sm.rounded-circle { width: 24px; height: 24px; }
    .form-select { font-size: 0.65rem; border-radius: var(--theme-border-radius-sm); border: 1px solid var(--theme-border-strong); padding: 0.2rem 0.4rem; background-color: var(--theme-bg-card); color: var(--theme-text-medium); }
    .form-select:focus { border-color: var(--theme-primary); box-shadow: var(--theme-shadow-interactive); }
    label.form-label { font-weight: 500; margin-bottom: 0.1rem; font-size: 0.62rem; color: var(--theme-text-dark); }

    #page-load-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 1060; opacity: 1; visibility: visible; transition: opacity 0.7s ease, visibility 0.7s ease; display: flex; justify-content: center; align-items: center; flex-direction: column; }
    #page-load-overlay.fade-out { opacity: 0; visibility: hidden; }
    #page-load-overlay h3 { font-weight: 500; color: #566a7f; font-family: 'Poppins', sans-serif; }
    #page-load-overlay .spinner-border { margin-top: 1rem; }
    #primary-content-area .dropdown-menu { z-index: 1070; }

    /* --- MEDIA QUERY GENERAL (solo reglas restantes) --- */
    @media (max-width: 991.98px) {
      #primary-sidebar { display: none; }
    }
</style>

@endsection
 
@section('content')

<!-- Page Overlay -->
<div id="page-load-overlay">
    <h3>Taxlab<span style="color: var(--bs-primary);">pro</span></h3>
    <div class="spinner-border text-primary" role="status"></div>
</div>

<!-- Main Layout Container -->
<div class="d-flex">

    <!-- Primary Sidebar (Collapsible) -->
    <nav id="primary-sidebar" class="sidebar-collapsed">
        <div class="sidebar-logo">
            TLP<span></span>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-dashboard" title="Dashboard">
                    <i class="ri-dashboard-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- ======================= NUEVA SECCIÓN AÑADIDA ======================= -->
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-onboarding" title="Onboarding">
                    <i class="ri-user-add-line"></i>
                    <span>Onboarding</span>
                </a>
            </li>
            <!-- ===================================================================== -->
            <li class="nav-item">
                <a class="nav-link active" href="#" id="nav-clients" title="Clients">
                    <i class="ri-group-2-line"></i>
                    <span>Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-chat" title="Chat">
                    <i class="ri-chat-3-line"></i>
                    <span>Chat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-profile" title="Profile">
                    <i class="ri-user-settings-line"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-calendar" title="Calendar">
                    <i class="ri-calendar-todo-line"></i>
                    <span>Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-notifications" title="Notifications">
                    <i class="ri-notification-4-line"></i>
                    <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-settings" title="Settings">
                    <i class="ri-settings-3-line"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-billing" title="Billing">
                    <i class="ri-wallet-3-line"></i>
                    <span>Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="nav-organization" title="Organization">
                    <i class="ri-building-line"></i>
                    <span>Organization</span>
                </a>
            </li>
        </ul>
        <!-- Sidebar Footer with Pin Toggle Button -->
        <div class="sidebar-footer">
            <i class="ri-pushpin-line" id="sidebar-pin-toggle" data-bs-toggle="tooltip" data-bs-placement="right" title="Pin sidebar"></i>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main id="primary-content-area">
        
        <!-- Dashboard Section -->
        <section id="dashboard-section" style="display: none; padding: 2rem;">
            @include('client.sections.user-dashboard')
        </section>

        <!-- ======================= NUEVA SECCIÓN AÑADIDA ======================= -->
        <section id="onboarding-section" style="display: none;">
            @include('client.sections.onboarding')
        </section>
        <!-- ===================================================================== -->
        
        <!-- Clients Section -->
        <section id="clients-section" style="display: none;">
            @include('client.sections.client-profile')
        </section>
        
        <!-- Additional Content Sections -->
        <section id="chat-section" style="display: none;">
        <!-- Current chat section has conflict, when an action is made the screen goes gray -->
        </section>
    
        <section id="profile-section" style="display: none; padding: 2rem;">
            @include('client.sections.user-profile')
        </section>
    
        <section id="calendar-section" style="display: none; padding: 2rem;">
            @include('client.sections.calendar')
        </section>
    
        <section id="notifications-section" style="display: none; padding: 2rem;">
            <h1>Notifications</h1>
            <p>Este es el marcador de posición para la sección Notifications. El contenido de las notificaciones se mostrará aquí.</p>
        </section>
    
        <section id="settings-section" style="display: none; padding: 2rem;">
            <h1>Settings</h1>
            <p>Este es el marcador de posición para la sección Settings. El contenido de la configuración de la aplicación se mostrará aquí.</p>
        </section>
    
        <section id="billing-section" style="display: none; padding: 2rem;">
            <h1>Billing</h1>
            <p>Este es el marcador de posición para la sección Billing. El contenido de facturación y pagos se mostrará aquí.</p>
        </section>
    
        <section id="organization-section" style="display: none; padding: 2rem;">
            <h1>Organization</h1>
            <p>Este es el marcador de posición para la sección Organization. El contenido para la gestión de la organización se mostrará aquí.</p>
        </section>

    </main>
</div>

@endsection


@section('scripts')
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

    const $body = $('body');
    const $sidebar = $('#primary-sidebar');
    const $pinToggle = $('#sidebar-pin-toggle');
    // Check if pinToggle exists before initializing tooltip
    if ($pinToggle.length > 0) {
        const pinTooltip = new bootstrap.Tooltip($pinToggle[0]);
    }


    // --- Collapsible Sidebar Logic ---

    // 1. Pin Toggle Button Logic
    $pinToggle.on('click', function() {
        $body.toggleClass('sidebar-pinned');
        
        if ($body.hasClass('sidebar-pinned')) {
            // If pinned -> expand and change icon/tooltip
            $sidebar.removeClass('sidebar-collapsed');
            $(this).removeClass('ri-pushpin-line').addClass('ri-pushpin-fill');
            // Ensure pinTooltip is defined before using it
            if (typeof pinTooltip !== 'undefined') {
                pinTooltip.setContent({ '.tooltip-inner': 'Unpin sidebar' });
            }
        } else {
            // If unpinned -> collapse and change icon/tooltip
            $sidebar.addClass('sidebar-collapsed');
            $(this).removeClass('ri-pushpin-fill').addClass('ri-pushpin-line');
            // Ensure pinTooltip is defined before using it
             if (typeof pinTooltip !== 'undefined') {
                pinTooltip.setContent({ '.tooltip-inner': 'Pin sidebar' });
            }
        }
    });

    // 2. Hover Logic (only works if not pinned)
    $sidebar.on('mouseenter', function() {
        if (!$body.hasClass('sidebar-pinned')) {
            $(this).removeClass('sidebar-collapsed');
        }
    }).on('mouseleave', function() {
        if (!$body.hasClass('sidebar-pinned')) {
            $(this).addClass('sidebar-collapsed');
        }
    });

    // --- Primary Sidebar Navigation ---
    $('#primary-sidebar .nav-link').on('click', function(e) {
        e.preventDefault();
        
        $('#primary-sidebar .nav-link').removeClass('active');
        $(this).addClass('active');
        
        const targetId = $(this).attr('id');

        // --- INTEGRACIÓN: Inicializar el script de llamada ---
        if (targetId === 'nav-onboarding') {
            if (typeof window.initializeCallScript === 'function') {
                window.initializeCallScript();
            }
        }
        // --- FIN DE LA INTEGRACIÓN ---
        
        // CAMBIO: Se ha añadido #onboarding-section a la lista de secciones para ocultar
        $('#dashboard-section, #onboarding-section, #clients-section, #chat-section, #profile-section, #calendar-section, #notifications-section, #settings-section, #billing-section, #organization-section').hide();
        
        // CAMBIO: Se ha añadido la nueva sección al mapa de navegación
        const sectionMap = {
            'nav-dashboard': '#dashboard-section',
            'nav-onboarding': '#onboarding-section',
            'nav-clients': '#clients-section',
            'nav-chat': '#chat-section',
            'nav-profile': '#profile-section',
            'nav-calendar': '#calendar-section',
            'nav-notifications': '#notifications-section',
            'nav-settings': '#settings-section',
            'nav-billing': '#billing-section',
            'nav-organization': '#organization-section'
        };

        if (sectionMap[targetId]) {
            $(sectionMap[targetId]).show();
        }
    });

    // Simulate a click on the active link to show the correct section on page load
    $('#primary-sidebar .nav-link.active').trigger('click');

    // --- PAGE LOAD OVERLAY ---
    const pageOverlay = $('#page-load-overlay');
    if (pageOverlay.length) {
        setTimeout(() => {
            pageOverlay.addClass('fade-out');
            setTimeout(() => pageOverlay.remove(), 750);
        }, 50);
    }
    

    // --- OTHER FUNCTIONALITY ---
    // Initialize all Bootstrap tooltips on the page
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

});
</script>
@endsection