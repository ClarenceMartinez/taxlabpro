<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
      /* --- Base Navbar Minimalist Styling --- */
      /* --- Font Setup --- */
      #layout-navbar {
        font-family: 'Poppins', sans-serif; /* Use Poppins font */
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        background-color: #ffffff;
        position: relative; /* Needed for absolute positioning of mobile search */
        z-index: 1030; /* Ensure navbar is above default content but below mobile menu */
      }

      /* --- Desktop Brand Logo/Text (Hidden on Mobile) --- */
      #layout-navbar .app-brand.demo {
         /* Base styles apply, but d-none d-xl-flex hides it below xl */
      }
      #layout-navbar .app-brand-logo svg {
        width: 1.25em;
        height: 1.25em;
      }
      #layout-navbar .app-brand-text {
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
      }
      #layout-navbar .app-brand-text .idle-color-svg {
        font-weight: 600;
      }

      /* --- Desktop Inline Navigation Links (Hidden on Mobile) --- */
      #layout-navbar .navbar-nav .nav-link.small {
        font-size: 0.8rem;
        font-weight: 400;
        padding: 0.4rem 0.8rem;
        color: #566a7f;
        transition: all 0.25s ease-in-out;
        border-radius: 4px;
        position: relative;
        border: none;
        background-color: transparent;
        text-decoration: none; /* Ensure no underline */
      }

      #layout-navbar .navbar-nav .nav-link.small:hover,
      #layout-navbar .navbar-nav .nav-link.small:focus {
        color: var(--bs-primary);
        background-color: rgba(var(--bs-primary-rgb), 0.07);
        outline: none;
      }

      #layout-navbar .navbar-nav .nav-link.small.active {
        color: var(--bs-primary);
        font-weight: 600;
        background-color: rgba(var(--bs-primary-rgb), 0.1);
      }

      #layout-navbar .navbar-nav .nav-link.small.active:hover,
      #layout-navbar .navbar-nav .nav-link.small.active:focus {
        color: var(--bs-primary);
        background-color: rgba(var(--bs-primary-rgb), 0.12);
      }
      /* --- End Desktop Link Styles --- */

      /* --- Right-side Icons (Search, User) --- */
      #layout-navbar .navbar-nav-right .nav-link.btn-icon,
      #layout-navbar .navbar-nav-right .nav-link.search-toggler { /* Target search toggle specifically */
        padding: 0.3rem 0.6rem; /* Default padding */
        color: #566a7f;
        border-radius: 50%; /* Circular icon buttons */
        transition: all 0.2s ease-in-out;
        background: none; /* Ensure no button background */
        border: none; /* Ensure no button border */
      }
      #layout-navbar .navbar-nav-right .nav-link.btn-icon:hover,
      #layout-navbar .navbar-nav-right .nav-link.btn-icon:focus,
      #layout-navbar .navbar-nav-right .nav-link.search-toggler:hover,
      #layout-navbar .navbar-nav-right .nav-link.search-toggler:focus {
         background-color: rgba(var(--bs-primary-rgb), 0.07);
         color: var(--bs-primary);
         outline: none;
      }


      /* --- User Dropdown --- */
      #layout-navbar .dropdown-menu {
        font-size: 0.85rem;
        border: 1px solid #e7e7e7;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border-radius: 6px;
        margin-top: 0.5rem !important;
        min-width: 15rem; /* Ensure enough width */
      }

      #layout-navbar .dropdown-item {
        padding: 0.4rem 1.1rem;
        font-weight: 400;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        display: flex; /* Use flex for icon alignment */
        align-items: center; /* Vertically center icon and text */
        text-decoration: none; /* Remove underline */
      }
      #layout-navbar .dropdown-item:hover,
      #layout-navbar .dropdown-item:focus {
        background-color: rgba(var(--bs-primary-rgb), 0.05);
        color: var(--bs-primary);
      }
      #layout-navbar .dropdown-item i {
        font-size: 1.1rem; /* Icon size */
        margin-right: 0.9rem !important; /* Space between icon and text */
        color: #8a919a;
        width: 1.2em; /* Fixed width for alignment */
        text-align: center;
        transition: color 0.2s ease-in-out;
        flex-shrink: 0; /* Prevent icon shrinking */
      }
      #layout-navbar .dropdown-item:hover i,
      #layout-navbar .dropdown-item:focus i {
          color: var(--bs-primary);
      }
      #layout-navbar .dropdown-item .align-middle{ /* Target the text span */
        color: #434d58;
        flex-grow: 1; /* Allow text to take remaining space */
      }
       #layout-navbar .dropdown-item:hover .align-middle, /* Adjust text color on hover too */
       #layout-navbar .dropdown-item:focus .align-middle {
          color: var(--bs-primary);
       }
      #layout-navbar .dropdown-menu .dropdown-item .fw-medium.d-block.small { /* User name in header */
        font-size: 0.85rem;
        font-weight: 500 !important;
        color: #333;
       }
       #layout-navbar .dropdown-menu .dropdown-item small.text-muted { /* User role in header */
        font-size: 0.75rem;
        color: #788390 !important;
       }
      #layout-navbar .dropdown-divider {
        border-top: 1px solid #ebeef0;
        margin: 0.4rem 0;
      }
      #layout-navbar .dropdown-menu .btn-danger {
        font-size: 0.8rem;
        font-weight: 500;
        --bs-btn-color: var(--bs-danger); /* Text color */
        --bs-btn-bg: transparent;
        --bs-btn-border-color: transparent;
        --bs-btn-hover-color: #fff; /* Text color on hover */
        --bs-btn-hover-bg: var(--bs-danger);
        --bs-btn-hover-border-color: var(--bs-danger);
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: var(--bs-danger);
        --bs-btn-active-border-color: var(--bs-danger);
        width: 100%; /* Make button fill grid space */
        justify-content: center; /* Center content within button */
      }
       #layout-navbar .dropdown-menu .btn-danger i {
           color: var(--bs-danger); /* Initial icon color */
           margin-right: 0; /* Reset margin from dropdown-item */
           margin-left: 0.5rem; /* Add space after text */
           transition: color 0.2s ease-in-out;
       }
        #layout-navbar .dropdown-menu .btn-danger:hover i,
        #layout-navbar .dropdown-menu .btn-danger:focus i {
           color: #fff; /* Icon color on hover */
        }
      #layout-navbar .dropdown-menu .d-grid.px-4 {
         padding-left: 1.1rem !important;
         padding-right: 1.1rem !important;
         padding-top: 0.5rem !important;
         padding-bottom: 0.5rem !important;
      }
      /* --- End User Dropdown --- */


      /* --- Idle Color SVG Animation --- */
      .idle-color-svg {
        animation: idleColorChange 4s infinite;
        color: var(--bs-primary);
      }
      @keyframes idleColorChange {
        0%   { color: var(--bs-primary); }
        25%  { color: #a8abff; }
        50%  { color: var(--bs-primary); }
        75%  { color:rgb(106, 109, 190); }
        100% { color: var(--bs-primary); }
      }
      /* --- End Idle Color SVG Animation --- */


     /* ==========================================================================
        Mobile Styles (Below XL Breakpoint - typically < 1200px)
        ========================================================================== */
     @media (max-width: 1199.98px) {

        /* Adjust Navbar Container Padding */
        #layout-navbar .container-xxl {
            padding-left: 1rem;  /* Reduce horizontal padding */
            padding-right: 1rem;
            max-width: 100%; /* Allow container to fill width */
        }

        /* Mobile Menu Toggle Button (Left Side) */
        #layout-navbar .layout-menu-toggle .nav-link {
            padding: 0.4rem; /* Adjust padding for touch */
            margin-right: 0.5rem; /* Space between toggle and right icons */
            color: #566a7f; /* Ensure consistent color */
            border-radius: 50%;
            transition: background-color 0.2s ease-in-out;
            border: none; /* Ensure no button border */
            background: none; /* Ensure no button background */
        }
         #layout-navbar .layout-menu-toggle .nav-link:hover,
         #layout-navbar .layout-menu-toggle .nav-link:focus {
            background-color: rgba(0, 0, 0, 0.04); /* Subtle hover */
            outline: none;
         }
         #layout-navbar .layout-menu-toggle i {
            font-size: 1.5rem; /* Make toggle icon slightly larger */
            display: block; /* Prevent inline alignment issues */
         }


        /* Right Side Icons Spacing */
        #layout-navbar .navbar-nav-right .nav-item {
           margin-left: 0.2rem; /* Add small space between right icons */
        }
        #layout-navbar .navbar-nav-right .nav-link.btn-icon,
        #layout-navbar .navbar-nav-right .nav-link.search-toggler {
            padding: 0.25rem 0.5rem; /* Slightly smaller padding on mobile */
        }
        #layout-navbar .navbar-nav-right .nav-item.navbar-search-wrapper {
            margin-left: 0; /* Reset margin if needed for search */
        }


        /* Mobile Search Input Wrapper (Shown via JS) */
        .navbar-search-wrapper.search-input-wrapper {
           /* Styles apply when .d-none is removed */
           position: absolute; /* Position over the navbar */
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           background-color: #ffffff;
           padding: 0 1rem; /* Padding inside the search bar */
           display: flex;
           align-items: center;
           z-index: 1050; /* Higher than navbar but below mobile menu/modals */
           box-shadow: 0 1px 3px rgba(0,0,0,0.1); /* Add shadow */
           opacity: 0; /* Start hidden for transition */
           visibility: hidden;
           transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
        }
        .navbar-search-wrapper.search-input-wrapper.active {
           opacity: 1;
           visibility: visible;
        }
        .navbar-search-wrapper .search-input {
           flex-grow: 1; /* Input takes available space */
           height: 100%;
           font-size: 0.9rem; /* Adjust font size */
           border: none;
           outline: none;
           padding: 0 0.5rem; /* Padding inside input */
           background: transparent; /* Ensure input bg is transparent */
        }
        .navbar-search-wrapper .search-toggler { /* The close (X) icon */
           padding-left: 0.75rem;
           color: #8a919a; /* Muted color for close icon */
           font-size: 1.5rem; /* Make close icon tappable */
           cursor: pointer;
           background: none; /* Ensure no button background */
           border: none; /* Ensure no button border */
        }
         .navbar-search-wrapper .search-toggler:hover {
            color: var(--bs-primary);
         }

     } /* End Media Query */

    /* ==========================================================================
        NEW: Mobile Off-Canvas Menu Styles
        ========================================================================== */

    /* --- Mobile Menu Overlay --- */
    #mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 1090; /* Below menu, above content */
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0s linear 0.3s; /* Hide instantly after fade */
    }

    /* --- Mobile Menu Panel --- */
    #mobile-menu-panel {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px; /* Adjust width as needed */
        max-width: 85%; /* Ensure it doesn't take full screen on small devices */
        height: 100vh; /* Full viewport height */
        background-color: #ffffff;
        z-index: 1100; /* Above overlay and navbar */
        transform: translateX(-100%); /* Initially hidden off-screen */
        transition: transform 0.3s ease-in-out;
        overflow-y: auto; /* Allow scrolling if content is long */
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
    }

    /* --- Mobile Menu Header (Optional: For Brand/Close Button) --- */
    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e0e0e0;
        flex-shrink: 0; /* Prevent header from shrinking */
    }
     .mobile-menu-header .app-brand-link {
        text-decoration: none;
     }
    .mobile-menu-header .app-brand-text {
        font-size: 0.9rem;
        font-weight: 500;
     }
     .mobile-menu-header .app-brand-logo svg {
         width: 1.25em;
         height: 1.25em;
     }

    #mobile-menu-close {
        background: none;
        border: none;
        font-size: 1.8rem; /* Larger close icon */
        color: #566a7f;
        padding: 0.25rem;
        line-height: 1;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    #mobile-menu-close:hover {
        color: var(--bs-primary);
    }

    /* --- Mobile Menu Links Container --- */
    .mobile-menu-links {
        list-style: none;
        padding: 0.5rem 0;
        margin: 0;
        flex-grow: 1; /* Allow links to take remaining space */
    }
    .mobile-menu-links li {
        margin: 0;
    }
    .mobile-menu-links .nav-link {
        display: block;
        padding: 0.8rem 1.5rem;
        color: #566a7f;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .mobile-menu-links .nav-link:last-child {
        border-bottom: none;
    }
    .mobile-menu-links .nav-link:hover,
    .mobile-menu-links .nav-link:focus {
        background-color: rgba(var(--bs-primary-rgb), 0.05);
        color: var(--bs-primary);
        outline: none;
    }
    /* Style for active link in mobile menu (Handled by Blade now) */
    .mobile-menu-links .nav-link.active {
         background-color: rgba(var(--bs-primary-rgb), 0.08);
         color: var(--bs-primary);
         font-weight: 600;
    }

    /* --- Active State (Menu Open) --- */
    body.mobile-menu-active {
        overflow: hidden; /* Prevent background scrolling when menu is open */
    }
    body.mobile-menu-active #mobile-menu-overlay {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease-in-out; /* Fade in */
    }
    body.mobile-menu-active #mobile-menu-panel {
        transform: translateX(0); /* Slide menu in */
    }

    /* --- End Mobile Off-Canvas Menu Styles --- */

      /* --- End Navbar Minimalist Styling --- */
</style>

<!-- Navbar -->
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">

        <!-- Mobile Menu Toggle Button -->
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)" id="mobile-menu-toggle">
                <i class="ri-menu-fill ri-22px"></i>
            </a>
        </div>
        <!-- / Mobile Menu Toggle Button -->

        <!-- Desktop Brand (Hidden on Mobile) -->
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="{{ url('/') }}" class="app-brand-link gap-2"> 
                <span class="app-brand-logo demo">
                    <span style="color: var(--bs-primary);">
                    <svg class="idle-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                        <title>Portal</title>
                        <path d="M 50 5 C 10 5, 10 95, 50 95 C 60 95, 75 85, 85 75 C 95 65, 98 55, 95 45 C 90 25, 70 5, 50 5 Z M 50 20 C 30 20, 25 40, 25 50 C 25 60, 30 80, 50 80 C 70 80, 75 60, 75 50 C 75 40, 70 20, 50 20 Z" fill-rule="evenodd"/>
                    </svg>
                    </span>
                </span>
                <span class="app-brand-text demo menu-text fw-semibold">Taxlab<span class="idle-color-svg">Pro</span></span>
            </a>
        </div>
        <!-- / Desktop Brand -->

        <!-- Mobile Brand (Optional: Centered or near toggle) -->
        <div class="navbar-brand app-brand demo d-flex d-xl-none py-0 me-4 flex-grow-1 justify-content-center">
            <a href="{{ url('/') }}" class="app-brand-link gap-2"> {{-- Use url('/') for consistent home link --}}
                <span class="app-brand-logo demo">
                    <span style="color: var(--bs-primary);">
                        <svg class="idle-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                            <title>Portal</title>
                            <path d="M 50 5 C 10 5, 10 95, 50 95 C 60 95, 75 85, 85 75 C 95 65, 98 55, 95 45 C 90 25, 70 5, 50 5 Z M 50 20 C 30 20, 25 40, 25 50 C 25 60, 30 80, 50 80 C 70 80, 75 60, 75 50 C 75 40, 70 20, 50 20 Z" fill-rule="evenodd"/>
                        </svg>
                    </span>
                </span>
                <span class="app-brand-text demo menu-text fw-semibold">Taxlab<span class="idle-color-svg">Pro</span></span>
            </a>
        </div>

        <!-- Navbar right -->
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <!-- Desktop Inline Links - Hidden on mobile (below xl), check active state -->
            <ul class="navbar-nav flex-row align-items-center me-auto d-none d-xl-flex">
                {{-- Use request()->is() to check the current path.
                     The '*' is a wildcard.
                     Adjust patterns as needed for your specific routes.
                     Use || for multiple conditions (e.g., home could be '/' or '/dashboard').
                     Use named routes (request()->routeIs('name')) if you prefer and have them defined.
                --}}
                <li class="nav-item px-2">
                    {{-- Match '/' OR '/clients' exactly for Home --}}
                    <a class="nav-link small {{ (request()->is('/') || request()->is('clients')) && !request()->is('clients/*') ? 'active' : '' }}" href="{{ url('/clients') }}">Home</a>
                </li>
                <li class="nav-item px-2">
                    {{-- Match '/users/profile' and any sub-paths like '/users/profile/edit' --}}
                    <a class="nav-link small {{ request()->is('users/profile*') ? 'active' : '' }}" href="{{ url('/users/profile') }}">Account</a>
                </li>
                <li class="nav-item px-2">
                     {{-- Match '/clients/*' but NOT just '/clients' (handled by Home) --}}
                    <a class="nav-link small {{ request()->is('clients/*') ? 'active' : '' }}" href="{{ url('/clients') }}">Clients</a>
                     {{-- NOTE: If Home IS '/clients', this 'Clients' link might need different logic or href --}}
                     {{-- OR if 'Home' should only be active on '/', and 'Clients' on '/clients' or '/clients/*' : --}}
                     {{-- Home: <a class="nav-link small {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a> --}}
                     {{-- Clients: <a class="nav-link small {{ request()->is('clients*') ? 'active' : '' }}" href="{{ url('/clients') }}">Clients</a> --}}
                </li>
                <li class="nav-item px-2">
                    {{-- Match '/users' or '/users/*' BUT NOT '/users/profile*' --}}
                    <a class="nav-link small {{ (request()->is('users') || request()->is('users/*')) && !request()->is('users/profile*') ? 'active' : '' }}" href="{{ url('/users') }}">Users</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link small {{ request()->is('company*') ? 'active' : '' }}" href="{{ url('/company') }}">Company</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link small {{ request()->is('calendar*') ? 'active' : '' }}" href="{{ url('/calendar') }}">Calendar</a>
                </li>
                <li class="nav-item px-2">
                    {{-- Use a more specific pattern if '/dev' might match other things --}}
                    <a class="nav-link small {{ request()->is('dev*') ? 'active' : '' }}" href="{{ url('/dev') }}">Settings</a>
                </li>
                 <li class="nav-item px-2">
                    {{-- Example for Configuration if it has its own page --}}
                    <a class="nav-link small {{ request()->is('configuration*') ? 'active' : '' }}" href="{{ url('/configuration') }}">Configuration</a>
                </li>
            </ul>
            <!-- /Desktop Inline Links -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Search Toggle (Works on all sizes now) -->
                <li class="nav-item navbar-search-wrapper me-1">
                    <a class="nav-link search-toggler fw-normal" href="javascript:void(0);" id="search-toggle-icon">
                        <i class="ri-search-line ri-22px scaleX-n1-rtl"></i>
                    </a>
                </li>
                <!-- /Search Toggle -->

                <!-- User Dropdown -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow btn-icon" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ri-user-line ri-22px"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            {{-- User Info Header - Link to profile page --}}
                            <a class="dropdown-item" href="{{ url('/users/profile') }}"> {{-- Use url helper --}}
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        {{-- Replace with dynamic user data --}}
                                        <span class="fw-medium d-block small">{{ Auth::user()?->name ?? 'Example User' }}</span>
                                        <small class="text-muted">{{ Auth::user()?->role ?? 'Admin' }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            {{-- Profile link - can be same as header link --}}
                            <a class="dropdown-item" href="{{ url('/users/profile') }}"> {{-- Use url helper --}}
                                <i class="ri-user-3-line"></i><span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/configuration') }}"> {{-- Use url helper --}}
                                <i class="ri-settings-4-line"></i><span class="align-middle">Configuration</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <div class="d-grid px-4 pt-2 pb-1">
                                {{-- Add a form for logout for security (POST request) --}}
                                <form method="POST" action="{{ route('auth.logout') }}"> {{-- Assuming you have a named route 'logout' --}}
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center w-100">
                                        <small class="align-middle me-auto">Logout</small>
                                        <i class="ri-logout-box-r-line ri-16px"></i>
                                    </button>
                                </form>
                                {{-- Fallback if no form/route needed (less secure) --}}
                                {{-- <a class="btn btn-sm btn-danger d-flex align-items-center" href="#logout-link">
                                    <small class="align-middle me-auto">Logout</small>
                                    <i class="ri-logout-box-r-line ri-16px"></i>
                                </a> --}}
                            </div>
                        </li>
                    </ul>
                </li>
                <!--/ User Dropdown -->
            </ul>
        </div>

        <!-- Search Input Wrapper (Initially hidden, shown via JS) -->
        <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none" id="search-input-wrapper">
            <input
                type="text"
                class="form-control search-input border-0"
                placeholder="Search..."
                aria-label="Search..."
                id="search-input-field" />
            <i class="ri-close-fill search-toggler cursor-pointer" id="search-close-icon"></i>
        </div>
        <!-- /Search Input Wrapper -->

    </div>
</nav>
<!-- / Navbar -->

<!-- NEW: Mobile Menu Panel -->
<div id="mobile-menu-panel">
    <div class="mobile-menu-header">
        <!-- Mobile Menu Brand (Optional) -->
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary);">
                    <svg class="idle-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                        <title>Portal</title>
                        <path d="M 50 5 C 10 5, 10 95, 50 95 C 60 95, 75 85, 85 75 C 95 65, 98 55, 95 45 C 90 25, 70 5, 50 5 Z M 50 20 C 30 20, 25 40, 25 50 C 25 60, 30 80, 50 80 C 70 80, 75 60, 75 50 C 75 40, 70 20, 50 20 Z" fill-rule="evenodd"/>
                    </svg>
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-semibold">Taxlab<span class="idle-color-svg">Pro</span></span>
        </a>
        <button id="mobile-menu-close" aria-label="Close Menu"><i class="ri-close-line"></i></button>
    </div>
    <ul class="mobile-menu-links">
        {{-- Replicate links from desktop nav here, using the same active state logic --}}
        <li>
            <a class="nav-link {{ (request()->is('/') || request()->is('clients')) && !request()->is('clients/*') ? 'active' : '' }}" href="{{ url('/clients') }}">Home</a>
        </li>
        <li>
            <a class="nav-link {{ request()->is('users/profile*') ? 'active' : '' }}" href="{{ url('/users/profile') }}">Account</a>
        </li>
        <li>
             {{-- Same logic considerations as desktop 'Clients' link --}}
            <a class="nav-link {{ request()->is('clients/*') ? 'active' : '' }}" href="{{ url('/clients') }}">Clients</a>
        </li>
        <li>
            <a class="nav-link {{ (request()->is('users') || request()->is('users/*')) && !request()->is('users/profile*') ? 'active' : '' }}" href="{{ url('/users') }}">Users</a>
        </li>
        <li>
            <a class="nav-link {{ request()->is('company*') ? 'active' : '' }}" href="{{ url('/company') }}">Company</a>
        </li>
        <li>
            <a class="nav-link {{ request()->is('calendar*') ? 'active' : '' }}" href="{{ url('/calendar') }}">Calendar</a>
        </li>
        <li>
            <a class="nav-link {{ request()->is('dev*') ? 'active' : '' }}" href="{{ url('/dev') }}">Settings</a>
        </li>
         <li>
            <a class="nav-link {{ request()->is('configuration*') ? 'active' : '' }}" href="{{ url('/configuration') }}">Configuration</a>
        </li>
        {{-- Add other links corresponding to desktop nav if needed --}}
    </ul>
</div>
<!-- /Mobile Menu Panel -->

<!-- NEW: Mobile Menu Overlay -->
<div id="mobile-menu-overlay"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
      const mobileMenuPanel = document.getElementById('mobile-menu-panel');
      const mobileMenuClose = document.getElementById('mobile-menu-close');
      const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
      const body = document.body;

      const searchToggleIcon = document.getElementById('search-toggle-icon');
      const searchInputWrapper = document.getElementById('search-input-wrapper');
      const searchCloseIcon = document.getElementById('search-close-icon');
      const searchInputField = document.getElementById('search-input-field');

      // --- Mobile Menu Logic ---
      if (mobileMenuToggle && mobileMenuPanel && mobileMenuClose && mobileMenuOverlay) {
        mobileMenuToggle.addEventListener('click', function (e) {
          e.preventDefault();
          body.classList.add('mobile-menu-active');
        });

        mobileMenuClose.addEventListener('click', function (e) {
          e.preventDefault();
          body.classList.remove('mobile-menu-active');
        });

        mobileMenuOverlay.addEventListener('click', function (e) {
          e.preventDefault();
          body.classList.remove('mobile-menu-active');
        });

        // NOTE: Active class logic for mobile links is now handled by Blade server-side.
        // The JavaScript code previously here for adding 'active' class is removed.

      } else {
        console.error("Mobile menu elements not found.");
      }

      // --- Mobile Search Logic ---
      if (searchToggleIcon && searchInputWrapper && searchCloseIcon && searchInputField) {
        searchToggleIcon.addEventListener('click', function(e) {
          e.preventDefault();
          searchInputWrapper.classList.remove('d-none');
          // Use a small timeout to allow the element to become visible before transitioning opacity
          setTimeout(() => {
            searchInputWrapper.classList.add('active');
            searchInputField.focus(); // Focus the input field
          }, 10);
        });

        searchCloseIcon.addEventListener('click', function(e) {
           e.preventDefault();
           searchInputWrapper.classList.remove('active');
           // Wait for opacity transition to finish before hiding with d-none
           searchInputWrapper.addEventListener('transitionend', () => {
                // Check if it's still meant to be hidden (in case of rapid clicks)
                if (!searchInputWrapper.classList.contains('active')) {
                    searchInputWrapper.classList.add('d-none');
                }
           }, { once: true }); // Remove listener after it runs once
        });

        // Optional: Close search if clicked outside
        document.addEventListener('click', function(event) {
            const isClickInsideSearch = searchInputWrapper.contains(event.target);
            const isClickOnToggler = searchToggleIcon.contains(event.target);

            if (!isClickInsideSearch && !isClickOnToggler && searchInputWrapper.classList.contains('active')) {
                searchCloseIcon.click(); // Trigger the close action
            }
        });

      } else {
          console.error("Search elements not found.");
      }

    });
</script>