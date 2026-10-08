@extends('layouts.app')

@section('title', 'E-URS | Admin Dashboard')

@section('page-title', 'Admin Dashboard')

@section('page-description', 'Manage users, system configuration, and E-URS administration')

@section('content')

    <!-- Welcome Section -->
    <div class="welcome-card">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <div class="mb-2">
                    <span class="badge rounded-pill text-bg-light px-3 py-2">
                        <i class="bi bi-shield-lock me-1"></i>
                        System Administrator
                    </span>
                </div>

                <h2 class="welcome-title">
                    Welcome, {{ Auth::user()->name }}
                </h2>

                <p class="welcome-text">
                    Manage E-URS users, monitor system activity, and maintain
                    the procurement portal configuration.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                <a href="#"
                   class="btn btn-taisho px-4 py-3">

                    <i class="bi bi-person-plus me-2"></i>
                    Manage Users

                </a>

            </div>

        </div>

    </div>


    <!-- Statistics -->
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div class="stat-label">
                    Total Users
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <div class="stat-label">
                    Active Users
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div class="stat-label">
                    Total E-URS
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-activity"></i>
                </div>

                <div class="stat-label">
                    System Activity
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>

    </div>


    <!-- Main Content -->
    <div class="row g-4">

        <!-- User Management -->
        <div class="col-lg-8">

            <div class="content-card h-100">

                <div class="content-card-header">

                    <div>
                        <h5 class="content-card-title">
                            User Management
                        </h5>

                        <small class="text-muted">
                            Manage E-URS system accounts
                        </small>
                    </div>

                    <a href="#"
                       class="btn btn-sm btn-outline-primary rounded-pill px-3">

                        <i class="bi bi-people me-1"></i>
                        Manage

                    </a>

                </div>


                <div class="content-card-body">

                    <div class="row g-3">

                        <!-- User -->
                        <div class="col-md-4">

                            <div class="p-3 rounded-3 h-100"
                                 style="
                                    background:#f6fbfe;
                                    border:1px solid #e5f2f8;
                                 ">

                                <div
                                    class="d-flex align-items-center justify-content-center mb-3"
                                    style="
                                        width:45px;
                                        height:45px;
                                        border-radius:13px;
                                        background:#eaf7ff;
                                        color:#318fc8;
                                    "
                                >
                                    <i class="bi bi-person"></i>
                                </div>

                                <h6 class="fw-bold">
                                    Requester
                                </h6>

                                <p class="text-muted small mb-0">
                                    Manage users who create and submit
                                    E-URS requests.
                                </p>

                            </div>

                        </div>


                        <!-- EHS -->
                        <div class="col-md-4">

                            <div class="p-3 rounded-3 h-100"
                                 style="
                                    background:#f6fbfe;
                                    border:1px solid #e5f2f8;
                                 ">

                                <div
                                    class="d-flex align-items-center justify-content-center mb-3"
                                    style="
                                        width:45px;
                                        height:45px;
                                        border-radius:13px;
                                        background:#eaf7ff;
                                        color:#318fc8;
                                    "
                                >
                                    <i class="bi bi-shield-check"></i>
                                </div>

                                <h6 class="fw-bold">
                                    EHS Reviewer
                                </h6>

                                <p class="text-muted small mb-0">
                                    Manage authorized EHS reviewers
                                    for E-URS assessment.
                                </p>

                            </div>

                        </div>


                        <!-- Procurement -->
                        <div class="col-md-4">

                            <div class="p-3 rounded-3 h-100"
                                 style="
                                    background:#f6fbfe;
                                    border:1px solid #e5f2f8;
                                 ">

                                <div
                                    class="d-flex align-items-center justify-content-center mb-3"
                                    style="
                                        width:45px;
                                        height:45px;
                                        border-radius:13px;
                                        background:#eaf7ff;
                                        color:#318fc8;
                                    "
                                >
                                    <i class="bi bi-briefcase"></i>
                                </div>

                                <h6 class="fw-bold">
                                    Procurement
                                </h6>

                                <p class="text-muted small mb-0">
                                    Manage Procurement users
                                    and system access.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- System Status -->
        <div class="col-lg-4">

            <div class="content-card h-100">

                <div class="content-card-header">

                    <div>
                        <h5 class="content-card-title">
                            System Status
                        </h5>

                        <small class="text-muted">
                            E-URS platform status
                        </small>
                    </div>

                </div>


                <div class="content-card-body">

                    <!-- Application -->
                    <div class="d-flex align-items-center justify-content-between mb-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="d-flex align-items-center justify-content-center me-3"
                                style="
                                    width:42px;
                                    height:42px;
                                    border-radius:12px;
                                    background:#e9f9f0;
                                    color:#29995b;
                                "
                            >
                                <i class="bi bi-globe2"></i>
                            </div>

                            <div>

                                <div class="fw-semibold small">
                                    Application
                                </div>

                                <div class="text-muted"
                                     style="font-size:11px;">
                                    E-URS Portal
                                </div>

                            </div>

                        </div>

                        <span class="badge rounded-pill"
                              style="
                                background:#e9f9f0;
                                color:#29995b;
                              ">
                            Online
                        </span>

                    </div>


                    <!-- Database -->
                    <div class="d-flex align-items-center justify-content-between mb-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="d-flex align-items-center justify-content-center me-3"
                                style="
                                    width:42px;
                                    height:42px;
                                    border-radius:12px;
                                    background:#e9f9f0;
                                    color:#29995b;
                                "
                            >
                                <i class="bi bi-database-check"></i>
                            </div>

                            <div>

                                <div class="fw-semibold small">
                                    Database
                                </div>

                                <div class="text-muted"
                                     style="font-size:11px;">
                                    E-URS Database
                                </div>

                            </div>

                        </div>

                        <span class="badge rounded-pill"
                              style="
                                background:#e9f9f0;
                                color:#29995b;
                              ">
                            Connected
                        </span>

                    </div>


                    <!-- Authentication -->
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">

                            <div
                                class="d-flex align-items-center justify-content-center me-3"
                                style="
                                    width:42px;
                                    height:42px;
                                    border-radius:12px;
                                    background:#e9f9f0;
                                    color:#29995b;
                                "
                            >
                                <i class="bi bi-shield-lock"></i>
                            </div>

                            <div>

                                <div class="fw-semibold small">
                                    Authentication
                                </div>

                                <div class="text-muted"
                                     style="font-size:11px;">
                                    User access control
                                </div>

                            </div>

                        </div>

                        <span class="badge rounded-pill"
                              style="
                                background:#e9f9f0;
                                color:#29995b;
                              ">
                            Active
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Administration Menu -->
    <div class="content-card mt-4">

        <div class="content-card-header">

            <div>
                <h5 class="content-card-title">
                    Administration
                </h5>

                <small class="text-muted">
                    System management tools
                </small>
            </div>

        </div>


        <div class="content-card-body">

            <div class="row g-3">

                <!-- User Management -->
                <div class="col-md-4">

                    <a href="#"
                       class="text-decoration-none">

                        <div class="p-4 rounded-3 h-100"
                             style="
                                background:#f6fbfe;
                                border:1px solid #e5f2f8;
                             ">

                            <div
                                class="d-flex align-items-center justify-content-center mb-3"
                                style="
                                    width:50px;
                                    height:50px;
                                    border-radius:15px;
                                    background:#eaf7ff;
                                    color:#318fc8;
                                    font-size:21px;
                                "
                            >
                                <i class="bi bi-people"></i>
                            </div>

                            <h6 class="fw-bold text-dark">
                                User Management
                            </h6>

                            <p class="text-muted small mb-0">
                                Create, update, and manage E-URS
                                user accounts and roles.
                            </p>

                        </div>

                    </a>

                </div>


                <!-- System Settings -->
                <div class="col-md-4">

                    <a href="#"
                       class="text-decoration-none">

                        <div class="p-4 rounded-3 h-100"
                             style="
                                background:#f6fbfe;
                                border:1px solid #e5f2f8;
                             ">

                            <div
                                class="d-flex align-items-center justify-content-center mb-3"
                                style="
                                    width:50px;
                                    height:50px;
                                    border-radius:15px;
                                    background:#eaf7ff;
                                    color:#318fc8;
                                    font-size:21px;
                                "
                            >
                                <i class="bi bi-gear"></i>
                            </div>

                            <h6 class="fw-bold text-dark">
                                System Settings
                            </h6>

                            <p class="text-muted small mb-0">
                                Configure system parameters and
                                workflow settings.
                            </p>

                        </div>

                    </a>

                </div>


                <!-- Activity Logs -->
                <div class="col-md-4">

                    <a href="#"
                       class="text-decoration-none">

                        <div class="p-4 rounded-3 h-100"
                             style="
                                background:#f6fbfe;
                                border:1px solid #e5f2f8;
                             ">

                            <div
                                class="d-flex align-items-center justify-content-center mb-3"
                                style="
                                    width:50px;
                                    height:50px;
                                    border-radius:15px;
                                    background:#eaf7ff;
                                    color:#318fc8;
                                    font-size:21px;
                                "
                            >
                                <i class="bi bi-clock-history"></i>
                            </div>

                            <h6 class="fw-bold text-dark">
                                Activity Logs
                            </h6>

                            <p class="text-muted small mb-0">
                                Monitor system activities and
                                E-URS workflow history.
                            </p>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Administration Workflow -->
    <div class="content-card mt-4">

        <div class="content-card-header">

            <div>
                <h5 class="content-card-title">
                    E-URS Administration
                </h5>

                <small class="text-muted">
                    System management overview
                </small>
            </div>

        </div>


        <div class="content-card-body">

            <div class="row g-4">

                <div class="col-md-3">

                    <div class="text-center">

                        <div
                            class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="
                                width:50px;
                                height:50px;
                                border-radius:15px;
                                background:#eaf7ff;
                                color:#318fc8;
                                font-size:21px;
                            "
                        >
                            <i class="bi bi-people"></i>
                        </div>

                        <h6 class="fw-bold">
                            1. Manage Users
                        </h6>

                        <p class="text-muted small mb-0">
                            Manage accounts and system roles.
                        </p>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="text-center">

                        <div
                            class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="
                                width:50px;
                                height:50px;
                                border-radius:15px;
                                background:#eaf7ff;
                                color:#318fc8;
                                font-size:21px;
                            "
                        >
                            <i class="bi bi-diagram-3"></i>
                        </div>

                        <h6 class="fw-bold">
                            2. Configure
                        </h6>

                        <p class="text-muted small mb-0">
                            Maintain system workflow configuration.
                        </p>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="text-center">

                        <div
                            class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="
                                width:50px;
                                height:50px;
                                border-radius:15px;
                                background:#eaf7ff;
                                color:#318fc8;
                                font-size:21px;
                            "
                        >
                            <i class="bi bi-activity"></i>
                        </div>

                        <h6 class="fw-bold">
                            3. Monitor
                        </h6>

                        <p class="text-muted small mb-0">
                            Monitor system and workflow activities.
                        </p>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="text-center">

                        <div
                            class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="
                                width:50px;
                                height:50px;
                                border-radius:15px;
                                background:#eaf7ff;
                                color:#318fc8;
                                font-size:21px;
                            "
                        >
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h6 class="fw-bold">
                            4. Maintain
                        </h6>

                        <p class="text-muted small mb-0">
                            Maintain secure and reliable system access.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection