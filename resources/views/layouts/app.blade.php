<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Portal | Taisho Pharmaceutical Indonesia')
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            background: #f6faff;

            color: #304a5a;

            overflow-x: hidden;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .app-sidebar {

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            width: 255px;

            background:
                linear-gradient(
                    180deg,
                    #dff4ff 0%,
                    #eaf8ff 50%,
                    #f3fbff 100%
                );

            border-right: 1px solid #d9ebf4;

            z-index: 1050;

            display: flex;

            flex-direction: column;

            overflow-y: auto;

            overflow-x: hidden;
        }


        /* =====================================================
           SCROLLBAR
        ===================================================== */

        .app-sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .app-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .app-sidebar::-webkit-scrollbar-thumb {
            background: #c6dfec;

            border-radius: 10px;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .sidebar-brand {

            min-height: 82px;

            padding: 0 22px;

            display: flex;

            align-items: center;

            gap: 12px;

            border-bottom:
                1px solid
                rgba(160, 204, 225, .35);
        }


        .brand-icon {

            width: 42px;
            height: 42px;

            flex-shrink: 0;

            border-radius: 13px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #72c5f2,
                    #399bd1
                );

            color: white;

            font-size: 19px;

            box-shadow:
                0 7px 15px
                rgba(57,155,209,.20);
        }


        .brand-text {

            min-width: 0;
        }


        .brand-title {

            color: #28536a;

            font-size: 16px;

            font-weight: 800;

            line-height: 1.2;

            margin: 0;
        }


        .brand-subtitle {

            color: #7194a7;

            font-size: 8.5px;

            font-weight: 600;

            margin-top: 4px;

            line-height: 1.3;

            max-width: 160px;
        }


        /* =====================================================
           SIDEBAR USER
        ===================================================== */

        .sidebar-user {

            margin: 18px 15px 8px;

            padding: 13px;

            background:
                rgba(255,255,255,.65);

            border:
                1px solid
                rgba(190,221,236,.7);

            border-radius: 14px;
        }


        .sidebar-user-info {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .sidebar-avatar {

            width: 36px;
            height: 36px;

            flex-shrink: 0;

            border-radius: 11px;

            background: #d4efff;

            color: #2788c0;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 14px;

            font-weight: 800;
        }


        .sidebar-user-name {

            color: #365769;

            font-size: 11px;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .sidebar-user-role {

            color: #7d9aaa;

            font-size: 9px;

            margin-top: 2px;

            text-transform: capitalize;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .sidebar-section {

            padding: 15px 15px 6px;

            color: #8ba5b3;

            font-size: 9px;

            font-weight: 800;

            letter-spacing: .8px;

            text-transform: uppercase;
        }


        .sidebar-nav {

            padding: 0 11px;
        }


        .sidebar-link {

            width: 100%;

            min-height: 43px;

            display: flex;

            align-items: center;

            gap: 11px;

            padding: 10px 13px;

            margin-bottom: 4px;

            border-radius: 11px;

            color: #557586;

            text-decoration: none;

            font-size: 12px;

            font-weight: 600;

            transition:
                background .18s ease,
                color .18s ease,
                transform .18s ease;
        }


        .sidebar-link i {

            width: 20px;

            text-align: center;

            font-size: 16px;

            flex-shrink: 0;
        }


        .sidebar-link:hover {

            background:
                rgba(255,255,255,.72);

            color: #2385be;

            transform:
                translateX(2px);
        }


        .sidebar-link.active {

            background: white;

            color: #2188c3;

            box-shadow:
                0 5px 14px
                rgba(57,133,170,.09);

            font-weight: 700;
        }


        .sidebar-link.active i {

            color: #2d99d5;
        }


        /* =====================================================
           SIDEBAR FOOTER
        ===================================================== */

        .sidebar-footer {

            margin-top: auto;

            padding: 13px 15px 17px;

            border-top:
                1px solid
                rgba(160,204,225,.3);
        }


        .sidebar-footer-text {

            color: #94aab6;

            font-size: 8px;

            line-height: 1.5;

            text-align: center;

            margin-bottom: 10px;
        }


        .logout-button {

            width: 100%;

            border: none;

            background:
                rgba(255,255,255,.65);

            color: #718b99;

            border-radius: 10px;

            padding: 9px;

            font-size: 11px;

            font-weight: 600;

            transition: .18s ease;

            cursor: pointer;
        }


        .logout-button:hover {

            background: #fff0f0;

            color: #d75f5f;
        }


        /* =====================================================
           MAIN AREA
        ===================================================== */

        .app-main {

            margin-left: 255px;

            min-height: 100vh;

            width:
                calc(100% - 255px);

            background: #f7fbfe;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .app-topbar {

            height: 76px;

            width: 100%;

            background:
                rgba(255,255,255,.96);

            border-bottom:
                1px solid
                #e4edf2;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 30px;

            position: sticky;

            top: 0;

            z-index: 900;

            backdrop-filter: blur(8px);
        }


        .topbar-left {

            min-width: 0;
        }


        .topbar-title {

            color: #29495b;

            font-size: 18px;

            font-weight: 800;

            margin: 0;

            line-height: 1.2;
        }


        .topbar-description {

            color: #8ba0ac;

            font-size: 10px;

            margin: 5px 0 0;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .topbar-right {

            display: flex;

            align-items: center;

            gap: 12px;

            flex-shrink: 0;
        }


        .topbar-profile {

            display: flex;

            align-items: center;

            gap: 9px;

            padding-left: 12px;

            border-left:
                1px solid
                #e4edf2;
        }


        .topbar-avatar {

            width: 36px;
            height: 36px;

            border-radius: 11px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #dff3ff;

            color: #2689c4;

            font-size: 12px;

            font-weight: 800;
        }


        .topbar-user-name {

            color: #405b6b;

            font-size: 11px;

            font-weight: 700;

            max-width: 130px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .topbar-user-role {

            color: #91a2ac;

            font-size: 9px;

            text-transform: capitalize;

            margin-top: 2px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .app-content {

            width: 100%;

            padding:
                28px 30px 35px;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .app-alert {

            border-radius: 12px;

            border: none;

            font-size: 12px;

            margin-bottom: 20px;

            box-shadow:
                0 4px 15px
                rgba(40,90,120,.05);
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .app-footer {

            padding:
                0 30px 25px;

            color: #9aabb5;

            font-size: 9px;
        }


        /* =====================================================
           MOBILE BUTTON
        ===================================================== */

        .mobile-menu-button {

            display: none;

            width: 37px;
            height: 37px;

            border:
                1px solid
                #dcebf2;

            background: white;

            color: #4385a5;

            border-radius: 10px;

            align-items: center;

            justify-content: center;

            cursor: pointer;
        }


        .sidebar-overlay {

            display: none;

            position: fixed;

            inset: 0;

            background:
                rgba(26,54,69,.35);

            z-index: 1040;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991px) {

            .app-sidebar {

                transform:
                    translateX(-100%);

                transition:
                    transform .25s ease;
            }


            .app-sidebar.show {

                transform:
                    translateX(0);
            }


            .app-main {

                margin-left: 0;

                width: 100%;
            }


            .mobile-menu-button {

                display: flex;
            }


            .sidebar-overlay.show {

                display: block;
            }


            .app-topbar {

                padding:
                    0 18px;
            }


            .app-content {

                padding:
                    22px 18px 30px;
            }


            .app-footer {

                padding:
                    0 18px 20px;
            }

        }


        @media (max-width: 575px) {

            .app-topbar {

                height: 68px;
            }


            .topbar-title {

                font-size: 15px;
            }


            .topbar-description {

                display: none;
            }


            .topbar-profile-text {

                display: none;
            }


            .topbar-profile {

                border-left: none;

                padding-left: 0;
            }


            .app-content {

                padding:
                    18px 14px 25px;
            }

        }

    </style>

    @stack('styles')

</head>


<body>


    <!-- =====================================================
         MOBILE OVERLAY
    ===================================================== -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeSidebar()"
    ></div>


    <!-- =====================================================
         SIDEBAR
    ===================================================== -->

    <aside
        class="app-sidebar"
        id="appSidebar"
    >


        <!-- =================================================
             BRAND
        ================================================= -->

        <div class="sidebar-brand">

            <div class="brand-icon">

                @auth

                    @if(Auth::user()->role === 'ehs')

                        <i class="bi bi-shield-check"></i>

                    @elseif(Auth::user()->role === 'procurement')

                        <i class="bi bi-cart-check"></i>

                    @elseif(Auth::user()->role === 'admin')

                        <i class="bi bi-gear"></i>

                    @else

                        <i class="bi bi-file-earmark-check"></i>

                    @endif

                @else

                    <i class="bi bi-file-earmark-check"></i>

                @endauth

            </div>


            <div class="brand-text">

                @auth

                    @if(Auth::user()->role === 'ehs')

                        <div class="brand-title">
                            EHS Portal
                        </div>

                        <div class="brand-subtitle">
                            Environmental, Health & Safety
                        </div>

                    @elseif(Auth::user()->role === 'procurement')

                        <div class="brand-title">
                            Procurement Portal
                        </div>

                        <div class="brand-subtitle">
                            Procurement Information System
                        </div>

                    @elseif(Auth::user()->role === 'admin')

                        <div class="brand-title">
                            Admin Portal
                        </div>

                        <div class="brand-subtitle">
                            E-URS Management System
                        </div>

                    @else

                        <div class="brand-title">
                            E-URS
                        </div>

                        <div class="brand-subtitle">
                            Taisho Procurement Portal
                        </div>

                    @endif

                @else

                    <div class="brand-title">
                        E-URS
                    </div>

                    <div class="brand-subtitle">
                        Taisho Procurement Portal
                    </div>

                @endauth

            </div>

        </div>


        @auth

        <!-- =================================================
             USER INFORMATION
        ================================================= -->

        <div class="sidebar-user">

            <div class="sidebar-user-info">

                <div class="sidebar-avatar">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>


                <div style="min-width:0;">

                    <div class="sidebar-user-name">

                        {{ Auth::user()->name }}

                    </div>


                    <div class="sidebar-user-role">

                        {{ Auth::user()->role }}

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             NAVIGATION TITLE
        ================================================= -->

        <div class="sidebar-section">

            @if(Auth::user()->role === 'ehs')

                EHS Menu

            @elseif(Auth::user()->role === 'procurement')

                Procurement Menu

            @elseif(Auth::user()->role === 'admin')

                Administration

            @else

                Main Menu

            @endif

        </div>


        <!-- =================================================
             NAVIGATION
        ================================================= -->

        <nav class="sidebar-nav">


            {{-- =================================================
                 EHS
            ================================================= --}}

            @if(Auth::user()->role === 'ehs')


                <!-- Dashboard -->

                <a
                    href="{{ route('ehs.dashboard') }}"
                    class="sidebar-link
                    {{ request()->routeIs('ehs.dashboard') ? 'active' : '' }}"
                >

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>Dashboard</span>

                </a>


                <!-- EHS Review -->

                <a
                    href="{{ route('ehs.review.list') }}"
                    class="sidebar-link
                    {{
                        request()->routeIs('ehs.review.list')
                        || request()->routeIs('ehs.review')
                            ? 'active'
                            : ''
                    }}"
                >

                    <i class="bi bi-shield-check"></i>

                    <span>EHS Review</span>

                </a>


            {{-- =================================================
                 USER
            ================================================= --}}

            @elseif(Auth::user()->role === 'user')


                <!-- Dashboard -->

                <a
                    href="{{ route('user.dashboard') }}"
                    class="sidebar-link
                    {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                >

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>Dashboard</span>

                </a>


                <!-- Create E-URS -->

                <a
                    href="{{ route('user.eurs.create') }}"
                    class="sidebar-link
                    {{ request()->routeIs('user.eurs.create') ? 'active' : '' }}"
                >

                    <i class="bi bi-file-earmark-plus"></i>

                    <span>Create E-URS</span>

                </a>


                <!-- My Requests -->

                <a
                    href="{{ route('user.eurs.index') }}"
                    class="sidebar-link
                    {{
                        request()->routeIs('user.eurs.index')
                        || request()->routeIs('user.eurs.show')
                            ? 'active'
                            : ''
                    }}"
                >

                    <i class="bi bi-folder2-open"></i>

                    <span>My Requests</span>

                </a>


            {{-- =================================================
                 PROCUREMENT
            ================================================= --}}

            @elseif(Auth::user()->role === 'procurement')


                <!-- Procurement Dashboard -->

                <a
                    href="{{ route('procurement.dashboard') }}"
                    class="sidebar-link
                    {{ request()->routeIs('procurement.dashboard') ? 'active' : '' }}"
                >

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>Dashboard</span>

                </a>


            {{-- =================================================
                 ADMIN
            ================================================= --}}

            @elseif(Auth::user()->role === 'admin')


                <!-- Admin Dashboard -->

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="sidebar-link
                    {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                >

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>Dashboard</span>

                </a>


            @endif

        </nav>


        <!-- =================================================
             SIDEBAR FOOTER
        ================================================= -->

        <div class="sidebar-footer">


            <div class="sidebar-footer-text">

                @if(Auth::user()->role === 'ehs')

                    Environmental, Health & Safety

                    <br>

                    EHS Review Portal

                @elseif(Auth::user()->role === 'procurement')

                    Procurement Information System

                    <br>

                    PT Taisho Pharmaceutical Indonesia Tbk.

                @elseif(Auth::user()->role === 'admin')

                    E-URS Management System

                    <br>

                    PT Taisho Pharmaceutical Indonesia Tbk.

                @else

                    Electronic User Requirement Specification

                    <br>

                    Procurement Information System

                @endif

            </div>


            <!-- Logout -->

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Sign Out

                </button>

            </form>

        </div>

        @endauth

    </aside>


    <!-- =====================================================
         MAIN
    ===================================================== -->

    <main class="app-main">


        <!-- =================================================
             TOPBAR
        ================================================= -->

        <header class="app-topbar">


            <div class="topbar-left d-flex align-items-center gap-3">


                <!-- Mobile Menu -->

                <button
                    type="button"
                    class="mobile-menu-button"
                    onclick="openSidebar()"
                >

                    <i class="bi bi-list"></i>

                </button>


                <div>

                    <h1 class="topbar-title">

                        @yield(
                            'page-title',
                            'Dashboard'
                        )

                    </h1>


                    <p class="topbar-description">

                        @hasSection('page-description')

                            @yield('page-description')

                        @else

                            @auth

                                @if(Auth::user()->role === 'ehs')

                                    Environmental, Health & Safety Portal

                                @elseif(Auth::user()->role === 'procurement')

                                    Procurement Information System

                                @elseif(Auth::user()->role === 'admin')

                                    E-URS Management System

                                @else

                                    Electronic User Requirement Specification

                                @endif

                            @else

                                Electronic User Requirement Specification

                            @endauth

                        @endif

                    </p>

                </div>

            </div>


            @auth

            <!-- =================================================
                 TOPBAR PROFILE
            ================================================= -->

            <div class="topbar-right">

                <div class="topbar-profile">

                    <div class="topbar-avatar">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>


                    <div class="topbar-profile-text">

                        <div class="topbar-user-name">

                            {{ Auth::user()->name }}

                        </div>


                        <div class="topbar-user-role">

                            {{ Auth::user()->role }}

                        </div>

                    </div>

                </div>

            </div>

            @endauth

        </header>


        <!-- =================================================
             CONTENT
        ================================================= -->

        <div class="app-content">


            <!-- Success -->

            @if(session('success'))

                <div
                    class="alert alert-success app-alert"
                    role="alert"
                >

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            <!-- Error -->

            @if(session('error'))

                <div
                    class="alert alert-danger app-alert"
                    role="alert"
                >

                    <i class="bi bi-exclamation-circle-fill me-2"></i>

                    {{ session('error') }}

                </div>

            @endif


            <!-- Validation Errors -->

            @if($errors->any())

                <div
                    class="alert alert-danger app-alert"
                    role="alert"
                >

                    <div class="fw-bold mb-1">

                        Please check the following:

                    </div>


                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                            <li>

                                {{ $error }}

                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            @yield('content')

        </div>


        <!-- =================================================
             FOOTER
        ================================================= -->

        <footer class="app-footer">

            @auth

                @if(Auth::user()->role === 'ehs')

                    EHS Portal
                    &nbsp;•&nbsp;
                    PT Taisho Pharmaceutical Indonesia Tbk.

                @elseif(Auth::user()->role === 'procurement')

                    Procurement Information System
                    &nbsp;•&nbsp;
                    PT Taisho Pharmaceutical Indonesia Tbk.

                @elseif(Auth::user()->role === 'admin')

                    E-URS Management System
                    &nbsp;•&nbsp;
                    PT Taisho Pharmaceutical Indonesia Tbk.

                @else

                    E-URS Procurement Information System
                    &nbsp;•&nbsp;
                    PT Taisho Pharmaceutical Indonesia Tbk.

                @endif

            @else

                PT Taisho Pharmaceutical Indonesia Tbk.

            @endauth

        </footer>


    </main>


    <!-- =====================================================
         BOOTSTRAP JS
    ===================================================== -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>


    <!-- =====================================================
         SIDEBAR SCRIPT
    ===================================================== -->

    <script>

        function openSidebar() {

            document
                .getElementById('appSidebar')
                .classList.add('show');

            document
                .getElementById('sidebarOverlay')
                .classList.add('show');

        }


        function closeSidebar() {

            document
                .getElementById('appSidebar')
                .classList.remove('show');

            document
                .getElementById('sidebarOverlay')
                .classList.remove('show');

        }


        document
            .querySelectorAll('.sidebar-link')
            .forEach(function(link) {

                link.addEventListener(
                    'click',
                    function() {

                        if (
                            window.innerWidth <= 991
                        ) {

                            closeSidebar();

                        }

                    }
                );

            });

    </script>


    @stack('scripts')

</body>

</html>