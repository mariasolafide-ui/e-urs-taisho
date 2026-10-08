@extends('layouts.app')

@section('title', 'E-URS | My Requests')

@section('page-title', 'My E-URS Requests')

@section(
    'page-description',
    'View and monitor your Electronic User Requirement Specification requests'
)

@section('content')

<style>

/* =====================================================
   PAGE HEADER
===================================================== */

.request-page-header {
    background: linear-gradient(
        120deg,
        #ffffff 0%,
        #edf8ff 65%,
        #e2f5ff 100%
    );

    border: 1px solid #dceef7;
    border-radius: 18px;

    padding: 23px 25px;
    margin-bottom: 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.request-header-left {
    min-width: 0;
}

.request-header-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    background: white;
    border: 1px solid #dcecf4;
    color: #4c94ba;

    border-radius: 50px;

    padding: 5px 10px;

    font-size: 9px;
    font-weight: 800;

    text-transform: uppercase;
    letter-spacing: .5px;

    margin-bottom: 9px;
}

.request-header-title {
    color: #2d4d5e;
    font-size: 21px;
    font-weight: 800;

    margin: 0 0 5px;
}

.request-header-description {
    color: #8196a2;
    font-size: 11px;

    margin: 0;

    line-height: 1.6;
}


/* =====================================================
   NEW REQUEST BUTTON
===================================================== */

.btn-new-request {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    flex-shrink: 0;

    padding: 10px 15px;

    border-radius: 10px;

    background: linear-gradient(
        135deg,
        #65b9ed,
        #3294cb
    );

    color: white;

    text-decoration: none;

    font-size: 11px;
    font-weight: 700;

    border: none;

    box-shadow:
        0 6px 15px
        rgba(50,148,203,.17);

    transition: .2s ease;
}

.btn-new-request:hover {
    color: white;

    transform: translateY(-2px);

    box-shadow:
        0 9px 19px
        rgba(50,148,203,.23);
}


/* =====================================================
   SUMMARY
===================================================== */

.request-toolbar {
    background: white;

    border: 1px solid #e4edf2;

    border-radius: 15px;

    padding: 14px 17px;

    margin-bottom: 15px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;
}

.request-count {
    display: flex;
    align-items: center;
    gap: 9px;
}

.request-count-icon {
    width: 34px;
    height: 34px;

    border-radius: 9px;

    background: #eaf7ff;
    color: #2c91c8;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;
}

.request-count-label {
    color: #8b9da7;

    font-size: 9px;

    margin-bottom: 2px;
}

.request-count-number {
    color: #304d5d;

    font-size: 13px;

    font-weight: 800;
}


/* =====================================================
   TABLE
===================================================== */

.request-table-card {
    background: white;

    border: 1px solid #e3edf2;

    border-radius: 17px;

    overflow: hidden;
}

.request-table-wrapper {
    overflow-x: auto;
    width: 100%;
}

.request-table {
    width: 100%;

    min-width: 900px;

    margin: 0;

    border-collapse: collapse;
}

.request-table thead th {
    background: #f7fbfd;

    color: #78909e;

    font-size: 9px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .4px;

    padding: 13px 15px;

    border-bottom:
        1px solid #e6eef2;

    white-space: nowrap;
}

.request-table tbody td {
    padding: 15px;

    border-bottom:
        1px solid #edf2f5;

    color: #536d7a;

    font-size: 10px;

    vertical-align: middle;
}

.request-table tbody tr:last-child td {
    border-bottom: none;
}

.request-table tbody tr {
    transition: .15s ease;
}

.request-table tbody tr:hover {
    background: #fbfdff;
}


/* =====================================================
   REQUEST NUMBER
===================================================== */

.request-number {
    color: #2e8bc2;

    font-size: 10px;

    font-weight: 800;

    text-decoration: none;
}

.request-number:hover {
    color: #176c9f;
}


/* =====================================================
   ITEM
===================================================== */

.item-name {
    color: #3e5967;

    font-size: 11px;

    font-weight: 700;

    max-width: 220px;

    line-height: 1.4;
}

.department-text {
    color: #8b9ca6;

    font-size: 9px;

    margin-top: 3px;
}


/* =====================================================
   STATUS
===================================================== */

.status-badge {
    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 5px 9px;

    border-radius: 50px;

    font-size: 8px;

    font-weight: 800;

    white-space: nowrap;
}

.status-draft {
    background: #fff7e7;
    color: #bd8321;
}

.status-submitted {
    background: #eaf6ff;
    color: #2a8bc4;
}

.status-pending {
    background: #f1edff;
    color: #7560c2;
}

.status-approved {
    background: #e8f8ef;
    color: #2f9a65;
}

.status-approved-note {
    background: #e9f7f5;
    color: #258579;
}

.status-rejected {
    background: #fff0f0;
    color: #cf6060;
}

.status-processing {
    background: #eaf8f2;
    color: #35966a;
}

.status-completed {
    background: #e8f8ef;
    color: #2f9a65;
}

.status-cancelled {
    background: #f2f4f5;
    color: #7e8b92;
}


/* =====================================================
   ACTION BUTTONS
===================================================== */

.request-actions {
    display: flex;

    align-items: center;

    justify-content: center;

    gap: 6px;
}

.btn-view-request,
.btn-view-pdf {
    width: 31px;
    height: 31px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border-radius: 9px;

    text-decoration: none;

    transition: .18s ease;
}

.btn-view-request {
    background: #f1f8fc;

    border: 1px solid #dcecf4;

    color: #398bb8;
}

.btn-view-request:hover {
    background: #e3f4fc;

    color: #207ba9;

    transform: translateY(-1px);
}

.btn-view-pdf {
    background: #fff5f5;

    border: 1px solid #f3dcdc;

    color: #c65353;
}

.btn-view-pdf:hover {
    background: #ffe8e8;

    color: #ae3e3e;

    transform: translateY(-1px);
}


/* =====================================================
   EMPTY STATE
===================================================== */

.empty-state {
    padding: 65px 25px;

    text-align: center;
}

.empty-icon {
    width: 66px;
    height: 66px;

    border-radius: 18px;

    background: #eaf7ff;

    color: #54a8d3;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 15px;

    font-size: 27px;
}

.empty-title {
    color: #405d6c;

    font-size: 15px;

    font-weight: 800;

    margin-bottom: 6px;
}

.empty-description {
    max-width: 410px;

    margin:
        0 auto 17px;

    color: #91a1aa;

    font-size: 10px;

    line-height: 1.7;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 767px) {

    .request-page-header {
        align-items: flex-start;

        flex-direction: column;

        padding: 20px;
    }

    .btn-new-request {
        width: 100%;
    }

    .request-toolbar {
        align-items: flex-start;

        flex-direction: column;
    }

}

</style>


<!-- =====================================================
     PAGE HEADER
===================================================== -->

<div class="request-page-header">

    <div class="request-header-left">

        <div class="request-header-badge">

            <i class="bi bi-folder2-open"></i>

            Request Management

        </div>

        <h2 class="request-header-title">

            My E-URS Requests

        </h2>

        <p class="request-header-description">

            View, monitor, and access all E-URS requests
            submitted from your account.

        </p>

    </div>


    <a
        href="{{ route('user.eurs.create') }}"
        class="btn-new-request"
    >

        <i class="bi bi-plus-circle"></i>

        Create New E-URS

    </a>

</div>


<!-- =====================================================
     SUMMARY
===================================================== -->

<div class="request-toolbar">

    <div class="request-count">

        <div class="request-count-icon">

            <i class="bi bi-file-earmark-text"></i>

        </div>

        <div>

            <div class="request-count-label">
                Total Requests
            </div>

            <div class="request-count-number">
                {{ $eurs->count() }}
            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     TABLE
===================================================== -->

<div class="request-table-card">

    @if($eurs->count() > 0)

        <div class="request-table-wrapper">

            <table class="request-table">

                <thead>

                    <tr>

                        <th>
                            Request Number
                        </th>

                        <th>
                            Item / Service
                        </th>

                        <th>
                            Department
                        </th>

                        <th>
                            Expected Arrival
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-center">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($eurs as $eursItem)

                        @php

                            $status = $eursItem->status;

                            $statusConfig = match($status) {

                                'draft' => [
                                    'class' => 'status-draft',
                                    'label' => 'Draft',
                                ],

                                'submitted' => [
                                    'class' => 'status-submitted',
                                    'label' => 'Submitted',
                                ],

                                'pending_approval' => [
                                    'class' => 'status-pending',
                                    'label' => 'Pending Approval',
                                ],

                                'approved' => [
                                    'class' => 'status-approved',
                                    'label' => 'Approved',
                                ],

                                'approved_with_note' => [
                                    'class' => 'status-approved-note',
                                    'label' => 'Approved with Note',
                                ],

                                'rejected' => [
                                    'class' => 'status-rejected',
                                    'label' => 'Rejected',
                                ],

                                'pending_procurement' => [
                                    'class' => 'status-processing',
                                    'label' => 'Pending Procurement',
                                ],

                                'processing' => [
                                    'class' => 'status-processing',
                                    'label' => 'Processing',
                                ],

                                'completed' => [
                                    'class' => 'status-completed',
                                    'label' => 'Completed',
                                ],

                                'cancelled' => [
                                    'class' => 'status-cancelled',
                                    'label' => 'Cancelled',
                                ],

                                default => [
                                    'class' => 'status-submitted',
                                    'label' => ucfirst(
                                        str_replace('_', ' ', $status)
                                    ),
                                ],

                            };

                        @endphp


                        <tr>

                            <!-- REQUEST NUMBER -->

                            <td>

                                <a
                                    href="{{ route('user.eurs.pdf', $eursItem->id) }}"
                                    target="_blank"
                                    class="request-number"
                                    title="Open E-URS PDF"
                                >

                                    {{ $eursItem->request_number }}

                                </a>

                            </td>


                            <!-- ITEM -->

                            <td>

                                <div class="item-name">

                                    {{ $eursItem->item_service_name ?: '-' }}

                                </div>

                            </td>


                            <!-- DEPARTMENT -->

                            <td>

                                <div class="department-text">

                                    {{ $eursItem->department ?: '-' }}

                                </div>

                            </td>


                            <!-- DATE -->

                            <td>

                                @if($eursItem->expected_arrival_date)

                                    {{ \Carbon\Carbon::parse(
                                        $eursItem->expected_arrival_date
                                    )->format('d M Y') }}

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            <!-- STATUS -->

                            <td>

                                <span
                                    class="status-badge {{ $statusConfig['class'] }}"
                                >

                                    <i
                                        class="bi bi-circle-fill"
                                        style="font-size:5px;"
                                    ></i>

                                    {{ $statusConfig['label'] }}

                                </span>

                            </td>


                            <!-- ACTION -->

                            <td>

                                <div class="request-actions">

                                    <!-- VIEW DETAIL -->

                                    <a
                                        href="{{ route(
                                            'user.eurs.show',
                                            $eursItem->id
                                        ) }}"
                                        class="btn-view-request"
                                        title="View Request Detail"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    <!-- VIEW PDF -->

                                    <a
                                        href="{{ route(
                                            'user.eurs.pdf',
                                            $eursItem->id
                                        ) }}"
                                        target="_blank"
                                        class="btn-view-pdf"
                                        title="View E-URS PDF"
                                    >

                                        <i class="bi bi-file-earmark-pdf"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <!-- EMPTY STATE -->

        <div class="empty-state">

            <div class="empty-icon">

                <i class="bi bi-folder2-open"></i>

            </div>

            <div class="empty-title">

                No E-URS Requests Yet

            </div>

            <p class="empty-description">

                You have not created any E-URS requests yet.
                Start by creating your first User Specification
                Request.

            </p>

            <a
                href="{{ route('user.eurs.create') }}"
                class="btn-new-request"
            >

                <i class="bi bi-plus-circle"></i>

                Create Your First E-URS

            </a>

        </div>

    @endif

</div>

@endsection