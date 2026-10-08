@extends('layouts.app')

@section('title', 'E-URS | Procurement Dashboard')

@section('page-title', 'Procurement Dashboard')

@section('page-description', 'Manage and process approved E-URS procurement requests')

@section('content')

    <!-- Welcome Section -->
    <div class="welcome-card">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <div class="mb-2">
                    <span class="badge rounded-pill text-bg-light px-3 py-2">
                        <i class="bi bi-briefcase me-1"></i>
                        Procurement Staff
                    </span>
                </div>

                <h2 class="welcome-title">
                    Welcome, {{ Auth::user()->name }}
                </h2>

                <p class="welcome-text">
                    Review approved E-URS requests and manage procurement
                    processing through the E-URS Procurement Portal.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                <a href="#"
                   class="btn btn-taisho px-4 py-3">

                    <i class="bi bi-clipboard-check me-2"></i>
                    View Requests

                </a>

            </div>

        </div>

    </div>


    <!-- Statistics -->
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-inbox"></i>
                </div>

                <div class="stat-label">
                    New Requests
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div class="stat-label">
                    In Processing
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-check2-circle"></i>
                </div>

                <div class="stat-label">
                    Completed
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </div>

                <div class="stat-label">
                    Needs Attention
                </div>

                <div class="stat-value">
                    0
                </div>

            </div>

        </div>

    </div>


    <!-- Main Content -->
    <div class="row g-4">

        <!-- Incoming Requests -->
        <div class="col-lg-8">

            <div class="content-card h-100">

                <div class="content-card-header">

                    <div>
                        <h5 class="content-card-title">
                            Incoming E-URS Requests
                        </h5>

                        <small class="text-muted">
                            Approved requests ready for procurement processing
                        </small>
                    </div>

                    <a href="#"
                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        View All
                    </a>

                </div>


                <div class="content-card-body">

                    <!-- Empty State -->
                    <div class="text-center py-5">

                        <div
                            class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="
                                width:70px;
                                height:70px;
                                border-radius:20px;
                                background:#eaf7ff;
                                color:#318fc8;
                                font-size:30px;
                            "
                        >
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                        <h6 class="fw-bold mb-2">
                            No new procurement requests
                        </h6>

                        <p class="text-muted small mb-4">
                            There are currently no approved E-URS requests
                            waiting for procurement processing.
                        </p>

                        <a href="#"
                           class="btn btn-taisho">

                            <i class="bi bi-list-check me-2"></i>
                            Open Request Queue

                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- Processing Summary -->
        <div class="col-lg-4">

            <div class="content-card h-100">

                <div class="content-card-header">

                    <div>
                        <h5 class="content-card-title">
                            Processing Summary
                        </h5>

                        <small class="text-muted">
                            Current procurement activity
                        </small>
                    </div>

                </div>


                <div class="content-card-body">

                    <!-- New -->
                    <div class="d-flex align-items-center justify-content-between mb-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="d-flex align-items-center justify-content-center me-3"
                                style="
                                    width:42px;
                                    height:42px;
                                    border-radius:12px;
                                    background:#eaf7ff;
                                    color:#318fc8;
                                "
                            >
                                <i class="bi bi-inbox"></i>
                            </div>

                            <div>
                                <div class="fw-semibold small">
                                    New Requests
                                </div>

                                <div class="text-muted"
                                     style="font-size:11px;">
                                    Ready for processing
                                </div>
                            </div>

                        </div>

                        <span class="fw-bold">
                            0
                        </span>

                    </div>


                    <!-- Processing -->
                    <div class="d-flex align-items-center justify-content-between mb-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="d-flex align-items-center justify-content-center me-3"
                                style="
                                    width:42px;
                                    height:42px;
                                    border-radius:12px;
                                    background:#fff7e6;
                                    color:#d99400;
                                "
                            >
                                <i class="bi bi-hourglass-split"></i>
                            </div>

                            <div>
                                <div class="fw-semibold small">
                                    Processing
                                </div>

                                <div class="text-muted"
                                     style="font-size:11px;">
                                    Currently being processed
                                </div>
                            </div>

                        </div>

                        <span class="fw-bold">
                            0
                        </span>

                    </div>


                    <!-- Completed -->
                    <div class="d-flex align-items-center">

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
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <div>
                                <div class="fw-semibold small">
                                    Completed
                                </div>

                                <div class="text-muted"
                                     style="font-size:11px;">
                                    Successfully completed
                                </div>
                            </div>

                        </div>

                        <span class="fw-bold ms-auto">
                            0
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Procurement Workflow -->
    <div class="content-card mt-4">

        <div class="content-card-header">

            <div>
                <h5 class="content-card-title">
                    Procurement Workflow
                </h5>

                <small class="text-muted">
                    E-URS processing flow
                </small>
            </div>

        </div>


        <div class="content-card-body">

            <div class="row g-4">

                <!-- Step 1 -->
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
                            <i class="bi bi-inbox"></i>
                        </div>

                        <h6 class="fw-bold">
                            1. Receive
                        </h6>

                        <p class="text-muted small mb-0">
                            Receive approved E-URS requests.
                        </p>

                    </div>

                </div>


                <!-- Step 2 -->
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
                            <i class="bi bi-search"></i>
                        </div>

                        <h6 class="fw-bold">
                            2. Review
                        </h6>

                        <p class="text-muted small mb-0">
                            Check specifications and procurement requirements.
                        </p>

                    </div>

                </div>


                <!-- Step 3 -->
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
                            <i class="bi bi-gear"></i>
                        </div>

                        <h6 class="fw-bold">
                            3. Process
                        </h6>

                        <p class="text-muted small mb-0">
                            Manage the procurement process.
                        </p>

                    </div>

                </div>


                <!-- Step 4 -->
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
                            <i class="bi bi-check2-circle"></i>
                        </div>

                        <h6 class="fw-bold">
                            4. Complete
                        </h6>

                        <p class="text-muted small mb-0">
                            Complete and record the procurement request.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Procurement Information -->
    <div class="content-card mt-4">

        <div class="content-card-header">

            <div>
                <h5 class="content-card-title">
                    Procurement Information
                </h5>

                <small class="text-muted">
                    Important request details
                </small>
            </div>

        </div>


        <div class="content-card-body">

            <div class="row g-3">

                <div class="col-md-4">

                    <div class="p-3 rounded-3"
                         style="
                            background:#f6fbfe;
                            border:1px solid #e5f2f8;
                         ">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-file-earmark-check text-primary fs-5 me-3"></i>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Approved Requests
                                </h6>

                                <p class="text-muted small mb-0">
                                    Only E-URS requests that have completed
                                    the required approval stages will appear here.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="p-3 rounded-3"
                         style="
                            background:#f6fbfe;
                            border:1px solid #e5f2f8;
                         ">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-card-checklist text-primary fs-5 me-3"></i>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Request Details
                                </h6>

                                <p class="text-muted small mb-0">
                                    Review item specifications, quantity,
                                    supplier information, and supporting files.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="p-3 rounded-3"
                         style="
                            background:#f6fbfe;
                            border:1px solid #e5f2f8;
                         ">

                        <div class="d-flex align-items-start">

                            <i class="bi bi-clock-history text-primary fs-5 me-3"></i>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Processing History
                                </h6>

                                <p class="text-muted small mb-0">
                                    Procurement activities will be recorded
                                    as part of the E-URS audit trail.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection