@extends('layouts.app')

@section('title', 'E-URS Request Detail')

@section('page-title', 'E-URS Request Detail')

@section('page-description', 'View User Requirement Specification details')

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | BASIC DATA
    |--------------------------------------------------------------------------
    */

    $status = $eurs->status ?? 'draft';


    /*
    |--------------------------------------------------------------------------
    | STATUS CONFIGURATION
    |--------------------------------------------------------------------------
    */

    $statusLabel = 'Draft';
    $statusClass = 'status-draft';
    $statusIcon = 'bi-file-earmark';

    if ($status === 'submitted') {

        $statusLabel = 'Submitted';
        $statusClass = 'status-submitted';
        $statusIcon = 'bi-send-check';

    } elseif ($status === 'ehs_in_review') {

        $statusLabel = 'EHS Review';
        $statusClass = 'status-review';
        $statusIcon = 'bi-shield-check';

    } elseif ($status === 'pending_approval') {

        $statusLabel = 'Pending Approval';
        $statusClass = 'status-pending';
        $statusIcon = 'bi-person-check';

    } elseif ($status === 'approved') {

        $statusLabel = 'Approved';
        $statusClass = 'status-approved';
        $statusIcon = 'bi-check-circle';

    } elseif ($status === 'approved_with_note') {

        $statusLabel = 'Approved with Note';
        $statusClass = 'status-approved';
        $statusIcon = 'bi-check-circle';

    } elseif ($status === 'rejected') {

        $statusLabel = 'Rejected';
        $statusClass = 'status-rejected';
        $statusIcon = 'bi-x-circle';

    } elseif ($status === 'completed') {

        $statusLabel = 'Completed';
        $statusClass = 'status-completed';
        $statusIcon = 'bi-check2-all';

    }


    /*
    |--------------------------------------------------------------------------
    | EHS
    |--------------------------------------------------------------------------
    */

    $requiresEhs = (bool) ($eurs->requires_ehs ?? false);


    /*
    |--------------------------------------------------------------------------
    | WORKFLOW
    |--------------------------------------------------------------------------
    */

    if ($requiresEhs) {

        $workflowSteps = [

            [
                'key' => 'submitted',
                'label' => 'Submitted',
                'icon' => 'bi-send-check',
            ],

            [
                'key' => 'ehs_in_review',
                'label' => 'EHS Review',
                'icon' => 'bi-shield-check',
            ],

            [
                'key' => 'pending_approval',
                'label' => 'Department Head Approval',
                'icon' => 'bi-person-check',
            ],

            [
                'key' => 'approved',
                'label' => 'Approved',
                'icon' => 'bi-check-circle',
            ],

            [
                'key' => 'completed',
                'label' => 'Completed',
                'icon' => 'bi-check2-all',
            ],

        ];

    } else {

        $workflowSteps = [

            [
                'key' => 'pending_approval',
                'label' => 'Department Head Approval',
                'icon' => 'bi-person-check',
            ],

            [
                'key' => 'approved',
                'label' => 'Approved',
                'icon' => 'bi-check-circle',
            ],

            [
                'key' => 'completed',
                'label' => 'Completed',
                'icon' => 'bi-check2-all',
            ],

        ];

    }


    /*
    |--------------------------------------------------------------------------
    | WORKFLOW CURRENT INDEX
    |--------------------------------------------------------------------------
    */

    $workflowStatus = $status;

    if ($workflowStatus === 'submitted') {

        $currentWorkflowIndex = 0;

    } elseif ($workflowStatus === 'ehs_in_review') {

        $currentWorkflowIndex = 1;

    } elseif ($workflowStatus === 'pending_approval') {

        $currentWorkflowIndex = $requiresEhs ? 2 : 0;

    } elseif (
        $workflowStatus === 'approved' ||
        $workflowStatus === 'approved_with_note'
    ) {

        $currentWorkflowIndex = $requiresEhs ? 3 : 1;

    } elseif ($workflowStatus === 'completed') {

        $currentWorkflowIndex = count($workflowSteps) - 1;

    } elseif ($workflowStatus === 'rejected') {

        $currentWorkflowIndex = 0;

    } else {

        $currentWorkflowIndex = 0;

    }


    /*
    |--------------------------------------------------------------------------
    | BASIC FIELDS
    |--------------------------------------------------------------------------
    */

    $itemName =
        $eurs->item_service_name ??
        $eurs->item_name ??
        '-';


    $brandName =
        $eurs->preferred_brand ??
        $eurs->alternative_brand ??
        '-';


    $deliveryDate =
        $eurs->expected_arrival_date
            ? \Carbon\Carbon::parse(
                $eurs->expected_arrival_date
            )->format('d M Y')
            : '-';


    $submittedDate =
        $eurs->submitted_at
            ? \Carbon\Carbon::parse(
                $eurs->submitted_at
            )->format('d M Y H:i')
            : (
                $eurs->created_at
                    ? \Carbon\Carbon::parse(
                        $eurs->created_at
                    )->format('d M Y H:i')
                    : '-'
            );


    /*
    |--------------------------------------------------------------------------
    | REJECTION
    |--------------------------------------------------------------------------
    */

    $isRejected = $status === 'rejected';


    /*
    |--------------------------------------------------------------------------
    | TECHNICAL REFERENCE
    |--------------------------------------------------------------------------
    */

    $technicalReferencePath =
        $eurs->technical_reference_file ?? null;


    $technicalReferenceUrl = null;

    if (!empty($technicalReferencePath)) {

        $technicalReferenceUrl = route(
            'user.eurs.technical-file',
            $eurs->id
        );

    }


    /*
    |--------------------------------------------------------------------------
    | TECHNICAL REFERENCE EXTENSION
    |--------------------------------------------------------------------------
    */

    $technicalExtension = '';

    if (!empty($technicalReferencePath)) {

        $technicalExtension = strtolower(
            pathinfo(
                $technicalReferencePath,
                PATHINFO_EXTENSION
            )
        );

    }


    $technicalIsImage = in_array(
        $technicalExtension,
        [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp',
        ],
        true
    );


    $technicalIsPdf =
        $technicalExtension === 'pdf';


    /*
    |--------------------------------------------------------------------------
    | FILE URL HELPER
    |--------------------------------------------------------------------------
    */

    $makeFileUrl = function ($path) {

        if (empty($path)) {

            return null;

        }


        if (
            filter_var(
                $path,
                FILTER_VALIDATE_URL
            )
        ) {

            return $path;

        }


        if (
            str_starts_with(
                $path,
                '/storage/'
            )
        ) {

            return asset(
                ltrim(
                    $path,
                    '/'
                )
            );

        }


        if (
            str_starts_with(
                $path,
                'storage/'
            )
        ) {

            return asset($path);

        }


        return \Illuminate\Support\Facades\Storage::disk(
            'public'
        )->url($path);

    };


    /*
    |--------------------------------------------------------------------------
    | ADDITIONAL ATTACHMENTS
    |--------------------------------------------------------------------------
    |
    | Ambil langsung dari tabel e_urs_attachments.
    |
    */

    $attachments = \App\Models\EursAttachment::where(
        'e_urs_id',
        $eurs->id
    )
        ->orderBy('id', 'asc')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | EHS STATUS
    |--------------------------------------------------------------------------
    */

    $ehsStatus =
        $eurs->ehs_status ?? null;


    $ehsStatusLabel =
        'Not Required';


    $ehsStatusClass =
        'status-neutral';


    if ($requiresEhs) {

        if ($ehsStatus === 'pending') {

            $ehsStatusLabel = 'Pending';
            $ehsStatusClass = 'status-pending';

        } elseif ($ehsStatus === 'in_review') {

            $ehsStatusLabel = 'In Review';
            $ehsStatusClass = 'status-review';

        } elseif ($ehsStatus === 'approved') {

            $ehsStatusLabel = 'Approved';
            $ehsStatusClass = 'status-approved';

        } elseif ($ehsStatus === 'rejected') {

            $ehsStatusLabel = 'Rejected';
            $ehsStatusClass = 'status-rejected';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER
    |--------------------------------------------------------------------------
    */

    $supplierRecommendation =
        $eurs->supplier_recommendation ??
        '-';


    $hasSupplierRecommendation =
        $supplierRecommendation ===
        'Punya Rekomendasi';


    /*
    |--------------------------------------------------------------------------
    | PO HANDLED BY
    |--------------------------------------------------------------------------
    */

    $poHandledBy =
        $eurs->po_handled_by ??
        $eurs->po_handler ??
        '-';


    /*
    |--------------------------------------------------------------------------
    | QUANTITY
    |--------------------------------------------------------------------------
    */

    $quantity =
        $eurs->quantity ?? 0;


    $unit =
        $eurs->unit ?? '-';


    /*
    |--------------------------------------------------------------------------
    | CURRENCY
    |--------------------------------------------------------------------------
    */

    $currency =
        $eurs->currency ?? '';


    /*
    |--------------------------------------------------------------------------
    | UNIT PRICE
    |--------------------------------------------------------------------------
    */

    $unitPrice =
        (float) (
            $eurs->unit_price ?? 0
        );


    /*
    |--------------------------------------------------------------------------
    | AMOUNT ACTUAL
    |--------------------------------------------------------------------------
    */

    $amountActual =
        $eurs->amount_actual !== null
            ? (float) $eurs->amount_actual
            : (
                $quantity * $unitPrice
            );


    /*
    |--------------------------------------------------------------------------
    | NUMBER FORMAT
    |--------------------------------------------------------------------------
    */

    $formattedUnitPrice =
        number_format(
            $unitPrice,
            2,
            '.',
            ','
        );


    $formattedAmountActual =
        number_format(
            $amountActual,
            2,
            '.',
            ','
        );


    /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOGS
    |--------------------------------------------------------------------------
    */

    $activityLogs =
        $eurs->activityLogs ?? collect();

@endphp


<style>

    .eurs-page {
        max-width: 1400px;
        margin: 0 auto;
        padding-bottom: 50px;
    }

    .eurs-breadcrumb {
        margin-bottom: 20px;
    }

    .eurs-breadcrumb a {
        text-decoration: none;
        color: #2563eb;
    }

    .eurs-breadcrumb span {
        color: #64748b;
    }

    .request-header {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
    }

    .request-header-title {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .request-number {
        font-size: 14px;
        color: #64748b;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-draft {
        background: #f1f5f9;
        color: #475569;
    }

    .status-submitted {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-review {
        background: #fef3c7;
        color: #92400e;
    }

    .status-pending {
        background: #ede9fe;
        color: #6d28d9;
    }

    .status-approved {
        background: #dcfce7;
        color: #166534;
    }

    .status-rejected {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-completed {
        background: #d1fae5;
        color: #047857;
    }

    .status-neutral {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-main {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 9px;
        font-weight: 600;
    }

    .eurs-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    .eurs-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .eurs-card-title {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
    }

    .eurs-card-subtitle {
        margin-top: 3px;
        font-size: 13px;
        color: #64748b;
    }

    .eurs-card-body {
        padding: 20px;
    }

    .workflow-wrapper {
        padding: 10px 0 5px;
    }

    .workflow {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
    }

    .workflow-line {
        position: absolute;
        top: 20px;
        left: 8%;
        right: 8%;
        height: 3px;
        background: #e2e8f0;
        z-index: 0;
    }

    .workflow-item {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .workflow-icon {
        width: 42px;
        height: 42px;
        margin: 0 auto 9px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        border: 3px solid #ffffff;
        box-shadow: 0 0 0 1px #e2e8f0;
    }

    .workflow-item.active .workflow-icon {
        background: #2563eb;
        color: #ffffff;
        box-shadow: 0 0 0 1px #2563eb;
    }

    .workflow-item.completed .workflow-icon {
        background: #16a34a;
        color: #ffffff;
        box-shadow: 0 0 0 1px #16a34a;
    }

    .workflow-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
    }

    .workflow-item.active .workflow-label,
    .workflow-item.completed .workflow-label {
        color: #0f172a;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 25px;
    }

    .info-item {
        min-width: 0;
    }

    .info-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 14px;
        color: #0f172a;
        font-weight: 500;
        word-break: break-word;
    }

    .info-value-muted {
        color: #64748b;
    }

    .requirement-table {
        width: 100%;
        border-collapse: collapse;
    }

    .requirement-table th {
        width: 30%;
        background: #f8fafc;
        color: #475569;
        font-size: 13px;
        font-weight: 600;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        vertical-align: top;
    }

    .requirement-table td {
        color: #0f172a;
        font-size: 14px;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        vertical-align: top;
        word-break: break-word;
    }

    .price-value {
        font-weight: 700;
        color: #0f172a;
    }

    .pdf-container {
        width: 100%;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .pdf-viewer {
        display: block;
        width: 100%;
        height: 900px;
        border: 0;
        background: #f8fafc;
    }

    .image-preview-container {
        width: 100%;
        min-height: 250px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-preview {
        display: block;
        max-width: 100%;
        max-height: 850px;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
    }

    .attachment-preview {
        width: 100%;
        margin-top: 15px;
    }

    .attachment-preview .pdf-container {
        margin-top: 0;
    }

    .attachment-preview .pdf-viewer {
        height: 650px;
    }

    .attachment-preview .image-preview-container {
        min-height: 200px;
        max-height: 700px;
        overflow: auto;
    }

    .attachment-preview .image-preview {
        max-height: 650px;
    }

    .pdf-empty {
        padding: 45px 20px;
        text-align: center;
        color: #64748b;
    }

    .pdf-empty i {
        font-size: 42px;
        color: #94a3b8;
        display: block;
        margin-bottom: 12px;
    }

    .attachment-item {
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .attachment-item:first-child {
        padding-top: 0;
    }

    .attachment-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .attachment-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .attachment-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        flex: 1;
    }

    .attachment-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        flex-shrink: 0;
        font-size: 18px;
    }

    .attachment-name {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
        word-break: break-word;
    }

    .attachment-path {
        font-size: 12px;
        color: #94a3b8;
        word-break: break-all;
        margin-top: 3px;
    }

    .alert-soft {
        border-radius: 12px;
        border: 1px solid;
        padding: 14px 16px;
        margin-bottom: 20px;
    }

    .alert-success-soft {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .alert-danger-soft {
        background: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .alert-warning-soft {
        background: #fffbeb;
        border-color: #fde68a;
        color: #92400e;
    }

    .sticky-sidebar {
        position: sticky;
        top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .summary-row:last-child {
        border-bottom: 0;
    }

    .summary-label {
        color: #64748b;
        font-size: 13px;
    }

    .summary-value {
        color: #0f172a;
        font-size: 13px;
        font-weight: 600;
        text-align: right;
        word-break: break-word;
    }

    .ehs-box {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        background: #f8fafc;
    }

    .ehs-notes {
        white-space: pre-line;
        font-size: 13px;
        line-height: 1.6;
        color: #334155;
    }

    .activity-item {
        position: relative;
        padding-left: 30px;
        padding-bottom: 22px;
    }

    .activity-item:last-child {
        padding-bottom: 0;
    }

    .activity-item::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 4px;
        bottom: -2px;
        width: 1px;
        background: #e2e8f0;
    }

    .activity-item:last-child::before {
        display: none;
    }

    .activity-dot {
        position: absolute;
        left: 3px;
        top: 2px;
        width: 11px;
        height: 11px;
        background: #2563eb;
        border-radius: 50%;
        box-shadow: 0 0 0 4px #dbeafe;
    }

    .activity-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .activity-description {
        margin-top: 3px;
        font-size: 13px;
        color: #64748b;
    }

    .activity-date {
        margin-top: 5px;
        font-size: 11px;
        color: #94a3b8;
    }

    @media (max-width: 991px) {

        .sticky-sidebar {
            position: static;
        }

        .workflow-label {
            font-size: 10px;
        }

        .workflow-icon {
            width: 38px;
            height: 38px;
        }

        .workflow-line {
            top: 18px;
        }

    }

    @media (max-width: 767px) {

        .info-grid {
            grid-template-columns: 1fr;
        }

        .request-header {
            padding: 18px;
        }

        .request-header-title {
            font-size: 20px;
        }

        .workflow {
            overflow-x: auto;
            justify-content: flex-start;
            min-width: 600px;
        }

        .workflow-wrapper {
            overflow-x: auto;
        }

        .workflow-item {
            min-width: 120px;
        }

        .workflow-line {
            left: 60px;
            right: 60px;
        }

        .pdf-viewer {
            height: 650px;
        }

        .attachment-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .attachment-preview .pdf-viewer {
            height: 500px;
        }

    }

</style>


<div class="eurs-page">


    {{-- ============================================================
         BREADCRUMB
    ============================================================= --}}

    <div class="eurs-breadcrumb">

        <a href="{{ route('user.eurs.index') }}">

            <i class="bi bi-file-earmark-text me-1"></i>

            My E-URS

        </a>

        <span class="mx-2">/</span>

        <span>
            Request Detail
        </span>

    </div>


    {{-- ============================================================
         SUCCESS MESSAGE
    ============================================================= --}}

    @if(session('success'))

        <div class="alert-soft alert-success-soft">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ============================================================
         ERROR MESSAGE
    ============================================================= --}}

    @if($errors->any())

        <div class="alert-soft alert-danger-soft">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                Please check the following:

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="request-header">

        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">

            <div>

                <div class="request-header-title">
                    {{ $itemName }}
                </div>

                <div class="request-number">

                    Request Number:

                    <strong>
                        {{ $eurs->request_number ?? '-' }}
                    </strong>

                </div>

                <div class="mt-2 text-muted small">

                    Submitted:
                    {{ $submittedDate }}

                </div>

            </div>


            <div class="d-flex flex-wrap align-items-center gap-2">

                <span class="status-badge {{ $statusClass }}">

                    <i class="bi {{ $statusIcon }}"></i>

                    {{ $statusLabel }}

                </span>


                <a
                    href="{{ route('user.eurs.pdf', $eurs->id) }}"
                    target="_blank"
                    class="btn btn-primary btn-sm btn-main"
                >

                    <i class="bi bi-file-earmark-pdf"></i>

                    View E-URS PDF

                </a>


                @if($isRejected)

                    <a
                        href="{{ route('user.eurs.edit', $eurs->id) }}"
                        class="btn btn-outline-danger btn-sm btn-main"
                    >

                        <i class="bi bi-pencil-square"></i>

                        Revise E-URS

                    </a>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
         REJECTION ALERT
    ============================================================= --}}

    @if($isRejected)

        <div class="alert-soft alert-danger-soft">

            <div class="fw-bold mb-1">

                <i class="bi bi-x-circle-fill me-2"></i>

                E-URS Rejected

            </div>

            <div>

                This E-URS has been rejected and returned for revision.

                @if(!empty($eurs->ehs_notes))

                    <div class="mt-2">

                        <strong>Review Notes:</strong>

                        <div class="mt-1">

                            {!! nl2br(e($eurs->ehs_notes)) !!}

                        </div>

                    </div>

                @endif

            </div>

        </div>

    @endif


    {{-- ============================================================
         WORKFLOW
    ============================================================= --}}

    <div class="eurs-card">

        <div class="eurs-card-header">

            <h5 class="eurs-card-title">

                <i class="bi bi-diagram-3 me-2 text-primary"></i>

                Request Workflow

            </h5>

            <div class="eurs-card-subtitle">

                Current stage:

                <strong>
                    {{ $eurs->current_stage ?? $statusLabel }}
                </strong>

            </div>

        </div>

        <div class="eurs-card-body">

            <div class="workflow-wrapper">

                <div class="workflow">

                    <div class="workflow-line"></div>

                    @foreach($workflowSteps as $index => $step)

                        @php

                            $isCompleted =
                                $index <
                                $currentWorkflowIndex;

                            $isActive =
                                $index ===
                                $currentWorkflowIndex;

                        @endphp

                        <div
                            class="
                                workflow-item
                                {{ $isCompleted ? 'completed' : '' }}
                                {{ $isActive ? 'active' : '' }}
                            "
                        >

                            <div class="workflow-icon">

                                <i class="bi {{ $step['icon'] }}"></i>

                            </div>

                            <div class="workflow-label">

                                {{ $step['label'] }}

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
         MAIN GRID
    ============================================================= --}}

    <div class="row g-4">

        <div class="col-lg-8">


            {{-- ====================================================
                 GENERAL INFORMATION
            ===================================================== --}}

            <div class="eurs-card">

                <div class="eurs-card-header">

                    <h5 class="eurs-card-title">

                        <i class="bi bi-info-circle me-2 text-primary"></i>

                        General Information

                    </h5>

                </div>

                <div class="eurs-card-body">

                    <div class="info-grid">

                        <div class="info-item">

                            <span class="info-label">
                                Request Number
                            </span>

                            <div class="info-value">
                                {{ $eurs->request_number ?? '-' }}
                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Department
                            </span>

                            <div class="info-value">
                                {{ $eurs->department ?? '-' }}
                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Requestor
                            </span>

                            <div class="info-value">
                                {{ optional($eurs->user)->name ?? '-' }}
                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Requestor Email
                            </span>

                            <div class="info-value">
                                {{ optional($eurs->user)->email ?? '-' }}
                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Requires EHS
                            </span>

                            <div class="info-value">

                                @if($requiresEhs)

                                    <span class="status-badge status-review">

                                        <i class="bi bi-shield-check"></i>

                                        Yes

                                    </span>

                                @else

                                    <span class="status-badge status-neutral">

                                        <i class="bi bi-dash-circle"></i>

                                        No

                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Amount Category
                            </span>

                            <div class="info-value">

                                @if(($eurs->amount_category ?? '') === 'above_50m')

                                    Above 50 Million

                                @elseif(($eurs->amount_category ?? '') === 'below_50m')

                                    Below 50 Million

                                @else

                                    -

                                @endif

                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                PO Handled By
                            </span>

                            <div class="info-value">
                                {{ $poHandledBy }}
                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Submitted At
                            </span>

                            <div class="info-value">
                                {{ $submittedDate }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 REQUIREMENT DETAILS
            ===================================================== --}}

            <div class="eurs-card">

                <div class="eurs-card-header">

                    <h5 class="eurs-card-title">

                        <i class="bi bi-list-check me-2 text-primary"></i>

                        Requirement Details

                    </h5>

                </div>

                <div class="eurs-card-body p-0">

                    <div class="table-responsive">

                        <table class="requirement-table">

                            <tbody>

                                <tr>

                                    <th>
                                        Requirement / Item / Service
                                    </th>

                                    <td>
                                        {{ $itemName }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Estimate Quantity
                                    </th>

                                    <td>

                                        {{ number_format(
                                            $quantity,
                                            0,
                                            '.',
                                            ','
                                        ) }}

                                        {{ $unit }}

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Currency
                                    </th>

                                    <td>
                                        {{ $currency ?: '-' }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Unit Price
                                    </th>

                                    <td>

                                        @if($unitPrice > 0)

                                            <span class="price-value">

                                                {{ $currency }}

                                                {{ $formattedUnitPrice }}

                                            </span>

                                        @else

                                            -

                                        @endif

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Amount Actual
                                    </th>

                                    <td>

                                        @if($amountActual > 0)

                                            <span class="price-value">

                                                {{ $currency }}

                                                {{ $formattedAmountActual }}

                                            </span>

                                        @else

                                            -

                                        @endif

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Expected Date of Delivery
                                    </th>

                                    <td>
                                        {{ $deliveryDate }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Brand
                                    </th>

                                    <td>

                                        @if(
                                            !empty($eurs->preferred_brand) ||
                                            !empty($eurs->alternative_brand)
                                        )

                                            @if(!empty($eurs->preferred_brand))

                                                <div>

                                                    <strong>
                                                        Preferred:
                                                    </strong>

                                                    {{ $eurs->preferred_brand }}

                                                </div>

                                            @endif


                                            @if(!empty($eurs->alternative_brand))

                                                <div class="mt-1">

                                                    <strong>
                                                        Alternative:
                                                    </strong>

                                                    {{ $eurs->alternative_brand }}

                                                </div>

                                            @endif

                                        @else

                                            -

                                        @endif

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Special Requirements
                                    </th>

                                    <td>

                                        @if(!empty($eurs->special_requirements))

                                            {!! nl2br(
                                                e(
                                                    $eurs->special_requirements
                                                )
                                            ) !!}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Detail Specification
                                    </th>

                                    <td>

                                        @if(!empty($eurs->technical_description))

                                            {!! nl2br(
                                                e(
                                                    $eurs->technical_description
                                                )
                                            ) !!}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 TECHNICAL REFERENCE
            ===================================================== --}}

            <div class="eurs-card">

                <div class="eurs-card-header">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                        <div>

                            <h5 class="eurs-card-title">

                                <i class="
                                    bi
                                    {{ $technicalIsImage
                                        ? 'bi-file-earmark-image text-success'
                                        : 'bi-file-earmark-pdf text-danger'
                                    }}
                                    me-2
                                "></i>

                                Technical Reference

                            </h5>

                            <div class="eurs-card-subtitle">

                                Uploaded technical reference file

                            </div>

                        </div>


                        @if(!empty($technicalReferenceUrl))

                            <a
                                href="{{ $technicalReferenceUrl }}"
                                target="_blank"
                                class="btn btn-outline-primary btn-sm btn-main"
                            >

                                <i class="bi bi-box-arrow-up-right"></i>

                                Open File

                            </a>

                        @endif

                    </div>

                </div>


                <div class="eurs-card-body">

                    @if(!empty($technicalReferenceUrl))

                        @if($technicalIsPdf)

                            <div class="pdf-container">

                                <iframe
                                    src="{{ $technicalReferenceUrl }}#toolbar=1&navpanes=1&scrollbar=1"
                                    class="pdf-viewer"
                                    title="Technical Reference PDF"
                                ></iframe>

                            </div>


                        @elseif($technicalIsImage)

                            <div class="image-preview-container">

                                <img
                                    src="{{ $technicalReferenceUrl }}"
                                    alt="Technical Reference"
                                    class="image-preview"
                                >

                            </div>


                        @else

                            <div class="pdf-empty">

                                <i class="bi bi-file-earmark"></i>

                                <div class="fw-semibold">
                                    File uploaded successfully.
                                </div>

                                <div class="small mt-1">
                                    This file type cannot be previewed directly.
                                </div>

                                <div class="mt-3">

                                    <a
                                        href="{{ $technicalReferenceUrl }}"
                                        target="_blank"
                                        class="btn btn-primary btn-sm btn-main"
                                    >

                                        <i class="bi bi-download"></i>

                                        Open File

                                    </a>

                                </div>

                            </div>

                        @endif

                    @else

                        <div class="pdf-empty">

                            <i class="bi bi-file-earmark-x"></i>

                            <div class="fw-semibold">

                                No technical reference file uploaded.

                            </div>

                            <div class="small mt-1">

                                The requestor did not attach a technical reference document.

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                 SUPPLIER INFORMATION
            ===================================================== --}}

            <div class="eurs-card">

                <div class="eurs-card-header">

                    <h5 class="eurs-card-title">

                        <i class="bi bi-building me-2 text-primary"></i>

                        Supplier Information

                    </h5>

                </div>

                <div class="eurs-card-body">

                    <div class="info-grid">

                        <div class="info-item">

                            <span class="info-label">
                                Supplier Recommendation
                            </span>

                            <div class="info-value">
                                {{ $supplierRecommendation }}
                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Reference Supplier
                            </span>

                            <div class="info-value">

                                @if($hasSupplierRecommendation)

                                    {{ $eurs->reference_supplier ?? '-' }}

                                @else

                                    <span class="info-value-muted">
                                        No supplier recommendation
                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Contact Person
                            </span>

                            <div class="info-value">

                                @if($hasSupplierRecommendation)

                                    {{ $eurs->supplier_contact_person ?? '-' }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Supplier Contact
                            </span>

                            <div class="info-value">

                                @if($hasSupplierRecommendation)

                                    {{ $eurs->supplier_contact ?? '-' }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>


                        <div class="info-item">

                            <span class="info-label">
                                Procurement SLA Date
                            </span>

                            <div class="info-value">

                                @if(!empty($eurs->procurement_sla_date))

                                    {{ \Carbon\Carbon::parse(
                                        $eurs->procurement_sla_date
                                    )->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 CAPEX INFORMATION
            ===================================================== --}}

            @if(($eurs->department ?? '') === 'CAPEX Project')

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-diagram-3 me-2 text-primary"></i>

                            CAPEX Information

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        <div class="info-grid">

                            <div class="info-item">

                                <span class="info-label">
                                    CAPEX Budget Number
                                </span>

                                <div class="info-value">
                                    {{ $eurs->capex_budget_number ?? '-' }}
                                </div>

                            </div>


                            <div class="info-item">

                                <span class="info-label">
                                    CAPEX Layout / Design
                                </span>

                                <div class="info-value">

                                    @if(!empty($eurs->capex_layout_file))

                                        @php

                                            $capexUrl =
                                                $makeFileUrl(
                                                    $eurs->capex_layout_file
                                                );

                                        @endphp

                                        <a
                                            href="{{ $capexUrl }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary"
                                        >

                                            <i class="bi bi-paperclip me-1"></i>

                                            Open File

                                        </a>

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                 IT INFORMATION
            ===================================================== --}}

            @if(($eurs->department ?? '') === 'IT')

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-pc-display me-2 text-primary"></i>

                            IT Requirements

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        <div class="info-grid">

                            <div class="info-item">

                                <span class="info-label">
                                    RAM
                                </span>

                                <div class="info-value">
                                    {{ $eurs->it_ram ?? '-' }}
                                </div>

                            </div>


                            <div class="info-item">

                                <span class="info-label">
                                    Internal Memory
                                </span>

                                <div class="info-value">
                                    {{ $eurs->it_internal_memory ?? '-' }}
                                </div>

                            </div>


                            <div class="info-item">

                                <span class="info-label">
                                    Connectivity
                                </span>

                                <div class="info-value">
                                    {{ $eurs->it_connectivity ?? '-' }}
                                </div>

                            </div>


                            <div class="info-item">

                                <span class="info-label">
                                    Operating System
                                </span>

                                <div class="info-value">
                                    {{ $eurs->it_os ?? '-' }}
                                </div>

                            </div>

                        </div>


                        @if(!empty($eurs->it_recommendation_details))

                            <div class="mt-4">

                                <span class="info-label">
                                    IT Recommendation Details
                                </span>

                                <div class="info-value">

                                    {!! nl2br(
                                        e(
                                            $eurs->it_recommendation_details
                                        )
                                    ) !!}

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            @endif


            {{-- ====================================================
                 EHS REVIEW
            ===================================================== --}}

            @if($requiresEhs)

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <div class="d-flex justify-content-between align-items-center gap-2">

                            <div>

                                <h5 class="eurs-card-title">

                                    <i class="bi bi-shield-check me-2 text-primary"></i>

                                    EHS Review

                                </h5>

                                <div class="eurs-card-subtitle">

                                    Environmental, Health and Safety assessment

                                </div>

                            </div>


                            <span class="status-badge {{ $ehsStatusClass }}">

                                {{ $ehsStatusLabel }}

                            </span>

                        </div>

                    </div>

                    <div class="eurs-card-body">

                        <div class="ehs-box">

                            @if(!empty($eurs->ehs_notes))

                                <div class="ehs-notes">

                                    {!! nl2br(e($eurs->ehs_notes)) !!}

                                </div>

                            @else

                                <div class="text-muted small">

                                    EHS assessment has not been completed yet.

                                </div>

                            @endif

                        </div>


                        @if(!empty($eurs->ehs_reviewed_at))

                            <div class="small text-muted mt-3">

                                Reviewed at:

                                {{ \Carbon\Carbon::parse(
                                    $eurs->ehs_reviewed_at
                                )->format('d M Y H:i') }}

                            </div>

                        @endif


                        @if(!empty($eurs->ehs_attachment))

                            @php

                                $ehsAttachmentUrl =
                                    $makeFileUrl(
                                        $eurs->ehs_attachment
                                    );

                            @endphp

                            <div class="mt-3">

                                <a
                                    href="{{ $ehsAttachmentUrl }}"
                                    target="_blank"
                                    class="btn btn-outline-primary btn-sm btn-main"
                                >

                                    <i class="bi bi-paperclip"></i>

                                    View EHS Attachment

                                </a>

                            </div>

                        @endif

                    </div>

                </div>

            @endif


            {{-- ====================================================
                 ADDITIONAL ATTACHMENTS
            ===================================================== --}}

            <div class="eurs-card">

                <div class="eurs-card-header">

                    <h5 class="eurs-card-title">

                        <i class="bi bi-paperclip me-2 text-primary"></i>

                        Additional Attachments

                    </h5>

                    <div class="eurs-card-subtitle">

                        Additional technical documents or supporting files

                    </div>

                </div>


                <div class="eurs-card-body">

                    @if($attachments->isNotEmpty())

                        @foreach($attachments as $attachment)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | FILE PATH
                                |--------------------------------------------------------------------------
                                */

                                $attachmentPath =
                                    $attachment->file_path ?? null;


                                /*
                                |--------------------------------------------------------------------------
                                | FILE NAME
                                |--------------------------------------------------------------------------
                                */

                                $attachmentName =
                                    $attachment->file_name
                                    ?: (
                                        !empty($attachmentPath)
                                            ? basename($attachmentPath)
                                            : 'Attachment'
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | EXTENSION
                                |--------------------------------------------------------------------------
                                */

                                $attachmentExtension = strtolower(
                                    pathinfo(
                                        $attachmentPath
                                            ?: $attachmentName,
                                        PATHINFO_EXTENSION
                                    )
                                );


                                /*
                                |--------------------------------------------------------------------------
                                | URL
                                |--------------------------------------------------------------------------
                                */

                                $attachmentUrl = null;

                                if (!empty($attachmentPath)) {

                                    $attachmentUrl = route(
                                        'user.eurs.attachment-file',
                                        [
                                            'eurs' => $eurs->id,
                                            'attachment' => $attachment->id,
                                        ]
                                    );

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | PREVIEW TYPE
                                |--------------------------------------------------------------------------
                                */

                                $attachmentIsPdf =
                                    $attachmentExtension === 'pdf';


                                $attachmentIsImage =
                                    in_array(
                                        $attachmentExtension,
                                        [
                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'webp',
                                        ],
                                        true
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | FILE SIZE
                                |--------------------------------------------------------------------------
                                */

                                $attachmentSize = '';

                                if (!empty($attachment->file_size)) {

                                    $size =
                                        (int) $attachment->file_size;


                                    if (
                                        $size >=
                                        1024 * 1024
                                    ) {

                                        $attachmentSize =
                                            number_format(
                                                $size /
                                                (1024 * 1024),
                                                2
                                            ) .
                                            ' MB';

                                    } else {

                                        $attachmentSize =
                                            number_format(
                                                $size / 1024,
                                                1
                                            ) .
                                            ' KB';

                                    }

                                }

                            @endphp


                            <div class="attachment-item">


                                {{-- ==================================================
                                     ATTACHMENT HEADER
                                =================================================== --}}

                                <div class="attachment-header">


                                    <div class="attachment-left">


                                        <div class="attachment-icon">

                                            @if($attachmentIsPdf)

                                                <i class="bi bi-file-earmark-pdf"></i>

                                            @elseif($attachmentIsImage)

                                                <i class="bi bi-file-earmark-image"></i>

                                            @else

                                                <i class="bi bi-file-earmark"></i>

                                            @endif

                                        </div>


                                        <div style="min-width: 0;">

                                            <div class="attachment-name">

                                                {{ $attachmentName }}

                                            </div>


                                            <div class="attachment-path">

                                                @if(!empty($attachment->file_type))

                                                    {{ strtoupper(
                                                        $attachment->file_type
                                                    ) }}

                                                @elseif(!empty($attachmentExtension))

                                                    {{ strtoupper(
                                                        $attachmentExtension
                                                    ) }}

                                                @else

                                                    File

                                                @endif


                                                @if(!empty($attachmentSize))

                                                    <span class="mx-1">
                                                        ·
                                                    </span>

                                                    {{ $attachmentSize }}

                                                @endif

                                            </div>


                                            @if(!empty($attachment->attachment_type))

                                                <div class="mt-1">

                                                    <span class="badge bg-light text-secondary border">

                                                        {{ ucfirst(
                                                            str_replace(
                                                                '_',
                                                                ' ',
                                                                $attachment->attachment_type
                                                            )
                                                        ) }}

                                                    </span>

                                                </div>

                                            @endif

                                        </div>

                                    </div>


                                    @if($attachmentUrl)

                                        <a
                                            href="{{ $attachmentUrl }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary"
                                        >

                                            <i class="bi bi-box-arrow-up-right me-1"></i>

                                            Open

                                        </a>

                                    @endif

                                </div>


                                {{-- ==================================================
                                     ATTACHMENT PREVIEW
                                =================================================== --}}

                                @if($attachmentUrl)

                                    <div class="attachment-preview">


                                        @if($attachmentIsPdf)

                                            <div class="pdf-container">

                                                <iframe
                                                    src="{{ $attachmentUrl }}#toolbar=1&navpanes=1&scrollbar=1"
                                                    class="pdf-viewer"
                                                    title="{{ $attachmentName }}"
                                                ></iframe>

                                            </div>


                                        @elseif($attachmentIsImage)

                                            <div class="image-preview-container">

                                                <img
                                                    src="{{ $attachmentUrl }}"
                                                    alt="{{ $attachmentName }}"
                                                    class="image-preview"
                                                >

                                            </div>


                                        @else

                                            <div class="alert-soft alert-warning-soft mb-0">

                                                <i class="bi bi-info-circle me-2"></i>

                                                This file type cannot be previewed directly.

                                                <a
                                                    href="{{ $attachmentUrl }}"
                                                    target="_blank"
                                                    class="fw-semibold"
                                                >
                                                    Open file
                                                </a>

                                            </div>

                                        @endif

                                    </div>

                                @endif

                            </div>

                        @endforeach

                    @else

                        <div class="text-center py-5 text-muted">

                            <i class="bi bi-paperclip fs-1 d-block mb-3 text-secondary"></i>

                            <div class="fw-semibold">

                                No additional attachments.

                            </div>

                            <div class="small mt-1">

                                No additional technical documents or supporting
                                files have been uploaded for this E-URS.

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                 ACTIVITY LOG
            ===================================================== --}}

            @if($activityLogs->count() > 0)

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-clock-history me-2 text-primary"></i>

                            Activity History

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        @foreach(
                            $activityLogs->sortByDesc('created_at')
                            as $activity
                        )

                            <div class="activity-item">

                                <div class="activity-dot"></div>

                                <div class="activity-title">

                                    {{ $activity->activity ?? 'Activity' }}

                                </div>


                                @if(!empty($activity->description))

                                    <div class="activity-description">

                                        {{ $activity->description }}

                                    </div>

                                @endif


                                @if(!empty($activity->created_at))

                                    <div class="activity-date">

                                        {{ \Carbon\Carbon::parse(
                                            $activity->created_at
                                        )->format('d M Y H:i') }}

                                    </div>

                                @endif

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>


        {{-- ========================================================
             RIGHT SIDEBAR
        ========================================================= --}}

        <div class="col-lg-4">

            <div class="sticky-sidebar">


                {{-- ==================================================
                     REQUEST SUMMARY
                =================================================== --}}

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-card-list me-2 text-primary"></i>

                            Request Summary

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        <div class="summary-row">

                            <span class="summary-label">
                                Status
                            </span>

                            <span class="summary-value">

                                <span class="status-badge {{ $statusClass }}">

                                    {{ $statusLabel }}

                                </span>

                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Department
                            </span>

                            <span class="summary-value">
                                {{ $eurs->department ?? '-' }}
                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Quantity
                            </span>

                            <span class="summary-value">

                                {{ number_format(
                                    $quantity,
                                    0,
                                    '.',
                                    ','
                                ) }}

                                {{ $unit }}

                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Currency
                            </span>

                            <span class="summary-value">
                                {{ $currency ?: '-' }}
                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Unit Price
                            </span>

                            <span class="summary-value">

                                @if($unitPrice > 0)

                                    {{ $currency }}
                                    {{ $formattedUnitPrice }}

                                @else

                                    -

                                @endif

                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Amount Actual
                            </span>

                            <span class="summary-value">

                                @if($amountActual > 0)

                                    {{ $currency }}
                                    {{ $formattedAmountActual }}

                                @else

                                    -

                                @endif

                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                EHS
                            </span>

                            <span class="summary-value">

                                @if($requiresEhs)

                                    {{ $ehsStatusLabel }}

                                @else

                                    Not Required

                                @endif

                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Submitted
                            </span>

                            <span class="summary-value">
                                {{ $submittedDate }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     APPROVAL
                =================================================== --}}

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-person-check me-2 text-primary"></i>

                            Approval Information

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        <div class="summary-row">

                            <span class="summary-label">
                                Approval Person
                            </span>

                            <span class="summary-value">
                                {{ $eurs->approver_email ?? '-' }}
                            </span>

                        </div>


                        <div class="summary-row">

                            <span class="summary-label">
                                Current Stage
                            </span>

                            <span class="summary-value">
                                {{ $eurs->current_stage ?? '-' }}
                            </span>

                        </div>


                        @if($eurs->approved_at)

                            <div class="summary-row">

                                <span class="summary-label">
                                    Approved At
                                </span>

                                <span class="summary-value">

                                    {{ \Carbon\Carbon::parse(
                                        $eurs->approved_at
                                    )->format('d M Y H:i') }}

                                </span>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- ==================================================
                     TECHNICAL REFERENCE QUICK LINK
                =================================================== --}}

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="
                                bi
                                {{ $technicalIsImage
                                    ? 'bi-file-earmark-image text-success'
                                    : 'bi-file-earmark-pdf text-danger'
                                }}
                                me-2
                            "></i>

                            Technical Reference

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        @if(!empty($technicalReferenceUrl))

                            <div class="mb-3">

                                <div class="small text-muted mb-1">
                                    Uploaded file
                                </div>

                                <div class="fw-semibold text-break">

                                    {{ basename(
                                        $technicalReferencePath
                                    ) }}

                                </div>

                            </div>


                            <a
                                href="{{ $technicalReferenceUrl }}"
                                target="_blank"
                                class="btn btn-outline-primary w-100 btn-main justify-content-center"
                            >

                                <i class="bi bi-box-arrow-up-right"></i>

                                Open Technical Reference

                            </a>

                        @else

                            <div class="text-muted small text-center py-2">

                                No technical reference uploaded.

                            </div>

                        @endif

                    </div>

                </div>


                {{-- ==================================================
                     REQUESTOR
                =================================================== --}}

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-person-circle me-2 text-primary"></i>

                            Requestor

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        <div class="fw-semibold">

                            {{ optional($eurs->user)->name ?? '-' }}

                        </div>

                        <div class="small text-muted mt-1">

                            {{ optional($eurs->user)->email ?? '-' }}

                        </div>

                        <div class="small text-muted mt-1">

                            Department:
                            {{ $eurs->department ?? '-' }}

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     E-URS PDF
                =================================================== --}}

                <div class="eurs-card">

                    <div class="eurs-card-header">

                        <h5 class="eurs-card-title">

                            <i class="bi bi-file-earmark-pdf me-2 text-danger"></i>

                            E-URS Document

                        </h5>

                    </div>

                    <div class="eurs-card-body">

                        <p class="small text-muted">

                            Open the generated E-URS document in PDF format.

                        </p>

                        <a
                            href="{{ route('user.eurs.pdf', $eurs->id) }}"
                            target="_blank"
                            class="btn btn-primary w-100 btn-main justify-content-center"
                        >

                            <i class="bi bi-file-earmark-pdf"></i>

                            View Generated E-URS PDF

                        </a>

                    </div>

                </div>


            </div>

        </div>

    </div>

</div>

@endsection