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
    }


    /* =========================================================
       WELCOME CARD
    ========================================================= */

    .ehs-welcome-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;

        padding: 30px 32px;
        margin-bottom: 24px;

        background: linear-gradient(
            135deg,
            #318fc8 0%,
            #5aaedf 100%
        );

        color: #ffffff;

        box-shadow:
            0 8px 24px rgba(49, 143, 200, 0.15);
    }

    .ehs-welcome-card::after {
        content: "";

        position: absolute;

        width: 220px;
        height: 220px;

        right: -70px;
        top: -100px;

        border-radius: 50%;

        background: rgba(255,255,255,0.08);
    }

    .ehs-welcome-card::before {
        content: "";

        position: absolute;

        width: 150px;
        height: 150px;

        right: 100px;
        bottom: -100px;

        border-radius: 50%;

        background: rgba(255,255,255,0.06);
    }

    .ehs-welcome-content {
        position: relative;
        z-index: 2;
    }

    .ehs-welcome-badge {
        display: inline-flex;

        align-items: center;

        padding: 7px 13px;

        border-radius: 50px;

        background: rgba(255,255,255,0.18);

        border: 1px solid rgba(255,255,255,0.22);

        font-size: 12px;

        font-weight: 600;

        margin-bottom: 14px;
    }

    .ehs-welcome-title {
        font-size: 26px;

        font-weight: 700;

        margin: 0 0 8px 0;

        letter-spacing: -0.3px;
    }

    .ehs-welcome-text {
        max-width: 680px;

        margin: 0;

        font-size: 13px;

        line-height: 1.7;

        color: rgba(255,255,255,0.9);
    }

    .ehs-welcome-action {
        position: relative;

        z-index: 2;
    }

    .ehs-review-button {
        display: inline-flex;

        align-items: center;

        padding: 12px 20px;

        border-radius: 12px;

        background: #ffffff;

        color: #318fc8;

        border: none;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    .ehs-review-button:hover {
        background: #f4fbff;

        color: #287dac;

        transform: translateY(-1px);
    }


    /* =========================================================
       STAT CARDS
    ========================================================= */

    .ehs-stat-card {
        position: relative;

        height: 100%;

        background: #ffffff;

        border: 1px solid #edf1f4;

        border-radius: 17px;

        padding: 20px;

        box-shadow:
            0 4px 14px rgba(20, 60, 90, 0.045);

        transition: all 0.2s ease;
    }

    .ehs-stat-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 8px 22px rgba(20, 60, 90, 0.08);
    }

    .ehs-stat-icon {
        width: 45px;
        height: 45px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 13px;

        background: #eaf7ff;

        color: #318fc8;

        font-size: 20px;

        margin-bottom: 15px;
    }

    .ehs-stat-label {
        color: #718096;

        font-size: 12px;

        font-weight: 500;

        margin-bottom: 3px;
    }

    .ehs-stat-value {
        color: #1f2937;

        font-size: 27px;

        font-weight: 700;

        line-height: 1.2;
    }

    .ehs-stat-description {
        color: #9aa5b1;

        font-size: 10px;

        margin-top: 5px;
    }


    /* =========================================================
       CONTENT CARD
    ========================================================= */

    .ehs-content-card {
        background: #ffffff;

        border: 1px solid #edf1f4;

        border-radius: 17px;

        box-shadow:
            0 4px 14px rgba(20, 60, 90, 0.045);

        overflow: hidden;
    }

    .ehs-content-header {
        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 20px 22px;

        border-bottom: 1px solid #eef2f5;
    }

    .ehs-content-title {
        margin: 0;

        color: #263238;

        font-size: 15px;

        font-weight: 700;
    }

    .ehs-content-subtitle {
        display: block;

        margin-top: 4px;

        color: #8b98a5;

        font-size: 11px;
    }

    .ehs-content-body {
        padding: 22px;
    }


    /* =========================================================
       REQUEST TABLE
    ========================================================= */

    .ehs-table-wrapper {
        overflow-x: auto;
    }

    .ehs-table {
        width: 100%;

        border-collapse: collapse;

        min-width: 760px;
    }

    .ehs-table th {
        background: #f8fbfd;

        color: #718096;

        font-size: 11px;

        font-weight: 700;

        padding: 13px 14px;

        text-align: left;

        border-bottom: 1px solid #edf1f4;
    }

    .ehs-table td {
        padding: 14px;

        color: #4a5568;

        font-size: 11px;

        border-bottom: 1px solid #f0f2f4;

        vertical-align: middle;
    }

    .ehs-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ehs-request-number {
        color: #318fc8;

        font-size: 11.5px;

        font-weight: 700;
    }

    .ehs-requester-name {
        color: #303b44;

        font-weight: 600;

        font-size: 11px;
    }

    .ehs-requester-email {
        color: #98a3ad;

        font-size: 9.5px;

        margin-top: 2px;
    }

    .ehs-request-item {
        color: #4a5568;

        font-size: 11px;

        line-height: 1.5;

        max-width: 180px;
    }

    .ehs-date {
        color: #718096;

        font-size: 10px;

        white-space: nowrap;
    }


    /* =========================================================
       STATUS BADGES
    ========================================================= */

    .ehs-status-badge {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 6px 10px;

        border-radius: 50px;

        font-size: 9.5px;

        font-weight: 600;
    }

    .ehs-status-badge.pending {
        background: #fff7e6;

        color: #d99400;
    }

    .ehs-status-badge.review {
        background: #eaf7ff;

        color: #318fc8;
    }

    .ehs-status-badge.approved {
        background: #e9f9f0;

        color: #29995b;
    }

    .ehs-status-badge.rejected {
        background: #fff0f0;

        color: #d9534f;
    }


    /* =========================================================
       VIEW BUTTON
    ========================================================= */

    .ehs-view-button {
        display: inline-flex;

        align-items: center;

        padding: 7px 14px;

        border-radius: 50px;

        font-size: 10px;

        font-weight: 600;

        color: #318fc8;

        background: #f1f9fd;

        border: 1px solid #dceff8;

        text-decoration: none;

        white-space: nowrap;

        transition: all 0.2s ease;
    }

    .ehs-view-button:hover {
        background: #e7f6fd;

        color: #287dac;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .ehs-empty-state {
        text-align: center;

        padding: 35px 20px;
    }

    .ehs-empty-icon {
        width: 72px;
        height: 72px;

        display: flex;

        align-items: center;

        justify-content: center;

        margin: 0 auto 16px;

        border-radius: 20px;

        background: #eaf7ff;

        color: #318fc8;

        font-size: 29px;
    }

    .ehs-empty-title {
        color: #29343d;

        font-size: 14px;

        font-weight: 700;

        margin-bottom: 6px;
    }

    .ehs-empty-text {
        max-width: 430px;

        margin: 0 auto;

        color: #8a97a4;

        font-size: 11px;

        line-height: 1.6;
    }


    /* =========================================================
       SUMMARY
    ========================================================= */

    .ehs-summary-item {
        display: flex;

        align-items: center;

        justify-content: space-between;

        padding-bottom: 17px;

        margin-bottom: 17px;

        border-bottom: 1px solid #f0f2f4;
    }

    .ehs-summary-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .ehs-summary-left {
        display: flex;
        align-items: center;
    }

    .ehs-summary-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        border-radius: 12px;
        font-size: 17px;
    }

    .ehs-summary-icon.pending {
        background: #fff7e6;
        color: #d99400;
    }

    .ehs-summary-icon.review {
        background: #eaf7ff;
        color: #318fc8;
    }

    .ehs-summary-icon.approved {
        background: #e9f9f0;
        color: #29995b;
    }

    .ehs-summary-icon.rejected {
        background: #fff0f0;
        color: #d9534f;
    }

    .ehs-summary-title {
        font-size: 12px;
        font-weight: 600;
        color: #313b44;
    }

    .ehs-summary-description {
        margin-top: 2px;
        color: #98a3ad;
        font-size: 10px;
    }

    .ehs-summary-value {
        font-size: 16px;
        font-weight: 700;
        color: #29343d;
    }


    /* =========================================================
       PROCESS
    ========================================================= */

    .ehs-process-item {
        position: relative;
        text-align: center;
        height: 100%;
    }

    .ehs-process-icon {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 13px;
        border-radius: 16px;
        background: #eaf7ff;
        color: #318fc8;
        font-size: 21px;
    }

    .ehs-process-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 19px;
        height: 19px;
        margin-bottom: 6px;
        border-radius: 50%;
        background: #318fc8;
        color: #ffffff;
        font-size: 9px;
        font-weight: 700;
    }

    .ehs-process-title {
        margin-bottom: 6px;
        color: #2d3740;
        font-size: 12px;
        font-weight: 700;
    }

    .ehs-process-text {
        margin: 0 auto;
        max-width: 190px;
        color: #8996a2;
        font-size: 10px;
        line-height: 1.6;
    }


    /* =========================================================
       ASSESSMENT CRITERIA
    ========================================================= */

    .ehs-criteria-card {
        height: 100%;
        padding: 17px;
        border-radius: 13px;
        background: #f7fbfd;
        border: 1px solid #e4f1f7;
        transition: all 0.2s ease;
    }

    .ehs-criteria-card:hover {
        background: #f2faff;
        border-color: #d5ebf5;
    }

    .ehs-criteria-icon {
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        border-radius: 11px;
        background: #e5f5fc;
        color: #318fc8;
        font-size: 17px;
        flex-shrink: 0;
    }

    .ehs-criteria-title {
        color: #303b44;
        font-size: 11.5px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .ehs-criteria-text {
        color: #8996a2;
        font-size: 10px;
        line-height: 1.55;
        margin: 0;
    }


    /* =========================================================
       DECISION
    ========================================================= */

    .ehs-decision-box {
        padding: 18px;
        border-radius: 14px;
        background: #f7fbfd;
        border: 1px solid #e4f1f7;
    }

    .ehs-decision-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 13px;
        border-radius: 12px;
        background: #eaf7ff;
        color: #318fc8;
        font-size: 18px;
        flex-shrink: 0;
    }

    .ehs-decision-title {
        font-size: 12px;
        font-weight: 700;
        color: #303b44;
        margin-bottom: 4px;
    }

    .ehs-decision-text {
        color: #8996a2;
        font-size: 10px;
        line-height: 1.6;
        margin: 0;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .ehs-alert {
        border-radius: 12px;
        font-size: 12px;
        margin-bottom: 20px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .ehs-welcome-card {
            padding: 25px;
        }

        .ehs-welcome-title {
            font-size: 23px;
        }

    }


    @media (max-width: 767px) {

        .ehs-welcome-card {
            padding: 22px;
        }

        .ehs-welcome-title {
            font-size: 21px;
        }

        .ehs-content-header {
            align-items: flex-start;
            gap: 10px;
        }

        .ehs-process-item {
            margin-bottom: 10px;
        }

    }

</style>


<div class="ehs-dashboard">


    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if (session('success'))

        <div class="alert alert-success ehs-alert">
            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- WELCOME --}}
    {{-- ========================================================= --}}

    <div class="ehs-welcome-card">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <div class="ehs-welcome-content">

                    <div class="ehs-welcome-badge">

                        <i class="bi bi-shield-check me-2"></i>

                        EHS Reviewer

                    </div>


                    <h2 class="ehs-welcome-title">

                        Welcome, {{ Auth::user()->name }}

                    </h2>


                    <p class="ehs-welcome-text">

                        Review E-URS requests, complete the Environmental,
                        Health, and Safety assessment, and provide an
                        approval or rejection decision with notes.

                    </p>

                </div>

            </div>


            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                <div class="ehs-welcome-action">

                    <a
                        href="#requestQueue"
                        class="ehs-review-button"
                    >

                        <i class="bi bi-shield-check me-2"></i>

                        Review E-URS

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- STATISTICS --}}
    {{-- ========================================================= --}}

    <div class="row g-4 mb-4">


        {{-- PENDING --}}

        <div class="col-xl-3 col-md-6">

            <div class="ehs-stat-card">

                <div class="ehs-stat-icon">

                    <i class="bi bi-inbox"></i>

                </div>


                <div class="ehs-stat-label">

                    Pending Review

                </div>


                <div class="ehs-stat-value">

                    {{ $stats['pending'] ?? 0 }}

                </div>


                <div class="ehs-stat-description">

                    Waiting for EHS assessment

                </div>

            </div>

        </div>


        {{-- IN REVIEW --}}

        <div class="col-xl-3 col-md-6">

            <div class="ehs-stat-card">

                <div class="ehs-stat-icon">

                    <i class="bi bi-search"></i>

                </div>


                <div class="ehs-stat-label">

                    In Review

                </div>


                <div class="ehs-stat-value">

                    {{ $stats['in_review'] ?? 0 }}

                </div>


                <div class="ehs-stat-description">

                    Currently being assessed

                </div>

            </div>

        </div>


        {{-- APPROVED --}}

        <div class="col-xl-3 col-md-6">

            <div class="ehs-stat-card">

                <div class="ehs-stat-icon">

                    <i class="bi bi-check2-circle"></i>

                </div>


                <div class="ehs-stat-label">

                    Approved

                </div>


                <div class="ehs-stat-value">

                    {{ $stats['approved'] ?? 0 }}

                </div>


                <div class="ehs-stat-description">

                    Approved by EHS

                </div>

            </div>

        </div>


        {{-- REJECTED --}}

        <div class="col-xl-3 col-md-6">

            <div class="ehs-stat-card">

                <div class="ehs-stat-icon">

                    <i class="bi bi-x-circle"></i>

                </div>


                <div class="ehs-stat-label">

                    Rejected

                </div>


                <div class="ehs-stat-value">

                    {{ $stats['rejected'] ?? 0 }}

                </div>


                <div class="ehs-stat-description">

                    Returned for revision

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- REQUEST QUEUE + SUMMARY --}}
    {{-- ========================================================= --}}

    <div class="row g-4">


        {{-- ===================================================== --}}
        {{-- REQUEST QUEUE --}}
        {{-- ===================================================== --}}

        <div class="col-lg-8">

            <div
                class="ehs-content-card h-100"
                id="requestQueue"
            >

                <div class="ehs-content-header">

                    <div>

                        <h5 class="ehs-content-title">

                            E-URS Awaiting EHS Review

                        </h5>


                        <span class="ehs-content-subtitle">

                            Requests requiring EHS assessment and decision

                        </span>

                    </div>


                    @if (
                        isset($pendingRequests)
                        &&
                        $pendingRequests->count() > 0
                    )

                        <span
                            class="ehs-status-badge pending"
                        >

                            <i class="bi bi-clock"></i>

                            {{ $pendingRequests->count() }} Pending

                        </span>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- QUEUE CONTENT --}}
                {{-- ================================================= --}}

                @if (
                    isset($pendingRequests)
                    &&
                    $pendingRequests->count() > 0
                )

                    <div class="ehs-table-wrapper">

                        <table class="ehs-table">

                            <thead>

                                <tr>

                                    <th>
                                        Request Number
                                    </th>

                                    <th>
                                        Requester
                                    </th>

                                    <th>
                                        Department
                                    </th>

                                    <th>
                                        Item / Service
                                    </th>

                                    <th>
                                        Submitted
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach (
                                    $pendingRequests
                                    as $eurs
                                )

                                    <tr>

                                        <td>

                                            <div class="ehs-request-number">

                                                {{ $eurs->request_number }}

                                            </div>

                                        </td>


                                        <td>

                                            <div class="ehs-requester-name">

                                                {{ $eurs->user->name ?? '-' }}

                                            </div>


                                            <div class="ehs-requester-email">

                                                {{ $eurs->user->email ?? '-' }}

                                            </div>

                                        </td>


                                        <td>

                                            {{ $eurs->department }}

                                        </td>


                                        <td>

                                            <div class="ehs-request-item">

                                                {{ $eurs->item_service_name }}

                                            </div>

                                        </td>


                                        <td>

                                            <div class="ehs-date">

                                                {{ $eurs->submitted_at
                                                    ? $eurs->submitted_at->format('d M Y H:i')
                                                    : '-'
                                                }}

                                            </div>

                                        </td>


                                        <td>

                                            <a
                                                href="{{ route('ehs.review', $eurs->id) }}"
                                                class="ehs-view-button"
                                            >

                                                <i class="bi bi-eye me-1"></i>

                                                Review

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="ehs-empty-state">

                        <div class="ehs-empty-icon">

                            <i class="bi bi-shield-check"></i>

                        </div>


                        <div class="ehs-empty-title">

                            No E-URS Awaiting EHS Review

                        </div>


                        <p class="ehs-empty-text">

                            There are currently no E-URS requests waiting
                            for Environmental, Health, and Safety assessment.

                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SUMMARY --}}
        {{-- ===================================================== --}}

        <div class="col-lg-4">

            <div class="ehs-content-card h-100">

                <div class="ehs-content-header">

                    <div>

                        <h5 class="ehs-content-title">

                            EHS Review Summary

                        </h5>


                        <span class="ehs-content-subtitle">

                            Current assessment activity

                        </span>

                    </div>

                </div>


                <div class="ehs-content-body">


                    {{-- Pending --}}

                    <div class="ehs-summary-item">

                        <div class="ehs-summary-left">

                            <div class="ehs-summary-icon pending">

                                <i class="bi bi-clock"></i>

                            </div>


                            <div>

                                <div class="ehs-summary-title">

                                    Pending

                                </div>


                                <div class="ehs-summary-description">

                                    Awaiting assessment

                                </div>

                            </div>

                        </div>


                        <div class="ehs-summary-value">

                            {{ $stats['pending'] ?? 0 }}

                        </div>

                    </div>


                    {{-- In Review --}}

                    <div class="ehs-summary-item">

                        <div class="ehs-summary-left">

                            <div class="ehs-summary-icon review">

                                <i class="bi bi-search"></i>

                            </div>


                            <div>

                                <div class="ehs-summary-title">

                                    In Review

                                </div>


                                <div class="ehs-summary-description">

                                    Being assessed

                                </div>

                            </div>

                        </div>


                        <div class="ehs-summary-value">

                            {{ $stats['in_review'] ?? 0 }}

                        </div>

                    </div>


                    {{-- Approved --}}

                    <div class="ehs-summary-item">

                        <div class="ehs-summary-left">

                            <div class="ehs-summary-icon approved">

                                <i class="bi bi-check-circle"></i>

                            </div>


                            <div>

                                <div class="ehs-summary-title">

                                    Approved

                                </div>


                                <div class="ehs-summary-description">

                                    Approved by EHS

                                </div>

                            </div>

                        </div>


                        <div class="ehs-summary-value">

                            {{ $stats['approved'] ?? 0 }}

                        </div>

                    </div>


                    {{-- Rejected --}}

                    <div class="ehs-summary-item">

                        <div class="ehs-summary-left">

                            <div class="ehs-summary-icon rejected">

                                <i class="bi bi-x-circle"></i>

                            </div>


                            <div>

                                <div class="ehs-summary-title">

                                    Rejected

                                </div>


                                <div class="ehs-summary-description">

                                    Returned for revision

                                </div>

                            </div>

                        </div>


                        <div class="ehs-summary-value">

                            {{ $stats['rejected'] ?? 0 }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- IN REVIEW REQUESTS --}}
    {{-- ========================================================= --}}

    @if (
        isset($inReviewRequests)
        &&
        $inReviewRequests->count() > 0
    )

        <div class="ehs-content-card mt-4">

            <div class="ehs-content-header">

                <div>

                    <h5 class="ehs-content-title">

                        E-URS Currently In Review

                    </h5>


                    <span class="ehs-content-subtitle">

                        Requests currently being assessed by EHS

                    </span>

                </div>


                <span class="ehs-status-badge review">

                    <i class="bi bi-search"></i>

                    {{ $inReviewRequests->count() }} In Review  

                </span>

            </div>


            <div class="ehs-table-wrapper">

                <table class="ehs-table">

                    <thead>

                        <tr>

                            <th>
                                Request Number
                            </th>

                            <th>
                                Requester
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Item / Service
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

                        @foreach (
                            $inReviewRequests
                            as $eurs
                        )

                            <tr>

                                <td>

                                    <div class="ehs-request-number">

                                        {{ $eurs->request_number }}

                                    </div>

                                </td>


                                <td>

                                    <div class="ehs-requester-name">

                                        {{ $eurs->user->name ?? '-' }}

                                    </div>


                                    <div class="ehs-requester-email">

                                        {{ $eurs->user->email ?? '-' }}

                                    </div>

                                </td>


                                <td>

                                    {{ $eurs->department }}

                                </td>


                                <td>

                                    <div class="ehs-request-item">

                                        {{ $eurs->item_service_name }}

                                    </div>

                                </td>


                                <td>

                                    <div class="ehs-date">

                                        {{ $eurs->submitted_at
                                            ? $eurs->submitted_at->format('d M Y H:i')
                                            : '-'
                                        }}

                                    </div>

                                </td>


                                <td>

                                    <span class="ehs-status-badge review">

                                        <i class="bi bi-search"></i>

                                        In Review

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('ehs.review', $eurs->id) }}"
                                        class="ehs-view-button"
                                    >

                                        <i class="bi bi-pencil-square me-1"></i>

                                        Continue

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- EHS REVIEW PROCESS --}}
    {{-- ========================================================= --}}

    <div class="ehs-content-card mt-4">

        <div class="ehs-content-header">

            <div>

                <h5 class="ehs-content-title">

                    EHS Review Process

                </h5>


                <span class="ehs-content-subtitle">

                    Workflow for E-URS Environmental, Health, and Safety assessment

                </span>

            </div>

        </div>


        <div class="ehs-content-body">

            <div class="row g-4">


                {{-- STEP 1 --}}

                <div class="col-md">

                    <div class="ehs-process-item">

                        <div class="ehs-process-icon">

                            <i class="bi bi-inbox"></i>

                        </div>


                        <div class="ehs-process-number">

                            1

                        </div>


                        <div class="ehs-process-title">

                            Receive

                        </div>


                        <p class="ehs-process-text">

                            Receive submitted E-URS requests
                            requiring EHS review.

                        </p>

                    </div>

                </div>


                {{-- STEP 2 --}}

                <div class="col-md">

                    <div class="ehs-process-item">

                        <div class="ehs-process-icon">

                            <i class="bi bi-search"></i>

                        </div>


                        <div class="ehs-process-number">

                            2

                        </div>


                        <div class="ehs-process-title">

                            Review

                        </div>


                        <p class="ehs-process-text">

                            Review the requirement, specification,
                            and supporting documents.

                        </p>

                    </div>

                </div>


                {{-- STEP 3 --}}

                <div class="col-md">

                    <div class="ehs-process-item">

                        <div class="ehs-process-icon">

                            <i class="bi bi-shield-check"></i>

                        </div>


                        <div class="ehs-process-number">

                            3

                        </div>


                        <div class="ehs-process-title">

                            EHS Assessment

                        </div>


                        <p class="ehs-process-text">

                            Complete the EHS recommendation
                            and assessment details.

                        </p>

                    </div>

                </div>


                {{-- STEP 4 --}}

                <div class="col-md">

                    <div class="ehs-process-item">

                        <div class="ehs-process-icon">

                            <i class="bi bi-check2-square"></i>

                        </div>


                        <div class="ehs-process-number">

                            4

                        </div>


                        <div class="ehs-process-title">

                            Decision

                        </div>


                        <p class="ehs-process-text">

                            Approve or reject the request
                            and provide notes.

                        </p>

                    </div>

                </div>


                {{-- STEP 5 --}}

                <div class="col-md">

                    <div class="ehs-process-item">

                        <div class="ehs-process-icon">

                            <i class="bi bi-arrow-right-circle"></i>

                        </div>


                        <div class="ehs-process-number">

                            5

                        </div>


                        <div class="ehs-process-title">

                            Forward to HoD

                        </div>


                        <p class="ehs-process-text">

                            Approved E-URS requests proceed
                            to Department Head approval.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- EHS ASSESSMENT CRITERIA --}}
    {{-- ========================================================= --}}

    <div class="ehs-content-card mt-4">

        <div class="ehs-content-header">

            <div>

                <h5 class="ehs-content-title">

                    EHS Assessment Criteria

                </h5>


                <span class="ehs-content-subtitle">

                    Key environmental, health, and safety aspects to review

                </span>

            </div>

        </div>


        <div class="ehs-content-body">

            <div class="row g-3">


                {{-- APD/PPE --}}

                <div class="col-md-6 col-xl-4">

                    <div class="ehs-criteria-card">

                        <div class="d-flex align-items-start">

                            <div class="ehs-criteria-icon">

                                <i class="bi bi-person-badge"></i>

                            </div>


                            <div>

                                <div class="ehs-criteria-title">

                                    APD / PPE

                                </div>


                                <p class="ehs-criteria-text">

                                    Determine whether the requested goods
                                    or activities require personal
                                    protective equipment.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- HAZARDOUS --}}

                <div class="col-md-6 col-xl-4">

                    <div class="ehs-criteria-card">

                        <div class="d-flex align-items-start">

                            <div class="ehs-criteria-icon">

                                <i class="bi bi-exclamation-triangle"></i>

                            </div>


                            <div>

                                <div class="ehs-criteria-title">

                                    Hazardous / Flammable Materials

                                </div>


                                <p class="ehs-criteria-text">

                                    Check materials containing alcohol,
                                    explosives, flammable, or combustible
                                    substances.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ASBESTOS --}}

                <div class="col-md-6 col-xl-4">

                    <div class="ehs-criteria-card">

                        <div class="d-flex align-items-start">

                            <div class="ehs-criteria-icon">

                                <i class="bi bi-shield-exclamation"></i>

                            </div>


                            <div>

                                <div class="ehs-criteria-title">

                                    Asbestos

                                </div>


                                <p class="ehs-criteria-text">

                                    Identify whether the requested
                                    material contains asbestos.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ODS --}}

                <div class="col-md-6 col-xl-4">

                    <div class="ehs-criteria-card">

                        <div class="d-flex align-items-start">

                            <div class="ehs-criteria-icon">

                                <i class="bi bi-cloud-haze2"></i>

                            </div>


                            <div>

                                <div class="ehs-criteria-title">

                                    ODS

                                </div>


                                <p class="ehs-criteria-text">

                                    Review materials associated with
                                    ozone depletion substances.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- TOXIC --}}

                <div class="col-md-6 col-xl-4">

                    <div class="ehs-criteria-card">

                        <div class="d-flex align-items-start">

                            <div class="ehs-criteria-icon">

                                <i class="bi bi-exclamation-diamond"></i>

                            </div>


                            <div>

                                <div class="ehs-criteria-title">

                                    Toxic Materials

                                </div>


                                <p class="ehs-criteria-text">

                                    Consider pesticides, sanitation
                                    materials, and other toxic substances.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- RAW MATERIAL --}}

                <div class="col-md-6 col-xl-4">

                    <div class="ehs-criteria-card">

                        <div class="d-flex align-items-start">

                            <div class="ehs-criteria-icon">

                                <i class="bi bi-flask"></i>

                            </div>


                            <div>

                                <div class="ehs-criteria-title">

                                    Raw Material & New Chemical

                                </div>


                                <p class="ehs-criteria-text">

                                    Review raw materials and new chemicals
                                    and check the required MSDS information.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- APPROVAL & NOTES --}}
    {{-- ========================================================= --}}

    <div class="ehs-content-card mt-4 mb-4">

        <div class="ehs-content-header">

            <div>

                <h5 class="ehs-content-title">

                    EHS Decision

                </h5>


                <span class="ehs-content-subtitle">

                    EHS approval or rejection will determine the next stage

                </span>

            </div>

        </div>


        <div class="ehs-content-body">

            <div class="row g-3">


                {{-- APPROVE --}}

                <div class="col-md-6">

                    <div class="ehs-decision-box">

                        <div class="d-flex align-items-start">

                            <div class="ehs-decision-icon">

                                <i class="bi bi-check2-circle"></i>

                            </div>


                            <div>

                                <div class="ehs-decision-title">

                                    Approve

                                </div>


                                <p class="ehs-decision-text">

                                    When the E-URS satisfies the EHS
                                    assessment requirements, EHS can approve
                                    the request. The request will then
                                    proceed to Department Head approval.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- REJECT --}}

                <div class="col-md-6">

                    <div class="ehs-decision-box">

                        <div class="d-flex align-items-start">

                            <div class="ehs-decision-icon">

                                <i class="bi bi-x-circle"></i>

                            </div>


                            <div>

                                <div class="ehs-decision-title">

                                    Reject

                                </div>


                                <p class="ehs-decision-text">

                                    When additional information or revision
                                    is required, EHS can reject the request
                                    and provide notes explaining the reason
                                    for the required revision.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection