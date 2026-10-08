@extends('layouts.app')

@section('title', 'E-URS | EHS Dashboard')

@section('page-title', 'EHS Dashboard')

@section(
    'page-description',
    'Review, assess, and approve E-URS requests requiring EHS assessment'
)

@section('content')

<style>

    /* =========================================================
       EHS DASHBOARD
    ========================================================= */

    .ehs-dashboard {
        width: 100%;
        padding-bottom: 40px;
    }


    /* =========================================================
       WELCOME CARD
    ========================================================= */

    .ehs-welcome-card {
        position: relative;
        overflow: hidden;

        padding: 28px 30px;

        border-radius: 18px;

        background: linear-gradient(
            135deg,
            #0879bd 0%,
            #269bd0 55%,
            #61c4e8 100%
        );

        color: #ffffff;

        margin-bottom: 24px;

        box-shadow:
            0 10px 30px rgba(8, 121, 189, 0.16);
    }

    .ehs-welcome-card::before {
        content: "";

        position: absolute;

        width: 220px;
        height: 220px;

        right: -70px;
        top: -100px;

        border-radius: 50%;

        background: rgba(255,255,255,0.10);
    }

    .ehs-welcome-card::after {
        content: "";

        position: absolute;

        width: 140px;
        height: 140px;

        right: 90px;
        bottom: -90px;

        border-radius: 50%;

        background: rgba(255,255,255,0.08);
    }

    .ehs-welcome-content {
        position: relative;
        z-index: 2;
    }

    .ehs-welcome-label {
        font-size: 12px;
        font-weight: 600;

        opacity: 0.85;

        margin-bottom: 5px;
    }

    .ehs-welcome-title {
        font-size: 25px;
        font-weight: 700;

        margin-bottom: 7px;
    }

    .ehs-welcome-description {
        font-size: 12px;

        opacity: 0.9;

        max-width: 650px;

        line-height: 1.7;
    }


    /* =========================================================
       STATISTICS
    ========================================================= */

    .ehs-stat-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 16px;

        margin-bottom: 24px;
    }

    .ehs-stat-card {
        background: #ffffff;

        border: 1px solid #e7eef3;

        border-radius: 15px;

        padding: 20px;

        box-shadow:
            0 5px 18px rgba(27, 60, 82, 0.05);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .ehs-stat-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 8px 24px rgba(27, 60, 82, 0.08);
    }

    .ehs-stat-top {
        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-bottom: 15px;
    }

    .ehs-stat-icon {
        width: 42px;
        height: 42px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: #eaf6fd;

        color: #0879bd;

        font-size: 18px;
    }

    .ehs-stat-label {
        color: #7a8699;

        font-size: 11px;

        font-weight: 600;

        margin-bottom: 5px;
    }

    .ehs-stat-number {
        color: #253043;

        font-size: 25px;

        font-weight: 700;

        line-height: 1;
    }


    /* =========================================================
       CONTENT CARD
    ========================================================= */

    .ehs-content-card {
        background: #ffffff;

        border: 1px solid #e7eef3;

        border-radius: 15px;

        overflow: hidden;

        box-shadow:
            0 5px 18px rgba(27, 60, 82, 0.05);

        margin-bottom: 24px;
    }

    .ehs-card-header {
        padding: 19px 22px;

        border-bottom: 1px solid #edf2f5;

        display: flex;

        align-items: center;

        justify-content: space-between;
    }

    .ehs-card-title {
        display: flex;

        align-items: center;

        gap: 9px;

        color: #253043;

        font-size: 14px;

        font-weight: 700;
    }

    .ehs-card-title i {
        color: #0879bd;

        font-size: 17px;
    }

    .ehs-card-description {
        color: #8a94a5;

        font-size: 10px;

        margin-top: 4px;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .ehs-table-wrapper {
        overflow-x: auto;
    }

    .ehs-table {
        width: 100%;

        border-collapse: collapse;
    }

    .ehs-table th {
        background: #f8fbfd;

        color: #7a8699;

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 0.3px;

        padding: 13px 18px;

        border-bottom: 1px solid #edf2f5;

        white-space: nowrap;
    }

    .ehs-table td {
        color: #4e5a6b;

        font-size: 11px;

        padding: 15px 18px;

        border-bottom: 1px solid #f0f3f6;

        vertical-align: middle;
    }

    .ehs-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ehs-table tbody tr:hover {
        background: #fbfdfe;
    }

    .ehs-request-number {
        color: #0879bd;

        font-weight: 700;
    }

    .ehs-requestor {
        color: #253043;

        font-weight: 600;
    }

    .ehs-department {
        color: #6d7889;
    }


    /* =========================================================
       STATUS BADGES
    ========================================================= */

    .ehs-status {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 9px;

        border-radius: 20px;

        font-size: 9px;

        font-weight: 700;

        white-space: nowrap;
    }

    .ehs-status.pending {
        background: #fff7df;

        color: #a66b00;
    }

    .ehs-status.review {
        background: #e9f5fc;

        color: #0879bd;
    }

    .ehs-status.approved {
        background: #e9f8f0;

        color: #208653;
    }

    .ehs-status.rejected {
        background: #fff0f0;

        color: #c43f3f;
    }


    /* =========================================================
       VIEW BUTTON
    ========================================================= */

    .ehs-view-btn {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        padding: 7px 11px;

        border-radius: 8px;

        background: #eaf6fd;

        border: 1px solid #d4edf9;

        color: #0879bd;

        font-size: 10px;

        font-weight: 700;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    .ehs-view-btn:hover {
        background: #0879bd;

        border-color: #0879bd;

        color: #ffffff;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .ehs-empty {
        padding: 45px 20px;

        text-align: center;
    }

    .ehs-empty-icon {
        width: 55px;
        height: 55px;

        display: flex;

        align-items: center;
        justify-content: center;

        margin: 0 auto 14px;

        border-radius: 50%;

        background: #f0f7fb;

        color: #0879bd;

        font-size: 23px;
    }

    .ehs-empty-title {
        color: #4e5a6b;

        font-size: 13px;

        font-weight: 700;

        margin-bottom: 5px;
    }

    .ehs-empty-text {
        color: #929baa;

        font-size: 10px;
    }


    /* =========================================================
       SUMMARY
    ========================================================= */

    .ehs-info-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 20px;

        margin-bottom: 24px;
    }

    .ehs-info-card {
        background: #ffffff;

        border: 1px solid #e7eef3;

        border-radius: 15px;

        padding: 22px;

        box-shadow:
            0 5px 18px rgba(27, 60, 82, 0.05);
    }

    .ehs-info-title {
        display: flex;

        align-items: center;

        gap: 9px;

        color: #253043;

        font-size: 13px;

        font-weight: 700;

        margin-bottom: 16px;
    }

    .ehs-info-title i {
        color: #0879bd;
    }


    /* =========================================================
       PROCESS
    ========================================================= */

    .ehs-process {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 8px;
    }

    .ehs-process-item {
        flex: 1;

        text-align: center;

        position: relative;
    }

    .ehs-process-item:not(:last-child)::after {
        content: "";

        position: absolute;

        top: 20px;

        left: calc(50% + 25px);

        width: calc(100% - 50px);

        height: 1px;

        background: #dceaf1;
    }

    .ehs-process-icon {
        width: 40px;
        height: 40px;

        display: flex;

        align-items: center;
        justify-content: center;

        margin: 0 auto 8px;

        border-radius: 50%;

        background: #eaf6fd;

        color: #0879bd;

        font-size: 16px;

        position: relative;

        z-index: 2;
    }

    .ehs-process-title {
        color: #4e5a6b;

        font-size: 9px;

        font-weight: 700;
    }


    /* =========================================================
       CRITERIA
    ========================================================= */

    .ehs-criteria-list {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 9px;
    }

    .ehs-criteria-item {
        display: flex;

        align-items: center;

        gap: 8px;

        padding: 9px 10px;

        border-radius: 8px;

        background: #f8fbfd;
    }

    .ehs-criteria-item i {
        color: #0879bd;

        font-size: 12px;
    }

    .ehs-criteria-item span {
        color: #626d7e;

        font-size: 10px;

        line-height: 1.4;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .ehs-alert {
        border-radius: 11px;

        font-size: 11px;

        margin-bottom: 20px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 992px) {

        .ehs-stat-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .ehs-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {

        .ehs-welcome-card {
            padding: 22px;
        }

        .ehs-welcome-title {
            font-size: 21px;
        }

        .ehs-stat-grid {
            grid-template-columns: 1fr;
        }

        .ehs-process {
            flex-direction: column;

            align-items: stretch;
        }

        .ehs-process-item:not(:last-child)::after {
            display: none;
        }

        .ehs-criteria-list {
            grid-template-columns: 1fr;
        }
    }

</style>


<div class="ehs-dashboard">

    {{-- =====================================================
         SUCCESS MESSAGE
    ====================================================== --}}

    @if (session('success'))

        <div class="alert alert-success ehs-alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- =====================================================
         ERROR MESSAGE
    ====================================================== --}}

    @if ($errors->any())

        <div class="alert alert-danger ehs-alert">

            <i class="bi bi-exclamation-circle me-1"></i>

            <strong>Please check the following:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         WELCOME
    ====================================================== --}}

    <div class="ehs-welcome-card">

        <div class="ehs-welcome-content">

            <div class="ehs-welcome-label">
                Environmental, Health & Safety
            </div>

            <div class="ehs-welcome-title">
                Welcome, {{ Auth::user()->name }}
            </div>

            <div class="ehs-welcome-description">
                Review, assess, and process User Requirement Specifications
                that require Environmental, Health, and Safety assessment.
            </div>

        </div>

    </div>


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <div class="ehs-stat-grid">

        {{-- Pending --}}

        <div class="ehs-stat-card">

            <div class="ehs-stat-top">

                <div>

                    <div class="ehs-stat-label">
                        Pending Review
                    </div>

                    <div class="ehs-stat-number">
                        {{ $stats['pending'] ?? 0 }}
                    </div>

                </div>

                <div class="ehs-stat-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

            </div>

        </div>


        {{-- In Review --}}

        <div class="ehs-stat-card">

            <div class="ehs-stat-top">

                <div>

                    <div class="ehs-stat-label">
                        In Review
                    </div>

                    <div class="ehs-stat-number">
                        {{ $stats['in_review'] ?? 0 }}
                    </div>

                </div>

                <div class="ehs-stat-icon">
                    <i class="bi bi-search"></i>
                </div>

            </div>

        </div>


        {{-- Approved --}}

        <div class="ehs-stat-card">

            <div class="ehs-stat-top">

                <div>

                    <div class="ehs-stat-label">
                        Approved
                    </div>

                    <div class="ehs-stat-number">
                        {{ $stats['approved'] ?? 0 }}
                    </div>

                </div>

                <div class="ehs-stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

            </div>

        </div>


        {{-- Rejected --}}

        <div class="ehs-stat-card">

            <div class="ehs-stat-top">

                <div>

                    <div class="ehs-stat-label">
                        Rejected
                    </div>

                    <div class="ehs-stat-number">
                        {{ $stats['rejected'] ?? 0 }}
                    </div>

                </div>

                <div class="ehs-stat-icon">
                    <i class="bi bi-x-circle"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         PENDING REQUESTS
    ====================================================== --}}

    <div class="ehs-content-card">

        <div class="ehs-card-header">

            <div>

                <div class="ehs-card-title">

                    <i class="bi bi-inbox"></i>

                    E-URS Requiring EHS Review

                </div>

                <div class="ehs-card-description">
                    Requests waiting for EHS assessment.
                </div>

            </div>

        </div>


        <div class="ehs-table-wrapper">

            @if ($pendingRequests->count() > 0)

                <table class="ehs-table">

                    <thead>

                        <tr>

                            <th>
                                Request Number
                            </th>

                            <th>
                                Requestor
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Requirement
                            </th>

                            <th>
                                Submitted
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($pendingRequests as $eurs)

                            <tr>

                                <td>
                                    <span class="ehs-request-number">
                                        {{ $eurs->request_number }}
                                    </span>
                                </td>


                                <td>
                                    <span class="ehs-requestor">
                                        {{ $eurs->user->name ?? '-' }}
                                    </span>
                                </td>


                                <td>
                                    <span class="ehs-department">
                                        {{ $eurs->department }}
                                    </span>
                                </td>


                                <td>
                                    {{ $eurs->item_service_name
                                        ?? $eurs->requirement
                                        ?? '-' }}
                                </td>


                                <td>
                                    {{ $eurs->submitted_at
                                        ? $eurs->submitted_at->format('d M Y H:i')
                                        : '-' }}
                                </td>


                                <td>

                                    <span class="ehs-status pending">

                                        <i class="bi bi-clock"></i>

                                        Pending

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('ehs.review', ['eurs' => $eurs->id]) }}"
                                        class="ehs-view-btn"
                                    >

                                        <i class="bi bi-eye"></i>

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="ehs-empty">

                    <div class="ehs-empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <div class="ehs-empty-title">
                        No Pending E-URS
                    </div>

                    <div class="ehs-empty-text">
                        There are currently no E-URS requests waiting for EHS review.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         IN REVIEW
    ====================================================== --}}

    <div class="ehs-content-card">

        <div class="ehs-card-header">

            <div>

                <div class="ehs-card-title">

                    <i class="bi bi-clipboard-check"></i>

                    E-URS In Review

                </div>

                <div class="ehs-card-description">
                    Requests currently being assessed by EHS.
                </div>

            </div>

        </div>


        <div class="ehs-table-wrapper">

            @if ($inReviewRequests->count() > 0)

                <table class="ehs-table">

                    <thead>

                        <tr>

                            <th>
                                Request Number
                            </th>

                            <th>
                                Requestor
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Requirement
                            </th>

                            <th>
                                Updated
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($inReviewRequests as $eurs)

                            <tr>

                                <td>

                                    <span class="ehs-request-number">
                                        {{ $eurs->request_number }}
                                    </span>

                                </td>


                                <td>

                                    <span class="ehs-requestor">
                                        {{ $eurs->user->name ?? '-' }}
                                    </span>

                                </td>


                                <td>

                                    <span class="ehs-department">
                                        {{ $eurs->department }}
                                    </span>

                                </td>


                                <td>
                                    {{ $eurs->item_service_name
                                        ?? $eurs->requirement
                                        ?? '-' }}
                                </td>


                                <td>
                                    {{ $eurs->updated_at
                                        ? $eurs->updated_at->format('d M Y H:i')
                                        : '-' }}
                                </td>


                                <td>

                                    <span class="ehs-status review">

                                        <i class="bi bi-search"></i>

                                        In Review

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('ehs.review', ['eurs' => $eurs->id]) }}"
                                        class="ehs-view-btn"
                                    >

                                        <i class="bi bi-pencil-square"></i>

                                        Review

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="ehs-empty">

                    <div class="ehs-empty-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div class="ehs-empty-title">
                        No E-URS In Review
                    </div>

                    <div class="ehs-empty-text">
                        There are currently no E-URS requests being reviewed.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         INFORMATION
    ====================================================== --}}

    <div class="ehs-info-grid">


        {{-- PROCESS --}}

        <div class="ehs-info-card">

            <div class="ehs-info-title">

                <i class="bi bi-diagram-3"></i>

                EHS Process

            </div>


            <div class="ehs-process">

                <div class="ehs-process-item">

                    <div class="ehs-process-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <div class="ehs-process-title">
                        Receive
                    </div>

                </div>


                <div class="ehs-process-item">

                    <div class="ehs-process-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div class="ehs-process-title">
                        Review
                    </div>

                </div>


                <div class="ehs-process-item">

                    <div class="ehs-process-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div class="ehs-process-title">
                        EHS Assessment
                    </div>

                </div>


                <div class="ehs-process-item">

                    <div class="ehs-process-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <div class="ehs-process-title">
                        Decision
                    </div>

                </div>


                <div class="ehs-process-item">

                    <div class="ehs-process-icon">
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>

                    <div class="ehs-process-title">
                        Forward to HoD
                    </div>

                </div>

            </div>

        </div>


        {{-- CRITERIA --}}

        <div class="ehs-info-card">

            <div class="ehs-info-title">

                <i class="bi bi-shield-check"></i>

                EHS Assessment Criteria

            </div>


            <div class="ehs-criteria-list">

                <div class="ehs-criteria-item">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        APD / PPE
                    </span>

                </div>


                <div class="ehs-criteria-item">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        Hazardous / Flammable Materials
                    </span>

                </div>


                <div class="ehs-criteria-item">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        Asbestos Containing Material
                    </span>

                </div>


                <div class="ehs-criteria-item">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        ODS
                    </span>

                </div>


                <div class="ehs-criteria-item">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        Toxic Materials / Pesticides / Sanitation
                    </span>

                </div>


                <div class="ehs-criteria-item">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        Raw Material & New Chemical
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection