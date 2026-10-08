@extends('layouts.app')

@section('title', 'E-URS | EHS Review')

@section('page-title', 'EHS Review')

@section(
    'page-description',
    'Review and assess User Requirement Specifications requiring EHS assessment'
)

@section('content')

<style>

    /* =========================================================
       EHS REVIEW LIST
    ========================================================= */

    .ehs-review-page {
        width: 100%;
        padding-bottom: 40px;
    }


    /* =========================================================
       HEADER CARD
    ========================================================= */

    .ehs-review-header {
        position: relative;
        overflow: hidden;

        padding: 25px 28px;

        border-radius: 17px;

        background: linear-gradient(
            135deg,
            #0879bd 0%,
            #269bd0 55%,
            #61c4e8 100%
        );

        color: #ffffff;

        margin-bottom: 22px;

        box-shadow:
            0 10px 30px rgba(8, 121, 189, 0.15);
    }

    .ehs-review-header::before {
        content: "";

        position: absolute;

        width: 200px;
        height: 200px;

        right: -70px;
        top: -100px;

        border-radius: 50%;

        background: rgba(255,255,255,0.10);
    }

    .ehs-review-header::after {
        content: "";

        position: absolute;

        width: 130px;
        height: 130px;

        right: 100px;
        bottom: -90px;

        border-radius: 50%;

        background: rgba(255,255,255,0.07);
    }

    .ehs-review-header-content {
        position: relative;

        z-index: 2;
    }

    .ehs-review-header-title {
        font-size: 22px;

        font-weight: 700;

        margin-bottom: 7px;
    }

    .ehs-review-header-text {
        max-width: 700px;

        font-size: 11px;

        line-height: 1.7;

        opacity: 0.9;
    }


    /* =========================================================
       CONTENT CARD
    ========================================================= */

    .ehs-review-card {
        background: #ffffff;

        border: 1px solid #e7eef3;

        border-radius: 15px;

        overflow: hidden;

        box-shadow:
            0 5px 18px rgba(27, 60, 82, 0.05);

        margin-bottom: 22px;
    }

    .ehs-review-card-header {
        padding: 18px 22px;

        border-bottom: 1px solid #edf2f5;

        display: flex;

        align-items: center;

        justify-content: space-between;
    }

    .ehs-review-card-title {
        display: flex;

        align-items: center;

        gap: 9px;

        color: #253043;

        font-size: 14px;

        font-weight: 700;
    }

    .ehs-review-card-title i {
        color: #0879bd;

        font-size: 17px;
    }

    .ehs-review-card-description {
        color: #8a94a5;

        font-size: 10px;

        margin-top: 4px;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .ehs-review-table-wrapper {
        overflow-x: auto;
    }

    .ehs-review-table {
        width: 100%;

        border-collapse: collapse;
    }

    .ehs-review-table th {
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

    .ehs-review-table td {
        color: #4e5a6b;

        font-size: 11px;

        padding: 15px 18px;

        border-bottom: 1px solid #f0f3f6;

        vertical-align: middle;
    }

    .ehs-review-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ehs-review-table tbody tr:hover {
        background: #fbfdfe;
    }


    /* =========================================================
       REQUEST NUMBER
    ========================================================= */

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
       STATUS
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
       ACTION BUTTON
    ========================================================= */

    .ehs-review-btn {
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

    .ehs-review-btn:hover {
        background: #0879bd;

        border-color: #0879bd;

        color: #ffffff;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .ehs-review-empty {
        padding: 45px 20px;

        text-align: center;
    }

    .ehs-review-empty-icon {
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

    .ehs-review-empty-title {
        color: #4e5a6b;

        font-size: 13px;

        font-weight: 700;

        margin-bottom: 5px;
    }

    .ehs-review-empty-text {
        color: #929baa;

        font-size: 10px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .ehs-review-header {
            padding: 22px;
        }

        .ehs-review-header-title {
            font-size: 20px;
        }

        .ehs-review-table th,
        .ehs-review-table td {
            padding: 12px;
        }

    }

</style>


<div class="ehs-review-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="ehs-review-header">

        <div class="ehs-review-header-content">

            <div class="ehs-review-header-title">
                EHS Review
            </div>

            <div class="ehs-review-header-text">
                Review, assess, and process User Requirement Specifications
                that require Environmental, Health, and Safety assessment.
            </div>

        </div>

    </div>


    {{-- =====================================================
         PENDING
    ====================================================== --}}

    <div class="ehs-review-card">

        <div class="ehs-review-card-header">

            <div>

                <div class="ehs-review-card-title">

                    <i class="bi bi-hourglass-split"></i>

                    Pending Review

                </div>

                <div class="ehs-review-card-description">
                    E-URS requests waiting for EHS assessment.
                </div>

            </div>

        </div>


        <div class="ehs-review-table-wrapper">

            @if ($pendingRequests->count() > 0)

                <table class="ehs-review-table">

                    <thead>

                        <tr>

                            <th>Request Number</th>

                            <th>Requestor</th>

                            <th>Department</th>

                            <th>Requirement</th>

                            <th>Submitted</th>

                            <th>Status</th>

                            <th>Action</th>

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
                                        {{ $eurs->department ?? '-' }}
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
                                        class="ehs-review-btn"
                                    >

                                        <i class="bi bi-eye"></i>

                                        Review

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="ehs-review-empty">

                    <div class="ehs-review-empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <div class="ehs-review-empty-title">
                        No Pending E-URS
                    </div>

                    <div class="ehs-review-empty-text">
                        There are currently no E-URS requests waiting for EHS review.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         IN REVIEW
    ====================================================== --}}

    <div class="ehs-review-card">

        <div class="ehs-review-card-header">

            <div>

                <div class="ehs-review-card-title">

                    <i class="bi bi-search"></i>

                    In Review

                </div>

                <div class="ehs-review-card-description">
                    E-URS requests currently being assessed by EHS.
                </div>

            </div>

        </div>


        <div class="ehs-review-table-wrapper">

            @if ($inReviewRequests->count() > 0)

                <table class="ehs-review-table">

                    <thead>

                        <tr>

                            <th>Request Number</th>

                            <th>Requestor</th>

                            <th>Department</th>

                            <th>Requirement</th>

                            <th>Updated</th>

                            <th>Status</th>

                            <th>Action</th>

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
                                        {{ $eurs->department ?? '-' }}
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
                                        class="ehs-review-btn"
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

                <div class="ehs-review-empty">

                    <div class="ehs-review-empty-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div class="ehs-review-empty-title">
                        No E-URS In Review
                    </div>

                    <div class="ehs-review-empty-text">
                        There are currently no E-URS requests being reviewed.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         APPROVED
    ====================================================== --}}

    <div class="ehs-review-card">

        <div class="ehs-review-card-header">

            <div>

                <div class="ehs-review-card-title">

                    <i class="bi bi-check-circle"></i>

                    Approved

                </div>

                <div class="ehs-review-card-description">
                    E-URS requests already approved by EHS.
                </div>

            </div>

        </div>


        <div class="ehs-review-table-wrapper">

            @if ($approvedRequests->count() > 0)

                <table class="ehs-review-table">

                    <thead>

                        <tr>

                            <th>Request Number</th>

                            <th>Requestor</th>

                            <th>Department</th>

                            <th>Requirement</th>

                            <th>Reviewed</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($approvedRequests as $eurs)

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
                                        {{ $eurs->department ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $eurs->item_service_name
                                        ?? $eurs->requirement
                                        ?? '-' }}
                                </td>

                                <td>
                                    {{ $eurs->ehs_reviewed_at
                                        ? $eurs->ehs_reviewed_at->format('d M Y H:i')
                                        : '-' }}
                                </td>

                                <td>

                                    <span class="ehs-status approved">

                                        <i class="bi bi-check-circle"></i>

                                        Approved

                                    </span>

                                </td>

                                <td>

                                    <a
                                        href="{{ route('ehs.review', ['eurs' => $eurs->id]) }}"
                                        class="ehs-review-btn"
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

                <div class="ehs-review-empty">

                    <div class="ehs-review-empty-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <div class="ehs-review-empty-title">
                        No Approved E-URS
                    </div>

                    <div class="ehs-review-empty-text">
                        There are currently no E-URS requests approved by EHS.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         REJECTED
    ====================================================== --}}

    <div class="ehs-review-card">

        <div class="ehs-review-card-header">

            <div>

                <div class="ehs-review-card-title">

                    <i class="bi bi-x-circle"></i>

                    Rejected

                </div>

                <div class="ehs-review-card-description">
                    E-URS requests rejected during EHS assessment.
                </div>

            </div>

        </div>


        <div class="ehs-review-table-wrapper">

            @if ($rejectedRequests->count() > 0)

                <table class="ehs-review-table">

                    <thead>

                        <tr>

                            <th>Request Number</th>

                            <th>Requestor</th>

                            <th>Department</th>

                            <th>Requirement</th>

                            <th>Reviewed</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($rejectedRequests as $eurs)

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
                                        {{ $eurs->department ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $eurs->item_service_name
                                        ?? $eurs->requirement
                                        ?? '-' }}
                                </td>

                                <td>
                                    {{ $eurs->ehs_reviewed_at
                                        ? $eurs->ehs_reviewed_at->format('d M Y H:i')
                                        : '-' }}
                                </td>

                                <td>

                                    <span class="ehs-status rejected">

                                        <i class="bi bi-x-circle"></i>

                                        Rejected

                                    </span>

                                </td>

                                <td>

                                    <a
                                        href="{{ route('ehs.review', ['eurs' => $eurs->id]) }}"
                                        class="ehs-review-btn"
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

                <div class="ehs-review-empty">

                    <div class="ehs-review-empty-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>

                    <div class="ehs-review-empty-title">
                        No Rejected E-URS
                    </div>

                    <div class="ehs-review-empty-text">
                        There are currently no E-URS requests rejected by EHS.
                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection