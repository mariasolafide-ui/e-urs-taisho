<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>User Requirement Specification (General)</title>

    <style>

        @page {
            size: A4 portrait;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: #222222;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            font-size: 8.5px;
            line-height: 1.2;
        }

        .page {
            width: 510pt;
            margin: 0 auto;
            padding-top: 14pt;
            padding-bottom: 4pt;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .logo-wrapper {
            width: 100%;
            text-align: center;
            margin-bottom: 2px;
        }

        .logo {
            width: 215px;
            max-height: 62px;
            object-fit: contain;
        }

        .document-reference {
            width: 100%;
            text-align: right;
            font-size: 7px;
            margin-top: 0;
            margin-bottom: 2px;
        }

        .title {
            width: 100%;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-top: 1px;
            margin-bottom: 4px;
        }


        /* =========================================================
           DOCUMENT INFORMATION
        ========================================================= */

        .document-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
            font-size: 7.5px;
        }

        .document-info td {
            padding: 1px 0;
            vertical-align: middle;
        }

        .document-info .left {
            width: 50%;
            text-align: left;
        }

        .document-info .right {
            width: 50%;
            text-align: right;
        }

        .document-info strong {
            font-weight: bold;
        }


        /* =========================================================
           MAIN TABLE
        ========================================================= */

        .main-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .main-table td {
            border: 1px solid #222222;
            padding: 3px 4px;
            vertical-align: middle;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .main-table .label {
            width: 29%;
            font-weight: bold;
        }

        .main-table .value {
            width: 35.5%;
        }

        .main-table .value-right {
            width: 35.5%;
        }


        /* =========================================================
           ROW HEIGHT
        ========================================================= */

        .h-sm {
            height: 23px;
        }

        .h-md {
            height: 29px;
        }

        .h-lg {
            height: 38px;
        }

        .h-spec {
            height: auto;
            min-height: 72px;
        }

        .h-amount {
            height: 38px;
        }

        .h-ehs {
            height: 91px;
        }

        .h-technical {
            height: auto;
            min-height: 50px;
        }

        .h-supplier-quotation {
            height: auto;
            min-height: 42px;
        }


        /* =========================================================
           TEXT
        ========================================================= */

        .small-text {
            font-size: 7px;
        }

        .tiny-text {
            font-size: 6.5px;
        }

        .normal-text {
            font-size: 7.5px;
        }

        .value-text {
            font-size: 7.7px;
        }

        .muted {
            color: #555555;
        }

        .na {
            color: #333333;
        }


        /* =========================================================
           AMOUNT
        ========================================================= */

        .amount-row {
            width: 100%;
        }

        .amount-line {
            margin-bottom: 2px;
            font-size: 7.5px;
        }

        .amount-label {
            font-weight: bold;
        }

        .amount-value {
            font-size: 8px;
            font-weight: bold;
        }


        /* =========================================================
           TECHNICAL SPECIFICATION
        ========================================================= */

        .technical-title {
            font-weight: bold;
            font-size: 7.5px;
            margin-bottom: 2px;
        }

        .technical-content {
            font-size: 7.2px;
            line-height: 1.2;
            white-space: pre-line;
        }


        /* =========================================================
           SUPPLIER QUOTATION
        ========================================================= */

        .quotation-title {
            font-weight: bold;
            font-size: 7.5px;
            margin-bottom: 2px;
        }

        .quotation-content {
            font-size: 7.2px;
            line-height: 1.2;
        }


        /* =========================================================
           EHS
        ========================================================= */

        .ehs-title {
            font-weight: bold;
            margin-bottom: 2px;
            font-size: 7.5px;
        }

        .ehs-intro {
            font-size: 6.8px;
            margin-bottom: 2px;
        }

        .ehs-list {
            margin: 0;
            padding-left: 13px;
            font-size: 6.8px;
        }

        .ehs-list li {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .ehs-result {
            margin-top: 2px;
            font-size: 6.8px;
        }

        .ehs-notes {
            margin-top: 1px;
            font-size: 6.7px;
        }


        /* =========================================================
           FILE / ATTACHMENT
        ========================================================= */

        .attachment {
            margin-top: 2px;
            font-size: 6.7px;
            color: #333333;
        }

        .attachment-label {
            font-weight: bold;
        }


        /* =========================================================
           APPROVAL / SIGNATURE
        ========================================================= */

        .approval-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 4px;
        }

        .approval-table td {
            border: 1px solid #222222;
        }

        .approval-table .head {
            width: 33.33%;
            height: 21px;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            font-size: 7.5px;
            padding: 2px;
        }

        .approval-table .sign {
            width: 33.33%;
            height: 72px;
            text-align: center;
            vertical-align: bottom;
            padding: 3px;
        }


        /* =========================================================
           DIGITAL STAMP
        ========================================================= */

        .stamp {
            display: inline-block;
            border: 1.5px solid #175ca8;
            color: #175ca8;
            font-size: 9px;
            font-weight: bold;
            padding: 1px 6px;
            margin-bottom: 2px;
            transform: rotate(-4deg);
        }

        .stamp-rejected {
            border-color: #b22222;
            color: #b22222;
        }

        .stamp-pending {
            border-color: #666666;
            color: #666666;
        }

        .stamp-review {
            border-color: #175ca8;
            color: #175ca8;
        }

        .stamp-na {
            border-color: #777777;
            color: #777777;
        }

        .sig-name {
            font-size: 7px;
            font-weight: bold;
            margin-top: 1px;
        }

        .sig-role {
            font-size: 6.5px;
            margin-top: 0;
        }

        .sig-date {
            font-size: 5.8px;
            margin-top: 1px;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer-notes {
            margin-top: 2px;
            font-size: 5.8px;
            line-height: 1.05;
        }

        .footer-notes div {
            margin-bottom: 1px;
        }


        /* =========================================================
           PRINT SAFETY
        ========================================================= */

        .no-break {
            page-break-inside: avoid;
        }

    </style>
</head>


<body>

@php

    use Carbon\Carbon;


    /*
    |--------------------------------------------------------------------------
    | BASIC DATA
    |--------------------------------------------------------------------------
    */

    $userName =
        $eurs->user->name
        ?? '-';

    $department =
        $eurs->department
        ?? '-';

    $requestNumber =
        $eurs->request_number
        ?? '-';

    $requirement =
        $eurs->item_service_name
        ?? $eurs->requirement
        ?? '-';


    /*
    |--------------------------------------------------------------------------
    | QUANTITY
    |--------------------------------------------------------------------------
    |
    | SEMUA ANGKA DIBUAT TANPA DESIMAL
    |
    */

    $quantityRaw =
        $eurs->quantity
        ?? null;

    $quantityNumber = null;

    $quantity = '-';


    if (
        $quantityRaw !== null &&
        $quantityRaw !== ''
    ) {

        $cleanQuantity =
            str_replace(
                [',', ' '],
                '',
                $quantityRaw
            );

        $quantityNumber =
            (float) $cleanQuantity;


        $quantity =
            number_format(
                $quantityNumber,
                0,
                '.',
                ','
            );

    }


    $unit =
        $eurs->unit
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | UNIT PRICE
    |--------------------------------------------------------------------------
    */

    $unitPriceRaw =
        $eurs->unit_price
        ?? $eurs->price
        ?? null;

    $unitPriceNumber = null;


    if (
        $unitPriceRaw !== null &&
        $unitPriceRaw !== ''
    ) {

        $cleanUnitPrice =
            str_replace(
                [',', '.', ' '],
                '',
                $unitPriceRaw
            );

        $unitPriceNumber =
            (float) $cleanUnitPrice;

    }


    /*
    |--------------------------------------------------------------------------
    | CURRENCY
    |--------------------------------------------------------------------------
    */

    $currency =
        strtoupper(
            trim(
                $eurs->currency
                ?? $eurs->amount_currency
                ?? 'USD'
            )
        );


    $allowedCurrencies = [
        'USD',
        'EUR',
        'JPY',
        'CHF'
    ];


    if (
        !in_array(
            $currency,
            $allowedCurrencies
        )
    ) {

        $currency = 'USD';

    }


    /*
    |--------------------------------------------------------------------------
    | CURRENCY SYMBOL
    |--------------------------------------------------------------------------
    */

    $currencySymbol = match ($currency) {

        'USD' => '$',

        'EUR' => '€',

        'JPY' => '¥',

        'CHF' => 'CHF',

        default => $currency,

    };


    /*
    |--------------------------------------------------------------------------
    | ACTUAL AMOUNT
    |--------------------------------------------------------------------------
    |
    | Amount Actual =
    | Estimate Quantity x Unit Price
    |
    | TIDAK ADA DESIMAL
    |
    */

    $actualAmount = null;


    if (
        $quantityNumber !== null &&
        $unitPriceNumber !== null
    ) {

        $actualAmount =
            $quantityNumber *
            $unitPriceNumber;

    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT UNIT PRICE
    |--------------------------------------------------------------------------
    */

    $formattedUnitPrice = '-';


    if ($unitPriceNumber !== null) {

        $formattedUnitPrice =
            $currencySymbol .
            ' ' .
            number_format(
                $unitPriceNumber,
                0,
                '.',
                ','
            );

    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT ACTUAL AMOUNT
    |--------------------------------------------------------------------------
    */

    $formattedActualAmount = '-';


    if ($actualAmount !== null) {

        $formattedActualAmount =
            $currencySymbol .
            ' ' .
            number_format(
                $actualAmount,
                0,
                '.',
                ','
            );

    }


    /*
    |--------------------------------------------------------------------------
    | BRAND
    |--------------------------------------------------------------------------
    */

    $brand =
        $eurs->preferred_brand
        ?? $eurs->brand
        ?? '';

    $alternativeBrand =
        $eurs->alternative_brand
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | DETAIL SPECIFICATION
    |--------------------------------------------------------------------------
    */

    $detailSpec =
        $eurs->special_requirements
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | TECHNICAL SPECIFICATION
    |--------------------------------------------------------------------------
    */

    $technicalSpecification =
        $eurs->technical_description
        ?? $eurs->technical_specification
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | TECHNICAL REFERENCE FILE
    |--------------------------------------------------------------------------
    */

    $technicalReferenceFile =
        $eurs->technical_reference_file
        ?? null;


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER REFERENCE
    |--------------------------------------------------------------------------
    */

    $supplierRef =
        $eurs->reference_supplier
        ?? '-';


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER RECOMMENDATION
    |--------------------------------------------------------------------------
    */

    $supplierRecommendation =
        $eurs->supplier_recommendation
        ?? '';


    $supplierName =
        $eurs->supplier_name
        ?? '';


    $supplierContactPerson =
        $eurs->supplier_contact_person
        ?? '';


    $supplierContact =
        $eurs->supplier_contact
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER QUOTATION
    |--------------------------------------------------------------------------
    |
    | Menyesuaikan beberapa kemungkinan nama field.
    |
    */

    $supplierQuotationFile =
        $eurs->supplier_quotation_file
        ?? $eurs->supplier_quotation
        ?? null;


    /*
    |--------------------------------------------------------------------------
    | EHS REQUIRED
    |--------------------------------------------------------------------------
    */

    $requiresEhs =
        $eurs->requires_ehs == 1;


    /*
    |--------------------------------------------------------------------------
    | DELIVERY DATE
    |--------------------------------------------------------------------------
    */

    $rawDelivery =
        $eurs->expected_arrival_date
        ?: (
            $eurs->expected_date_of_delivery
            ?? null
        );


    $deliveryDate = '';


    if ($rawDelivery) {

        try {

            $deliveryDate =
                Carbon::parse(
                    $rawDelivery
                )
                ->format('d.m.Y');

        } catch (\Throwable $e) {

            $deliveryDate =
                $rawDelivery;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | SUBMISSION DATE - WIB
    |--------------------------------------------------------------------------
    */

    $submittedDate = null;


    if ($eurs->submitted_at) {

        try {

            $submittedDate =
                Carbon::parse(
                    $eurs->submitted_at
                )
                ->timezone('Asia/Jakarta')
                ->format('d.m.Y H:i:s');

        } catch (\Throwable $e) {

            $submittedDate =
                $eurs->submitted_at;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | APPROVAL DATA
    |--------------------------------------------------------------------------
    */

    $latestApproval = null;


    try {

        $latestApproval =
            $eurs->approvals()
                ->latest('id')
                ->first();

    } catch (\Throwable $e) {

        $latestApproval = null;

    }


    $approverName =
        $latestApproval->approver_name
        ?? 'Department Head';


    $approvalDate =
        $latestApproval->approved_at
        ?? $eurs->approved_at
        ?? null;


    $approvedDate = null;


    if ($approvalDate) {

        try {

            $approvedDate =
                Carbon::parse(
                    $approvalDate
                )
                ->timezone('Asia/Jakarta')
                ->format('d.m.Y H:i:s');

        } catch (\Throwable $e) {

            $approvedDate =
                $approvalDate;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | OVERALL STATUS
    |--------------------------------------------------------------------------
    */

    $overallStatus =
        strtolower(
            trim(
                $eurs->status
                ?? ''
            )
        );


    /*
    |--------------------------------------------------------------------------
    | EHS DATA
    |--------------------------------------------------------------------------
    */

    $ehsStatus =
        strtolower(
            trim(
                $eurs->ehs_status
                ?? ''
            )
        );


    $ehsReviewedDate = null;


    if ($eurs->ehs_reviewed_at) {

        try {

            $ehsReviewedDate =
                Carbon::parse(
                    $eurs->ehs_reviewed_at
                )
                ->timezone('Asia/Jakarta')
                ->format('d.m.Y H:i:s');

        } catch (\Throwable $e) {

            $ehsReviewedDate =
                $eurs->ehs_reviewed_at;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | EHS ASSESSMENT DEFAULT
    |--------------------------------------------------------------------------
    */

    $ehsPpe = 'NA';

    $ehsHazard = 'NA';

    $ehsAsbestos = 'NA';

    $ehsOds = 'NA';

    $ehsToxic = 'NA';

    $ehsChemical = 'NA';

    $ehsAdditionalNotes = '';


    /*
    |--------------------------------------------------------------------------
    | PARSE EHS NOTES
    |--------------------------------------------------------------------------
    */

    $rawEhsNotes =
        $eurs->ehs_notes
        ?? '';


    if (
        $requiresEhs &&
        $rawEhsNotes
    ) {

        if (
            preg_match(
                '/APD\s*\/\s*PPE\s*:\s*(.*?)(?=\r?\n|$)/i',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsPpe =
                trim(
                    $match[1]
                );

        }


        if (
            preg_match(
                '/Alcohol\s*\/\s*Explosive\s*\/\s*Flammable\s*\/\s*Combustible\s*:\s*(.*?)(?=\r?\n|$)/i',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsHazard =
                trim(
                    $match[1]
                );

        }


        if (
            preg_match(
                '/Asbestos\s*(?:Containing Material)?\s*:\s*(.*?)(?=\r?\n|$)/i',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsAsbestos =
                trim(
                    $match[1]
                );

        }


        if (
            preg_match(
                '/ODS\s*:\s*(.*?)(?=\r?\n|$)/i',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsOds =
                trim(
                    $match[1]
                );

        }


        if (
            preg_match(
                '/Toxic\s*Materials\s*\/\s*Pesticides\s*\/\s*Sanitation\s*:\s*(.*?)(?=\r?\n|$)/i',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsToxic =
                trim(
                    $match[1]
                );

        }


        if (
            preg_match(
                '/Raw\s*Material\s*\/\s*New\s*Chemical.*?MSDS\s*:\s*(.*?)(?=\r?\n|$)/i',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsChemical =
                trim(
                    $match[1]
                );

        }


        if (
            preg_match(
                '/EHS\s*Recommendation\s*\/?\s*Notes\s*:\s*(.*)$/is',
                $rawEhsNotes,
                $match
            )
        ) {

            $ehsAdditionalNotes =
                trim(
                    $match[1]
                );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | CAPEX FILE
    |--------------------------------------------------------------------------
    */

    $capexLayoutFile =
        $eurs->capex_layout_file
        ?? null;


    /*
    |--------------------------------------------------------------------------
    | EHS ATTACHMENT
    |--------------------------------------------------------------------------
    */

    $ehsAttachment =
        $eurs->ehs_attachment
        ?? null;


    /*
    |--------------------------------------------------------------------------
    | PROCUREMENT SLA
    |--------------------------------------------------------------------------
    */

    $procurementSlaDate =
        $eurs->procurement_sla_date
        ?? null;


    $procurementSlaFormatted = '';


    if ($procurementSlaDate) {

        try {

            $procurementSlaFormatted =
                Carbon::parse(
                    $procurementSlaDate
                )
                ->format('d.m.Y');

        } catch (\Throwable $e) {

            $procurementSlaFormatted =
                $procurementSlaDate;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | AMOUNT CATEGORY
    |--------------------------------------------------------------------------
    */

    $amountCategory =
        $eurs->amount_category
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | CAPEX
    |--------------------------------------------------------------------------
    */

    $capexBudgetNumber =
        $eurs->capex_budget_number
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | IT
    |--------------------------------------------------------------------------
    */

    $itRam =
        $eurs->it_ram
        ?? '';

    $itInternalMemory =
        $eurs->it_internal_memory
        ?? '';

    $itConnectivity =
        $eurs->it_connectivity
        ?? '';

    $itOs =
        $eurs->it_os
        ?? '';

    $itRecommendationDetails =
        $eurs->it_recommendation_details
        ?? '';


    /*
    |--------------------------------------------------------------------------
    | LOGO
    |--------------------------------------------------------------------------
    */

    $logoPath =
        public_path(
            'images/taisho-logo.png'
        );


    if (!file_exists($logoPath)) {

        $logoPath =
            public_path(
                'images/taisho-logo.jpg'
            );

    }


    if (!file_exists($logoPath)) {

        $logoPath =
            public_path(
                'images/logo.png'
            );

    }


    $logoData = null;


    if (file_exists($logoPath)) {

        $extension =
            strtolower(
                pathinfo(
                    $logoPath,
                    PATHINFO_EXTENSION
                )
            );


        $mime = match ($extension) {

            'jpg',
            'jpeg'
                => 'image/jpeg',

            'gif'
                => 'image/gif',

            default
                => 'image/png',

        };


        $logoData =
            'data:' .
            $mime .
            ';base64,' .
            base64_encode(
                file_get_contents(
                    $logoPath
                )
            );

    }


    /*
    |--------------------------------------------------------------------------
    | AUDIT STATUS
    |--------------------------------------------------------------------------
    */

    if ($approvedDate) {

        $auditApprovalStatus =
            'APPROVED';

    } elseif (
        $overallStatus === 'rejected' ||
        $overallStatus === 'rejected_by_hod'
    ) {

        $auditApprovalStatus =
            'REJECTED';

    } elseif (
        $overallStatus === 'ehs_in_review'
    ) {

        $auditApprovalStatus =
            'EHS IN REVIEW';

    } else {

        $auditApprovalStatus =
            'PENDING';

    }


    if (!$requiresEhs) {

        $auditEhsStatus =
            'NA';

    } elseif (
        $ehsStatus === 'approved' ||
        $ehsStatus === 'completed'
    ) {

        $auditEhsStatus =
            'APPROVED';

    } elseif (
        $ehsStatus === 'rejected'
    ) {

        $auditEhsStatus =
            'REJECTED';

    } elseif (
        $ehsStatus === 'in_review' ||
        $ehsStatus === 'review'
    ) {

        $auditEhsStatus =
            'IN REVIEW';

    } else {

        $auditEhsStatus =
            'PENDING';

    }


    $documentStatus =
        strtoupper(
            str_replace(
                '_',
                ' ',
                $overallStatus ?: 'DRAFT'
            )
        );

@endphp


<div class="page">


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="logo-wrapper">

        @if($logoData)

            <img
                src="{{ $logoData }}"
                class="logo"
                alt="PT Taisho Pharmaceutical Indonesia"
            >

        @else

            <div style="
                font-size:14px;
                font-weight:bold;
                margin-bottom:5px;
            ">
                PT TAISHO PHARMACEUTICAL INDONESIA Tbk
            </div>

        @endif

    </div>


    <div class="document-reference">
        Attachment 2 – SOP PH-G001.01
    </div>


    <div class="title">
        User Requirement Specification (General)
    </div>


    {{-- =========================================================
         DOCUMENT INFORMATION
    ========================================================== --}}

    <table class="document-info">

        <tr>

            <td class="left">

                <strong>Document No.:</strong>

                {{ $requestNumber }}

            </td>


            <td class="right">

                <strong>Submission Date:</strong>

                {{ $submittedDate ?? '-' }}

            </td>

        </tr>

    </table>


    {{-- =========================================================
         MAIN BODY
    ========================================================== --}}

    <table class="main-table">


        {{-- =====================================================
             DEPARTMENT
        ====================================================== --}}

        <tr class="h-sm">

            <td class="label">
                Department
            </td>

            <td class="value">
                {{ $department }}
            </td>

            <td class="value-right">

                <strong>Request No.</strong><br>

                {{ $requestNumber }}

            </td>

        </tr>


        {{-- =====================================================
             REQUIREMENT
        ====================================================== --}}

        <tr class="h-md">

            <td class="label">
                Requirement
            </td>

            <td class="value">

                {{ $requirement }}

            </td>

            <td class="value-right">

                @if($eurs->special_requirements)

                    <strong>
                        Special Requirement
                    </strong>

                    <br>

                    {{ $eurs->special_requirements }}

                @else

                    -

                @endif

            </td>

        </tr>


        {{-- =====================================================
             DELIVERY
        ====================================================== --}}

        <tr class="h-sm">

            <td class="label">
                Expected Date of Delivery
            </td>

            <td class="value">

                {{ $deliveryDate ?: '-' }}

            </td>

            <td class="value-right">

                <strong>
                    SLA Target
                </strong>

                <br>

                @if(
                    $supplierRecommendation ===
                    'Tidak Punya Rekomendasi'
                )

                    {{ $procurementSlaFormatted ?: 'N/A' }}

                @else

                    N/A

                @endif

            </td>

        </tr>


        {{-- =====================================================
             QUANTITY
        ====================================================== --}}

        <tr class="h-sm">

            <td class="label">
                Estimate Quantity
            </td>

            <td class="value">

                {{ $quantity }}

                @if($unit)

                    {{ $unit }}

                @endif

            </td>

            <td class="value-right">

                @if($amountCategory)

                    <strong>
                        PR Amount Category
                    </strong>

                    <br>

                    @if($amountCategory === 'below_50m')

                        Below IDR 49,999,900

                    @elseif($amountCategory === 'above_50m')

                        Above IDR 50,000,000

                    @else

                        {{ $amountCategory }}

                    @endif

                @else

                    -

                @endif

            </td>

        </tr>
       

        {{-- =====================================================
             AMOUNT ACTUAL
        ====================================================== --}}

        <tr class="h-amount">

            <td class="label">
                Amount Actual
            </td>

            <td class="value" colspan="2">

                <span class="amount-value">
                    {{ $formattedActualAmount }}
                </span>

            </td>

        </tr>


        {{-- =====================================================
             BRAND
        ====================================================== --}}

        <tr class="h-spec">

            <td class="label">
                Brand
            </td>

            <td class="value">

                <strong>
                    Preferred:
                </strong>

                {{ $brand ?: '-' }}

            </td>

            <td class="value-right">

                <strong>
                    Alternative:
                </strong>

                {{ $alternativeBrand ?: '-' }}

            </td>

        </tr>


        {{-- =====================================================
             DETAIL SPECIFICATION
        ====================================================== --}}

        <tr class="h-spec">

            <td class="label">

                Detail Specification

                <br>

                <span class="small-text">
                    (Attach picture or design if any)
                </span>

            </td>


            <td
                class="value"
                colspan="2"
            >

                @if($detailSpec)

                    <div class="value-text">

                        {{ $detailSpec }}

                    </div>

                @else

                    <span class="muted">
                        -
                    </span>

                @endif


                {{-- IT INFORMATION --}}

                @if(
                    $itRam ||
                    $itInternalMemory ||
                    $itConnectivity ||
                    $itOs ||
                    $itRecommendationDetails
                )

                    <div style="margin-top:3px;">

                        <strong>
                            IT Requirement:
                        </strong>

                        @if($itRam)
                            RAM: {{ $itRam }};
                        @endif

                        @if($itInternalMemory)
                            Internal Memory: {{ $itInternalMemory }};
                        @endif

                        @if($itConnectivity)
                            Connectivity: {{ $itConnectivity }};
                        @endif

                        @if($itOs)
                            OS: {{ $itOs }};
                        @endif

                        @if($itRecommendationDetails)
                            {{ $itRecommendationDetails }}
                        @endif

                    </div>

                @endif


                {{-- CAPEX --}}

                @if($capexBudgetNumber)

                    <div style="margin-top:3px;">

                        <strong>
                            No. Budget CAPEX:
                        </strong>

                        {{ $capexBudgetNumber }}

                    </div>

                @endif


                @if($capexLayoutFile)

                    <div class="attachment">

                        <span class="attachment-label">
                            CAPEX Attachment:
                        </span>

                        {{ basename($capexLayoutFile) }}

                    </div>

                @endif

            </td>

        </tr>


        {{-- =====================================================
             TECHNICAL SPECIFICATION
        ====================================================== --}}

        @if(
            $technicalSpecification ||
            $technicalReferenceFile
        )

            <tr class="h-technical">

                <td class="label">
                    Technical Specification
                </td>

                <td
                    class="value"
                    colspan="2"
                >

                    @if($technicalSpecification)

                        <div class="technical-content">
                            {{ $technicalSpecification }}
                        </div>

                    @else

                        <span class="muted">
                            -
                        </span>

                    @endif


                    @if($technicalReferenceFile)

                        <div class="attachment">

                            <span class="attachment-label">
                                Technical Specification Attachment:
                            </span>

                            {{ basename($technicalReferenceFile) }}

                        </div>

                    @endif

                </td>

            </tr>

        @endif


        {{-- =====================================================
             SUPPLIER QUOTATION
        ====================================================== --}}

        @if($supplierQuotationFile)

            <tr class="h-supplier-quotation">

                <td class="label">
                    Supplier Quotation
                </td>

                <td
                    class="value"
                    colspan="2"
                >

                    <div class="quotation-content">

                        <strong>
                            Supplier Quotation Attachment:
                        </strong>

                        {{ basename($supplierQuotationFile) }}

                    </div>

                </td>

            </tr>

        @endif


        {{-- =====================================================
             EHS RECOMMENDATION
        ====================================================== --}}

        <tr class="h-ehs">

            <td class="label">
                EHS Recommendation
            </td>


            <td colspan="2">


                @if(!$requiresEhs)

                    <div class="ehs-title">
                        EHS Recommendation is specific for:
                    </div>

                    <div class="ehs-intro">
                        EHS assessment is not required for this request.
                    </div>

                    <ol class="ehs-list">

                        <li>
                            APD / PPE : NA
                        </li>

                        <li>
                            Alcohol / Explosive / Flammable / Combustible : NA
                        </li>

                        <li>
                            Asbestos : NA
                        </li>

                        <li>
                            ODS : NA
                        </li>

                        <li>
                            Toxic Materials / Pesticides / Sanitation : NA
                        </li>

                        <li>
                            Raw Material / New Chemical with MSDS : NA
                        </li>

                    </ol>

                @else

                    <div class="ehs-title">
                        EHS Recommendation is specific for:
                    </div>

                    <div class="ehs-intro">
                        Please assess whether the requested
                        material/service is related to the following:
                    </div>

                    <ol class="ehs-list">

                        <li>
                            APD / PPE :
                            {{ $ehsPpe }}
                        </li>

                        <li>
                            Alcohol / Explosive / Flammable / Combustible :
                            {{ $ehsHazard }}
                        </li>

                        <li>
                            Asbestos :
                            {{ $ehsAsbestos }}
                        </li>

                        <li>
                            ODS :
                            {{ $ehsOds }}
                        </li>

                        <li>
                            Toxic Materials / Pesticides / Sanitation :
                            {{ $ehsToxic }}
                        </li>

                        <li>
                            Raw Material / New Chemical with MSDS :
                            {{ $ehsChemical }}
                        </li>

                    </ol>


                    @if($ehsAdditionalNotes)

                        <div class="ehs-notes">

                            <strong>
                                EHS Recommendation / Notes:
                            </strong>

                            {{ $ehsAdditionalNotes }}

                        </div>

                    @endif


                    @if($ehsAttachment)

                        <div class="attachment">

                            <span class="attachment-label">
                                EHS Attachment:
                            </span>

                            {{ basename($ehsAttachment) }}

                        </div>

                    @endif

                @endif

            </td>

        </tr>


        {{-- =====================================================
             SUPPLIER REFERENCE
        ====================================================== --}}

        <tr class="h-md">

            <td class="label">
                Reference of Supplier
            </td>

            <td colspan="2">

                @if(
                    $supplierRecommendation ===
                    'Punya Rekomendasi'
                )

                    <strong>
                        Supplier Recommendation:
                    </strong>

                    Punya Rekomendasi


                    @if($supplierRef)

                        <br>

                        <strong>
                            Supplier:
                        </strong>

                        {{ $supplierRef }}

                    @endif


                    @if($supplierName)

                        <br>

                        <strong>
                            Supplier Name:
                        </strong>

                        {{ $supplierName }}

                    @endif


                    @if($supplierContactPerson)

                        <br>

                        <strong>
                            Contact Person:
                        </strong>

                        {{ $supplierContactPerson }}

                    @endif


                    @if($supplierContact)

                        <br>

                        <strong>
                            Contact:
                        </strong>

                        {{ $supplierContact }}

                    @endif


                @elseif(
                    $supplierRecommendation ===
                    'Tidak Punya Rekomendasi'
                )

                    <strong>
                        Supplier Recommendation:
                    </strong>

                    Tidak Punya Rekomendasi


                    @if($procurementSlaFormatted)

                        <br>

                        <strong>
                            Procurement SLA Target:
                        </strong>

                        {{ $procurementSlaFormatted }}

                    @endif


                @else

                    {{ $supplierRef ?: '-' }}

                @endif

            </td>

        </tr>

    </table>


    {{-- =========================================================
         APPROVAL / SIGNATURE BOX
    ========================================================== --}}

    <table class="approval-table no-break">

        <tr>

            <td class="head">
                Prepared by,
            </td>

            <td class="head">
                Approved by,
            </td>

            <td class="head">
                EHS Officer**
            </td>

        </tr>


        <tr>


            {{-- =================================================
                 PREPARED BY
            ================================================== --}}

            <td class="sign">

                @if($submittedDate)

                    <div class="stamp">
                        SUBMITTED
                    </div>

                @else

                    <div class="stamp stamp-pending">
                        DRAFT
                    </div>

                @endif


                <div class="sig-name">
                    {{ $userName }}
                </div>


                <div class="sig-role">
                    User / Requestor
                </div>


                @if($submittedDate)

                    <div class="sig-date">

                        Submitted:
                        {{ $submittedDate }}

                    </div>

                @endif

            </td>


            {{-- =================================================
                 APPROVED BY
            ================================================== --}}

            <td class="sign">

                @if($approvedDate)

                    <div class="stamp">
                        APPROVED
                    </div>

                @elseif(
                    $overallStatus === 'rejected'
                    ||
                    $overallStatus === 'rejected_by_hod'
                )

                    <div class="stamp stamp-rejected">
                        REJECTED
                    </div>

                @elseif(
                    $overallStatus === 'ehs_in_review'
                )

                    <div class="stamp stamp-pending">
                        PENDING
                    </div>

                @else

                    <div class="stamp stamp-pending">
                        PENDING
                    </div>

                @endif


                <div class="sig-name">
                    {{ $approverName }}
                </div>


                <div class="sig-role">
                    Department Head
                </div>


                @if($approvedDate)

                    <div class="sig-date">

                        Approved:
                        {{ $approvedDate }}

                    </div>

                @endif

            </td>


            {{-- =================================================
                 EHS OFFICER
            ================================================== --}}

            <td class="sign">

                @if(!$requiresEhs)

                    <div class="stamp stamp-na">
                        NA
                    </div>

                    <div class="sig-name">
                        EHS Officer
                    </div>

                    <div class="sig-role">
                        Not Applicable**
                    </div>


                @elseif(
                    $ehsStatus === 'approved'
                    ||
                    $ehsStatus === 'completed'
                )

                    <div class="stamp">
                        APPROVED
                    </div>

                    <div class="sig-name">
                        EHS Officer
                    </div>

                    <div class="sig-role">
                        EHS Officer
                    </div>


                    @if($ehsReviewedDate)

                        <div class="sig-date">

                            Reviewed:
                            {{ $ehsReviewedDate }}

                        </div>

                    @endif


                @elseif(
                    $ehsStatus === 'rejected'
                )

                    <div class="stamp stamp-rejected">
                        REJECTED
                    </div>

                    <div class="sig-name">
                        EHS Officer
                    </div>

                    <div class="sig-role">
                        EHS Officer
                    </div>


                    @if($ehsReviewedDate)

                        <div class="sig-date">

                            Reviewed:
                            {{ $ehsReviewedDate }}

                        </div>

                    @endif


                @elseif(
                    $ehsStatus === 'in_review'
                    ||
                    $ehsStatus === 'review'
                )

                    <div class="stamp stamp-review">
                        IN REVIEW
                    </div>

                    <div class="sig-name">
                        EHS Officer
                    </div>

                    <div class="sig-role">
                        EHS Officer
                    </div>


                @else

                    <div class="stamp stamp-pending">
                        PENDING
                    </div>

                    <div class="sig-name">
                        EHS Officer
                    </div>

                    <div class="sig-role">
                        EHS Officer
                    </div>

                @endif

            </td>

        </tr>

    </table>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}

    <div class="footer-notes">

        <div>
            * Customers who have been used the goods/services.
        </div>

        <div>
            ** Applicable for material related to EHS recommendations.
        </div>

        <div>
            This document is electronically generated and forms part
            of the E-URS digital audit trail.
        </div>

    </div>


</div>

</body>
</html>