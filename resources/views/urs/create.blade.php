@extends('layouts.app')

@section('title', 'E-URS | Create User Requirement Specification')

@section('page-title', 'Create User Requirement Specification')

@section('page-description', 'Submit a new User Requirement Specification')

@section('content')

<style>
    .form-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    .form-header {
        margin-bottom: 25px;
    }

    .form-header h2 {
        font-size: 26px;
        font-weight: 700;
        color: #123b6d;
        margin-bottom: 8px;
    }

    .form-header p {
        color: #6b7280;
        margin-bottom: 0;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(15, 55, 95, 0.06);
        padding: 28px;
        margin-bottom: 24px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 18px;
        font-weight: 700;
        color: #123b6d;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-title i {
        color: #2d8fd5;
        font-size: 20px;
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .required {
        color: #dc3545;
        margin-left: 2px;
    }

    .form-control,
    .form-select {
        min-height: 44px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        padding: 10px 13px;
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #5aa9df;
        box-shadow: 0 0 0 3px rgba(90, 169, 223, 0.15);
    }

    .radio-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .radio-option {
        flex: 1;
        min-width: 220px;
    }

    .radio-option input {
        display: none;
    }

    .radio-option label {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 13px 16px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        background: #ffffff;
        color: #374151;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .radio-option label i {
        color: #6b7280;
        font-size: 17px;
    }

    .radio-option input:checked + label {
        border-color: #2d8fd5;
        background: #eef8ff;
        color: #1769aa;
        box-shadow: 0 0 0 2px rgba(45, 143, 213, 0.08);
    }

    .radio-option input:checked + label i {
        color: #2d8fd5;
    }

    .conditional-section {
        display: none;
        margin-top: 20px;
    }

    .conditional-box {
        background: #f8fbfe;
        border: 1px solid #dcecf8;
        border-radius: 12px;
        padding: 20px;
    }

    .conditional-box-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #1769aa;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 15px;
        background: #eef8ff;
        border: 1px solid #cfe8f8;
        border-radius: 9px;
        color: #285b7a;
        font-size: 13px;
        line-height: 1.5;
    }

    .info-box i {
        color: #2d8fd5;
        font-size: 17px;
        margin-top: 1px;
    }

    .approval-info {
        background: #f4f8fc;
        border: 1px solid #dbe7f1;
        border-radius: 9px;
        padding: 13px 15px;
        min-height: 44px;
        display: flex;
        align-items: center;
        gap: 9px;
        color: #374151;
        font-size: 14px;
    }

    .approval-info i {
        color: #2d8fd5;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 6px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-cancel {
        min-width: 120px;
        border: 1px solid #d1d5db;
        color: #4b5563;
        background: #ffffff;
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
    }

    .btn-cancel:hover {
        background: #f9fafb;
        color: #374151;
    }

    .btn-submit {
        min-width: 170px;
        border: none;
        color: #ffffff;
        background: #2d8fd5;
        border-radius: 8px;
        padding: 11px 20px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-submit:hover {
        background: #217bb9;
        color: #ffffff;
    }

    .field-help {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    .file-note {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    .alert-danger {
        border-radius: 10px;
    }

    /* =========================================================
       PRICE / AMOUNT
    ========================================================= */

    .price-input-wrapper {
        position: relative;
    }

    .price-input {
        text-align: right;
    }

    /* =========================================================
       AMOUNT ACTUAL
    ========================================================= */

    .amount-actual-wrapper {
        width: 100%;
        max-width: 420px;
    }

    .amount-display {
        width: 100%;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 8px;
        background: #f4f8fc;
        border: 1px solid #dbe7f1;
        border-radius: 8px;
        padding: 10px 13px;
        font-size: 14px;
        font-weight: 700;
        color: #123b6d;
        text-align: left;
    }

    .amount-display .amount-currency {
        color: #2d8fd5;
        font-weight: 700;
        flex-shrink: 0;
    }

    .amount-display .amount-number {
        color: #123b6d;
        font-weight: 700;
        text-align: left;
    }

    .calculation-info {
        margin-top: 7px;
        font-size: 12px;
        color: #6b7280;
    }

    .requirement-price-row {
        margin-top: 2px;
    }

    @media (max-width: 992px) {

        .requirement-price-row > div {
            margin-bottom: 5px;
        }
    }

    @media (max-width: 768px) {

        .form-card {
            padding: 20px;
        }

        .radio-option {
            min-width: 100%;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .btn-cancel,
        .btn-submit {
            width: 100%;
        }

        .amount-actual-wrapper {
            max-width: 100%;
        }
    }
</style>


<div class="form-wrapper">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="form-header">

        <h2>Create User Requirement Specification</h2>

        <p>
            Please complete the information below to submit a new User Requirement Specification.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- VALIDATION ERROR --}}
    {{-- ========================================================= --}}

    @if ($errors->any())

        <div class="alert alert-danger mb-4">

            <div class="fw-semibold mb-2">
                Please check the following fields:
            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('user.eurs.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="eursForm"
    >

        @csrf


        {{-- ========================================================= --}}
        {{-- 1. GENERAL INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="form-card">

            <div class="section-title">

                <i class="bi bi-file-earmark-text"></i>

                <span>General Information & Recommendation</span>

            </div>


            <div class="row g-4">


                {{-- DEPARTMENT --}}

                <div class="col-md-6">

                    <label
                        for="department"
                        class="form-label"
                    >

                        Department

                        <span class="required">*</span>

                    </label>


                    <select
                        name="department"
                        id="department"
                        class="form-select @error('department') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Select Department
                        </option>

                        @foreach ($departments as $department)

                            <option
                                value="{{ $department }}"
                                {{ old('department') === $department ? 'selected' : '' }}
                            >
                                {{ $department }}
                            </option>

                        @endforeach

                    </select>


                    @error('department')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- APPROVAL PERSON --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Approval Person
                    </label>


                    <div class="approval-info">

                        <span id="approverDisplay">
                            Approval person will be assigned automatically.
                        </span>

                    </div>

                </div>


                {{-- EHS ASSESSMENT --}}

                <div class="col-12">

                    <label class="form-label">

                        EHS Assessment Required

                        <span class="required">*</span>

                    </label>


                    <div class="info-box mb-3">

                        <i class="bi bi-shield-check"></i>

                        <div>

                            Please indicate whether this User Specification Request
                            requires Environmental, Health, and Safety (EHS) assessment.

                            <br>

                            <strong>
                                EHS details will be completed by the EHS team after submission.
                            </strong>

                        </div>

                    </div>


                    <div class="radio-group">

                        <div class="radio-option">

                            <input
                                type="radio"
                                id="requires_ehs_yes"
                                name="requires_ehs"
                                value="1"
                                {{ old('requires_ehs') === '1' ? 'checked' : '' }}
                                required
                            >

                            <label for="requires_ehs_yes">

                                <i class="bi bi-shield-check"></i>

                                Yes, EHS Assessment Required

                            </label>

                        </div>


                        <div class="radio-option">

                            <input
                                type="radio"
                                id="requires_ehs_no"
                                name="requires_ehs"
                                value="0"
                                {{ old('requires_ehs') === '0' ? 'checked' : '' }}
                            >

                            <label for="requires_ehs_no">

                                <i class="bi bi-shield-x"></i>

                                No EHS Assessment Required

                            </label>

                        </div>

                    </div>


                    @error('requires_ehs')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- PR AMOUNT --}}

                <div class="col-12">

                    <label class="form-label">

                        PR Amount

                        <span class="required">*</span>

                    </label>


                    <div class="radio-group">

                        <div class="radio-option">

                            <input
                                type="radio"
                                id="amount_below"
                                name="amount_category"
                                value="below_50m"
                                {{ old('amount_category') === 'below_50m' ? 'checked' : '' }}
                                required
                            >

                            <label for="amount_below">

                                <i class="bi bi-arrow-down-circle"></i>

                                Below IDR 49,999,900

                            </label>

                        </div>


                        <div class="radio-option">

                            <input
                                type="radio"
                                id="amount_above"
                                name="amount_category"
                                value="above_50m"
                                {{ old('amount_category') === 'above_50m' ? 'checked' : '' }}
                            >

                            <label for="amount_above">

                                <i class="bi bi-arrow-up-circle"></i>

                                Above IDR 50,000,000

                            </label>

                        </div>

                    </div>


                    @error('amount_category')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- SUPPLIER RECOMMENDATION --}}

                <div class="col-12">

                    <label class="form-label">

                        Supplier Recommendation

                        <span class="required">*</span>

                    </label>


                    <div class="radio-group">

                        <div class="radio-option">

                            <input
                                type="radio"
                                id="supplier_yes"
                                name="supplier_recommendation"
                                value="Punya Rekomendasi"
                                {{ old('supplier_recommendation') === 'Punya Rekomendasi' ? 'checked' : '' }}
                                required
                            >

                            <label for="supplier_yes">

                                <i class="bi bi-check-circle"></i>

                                Punya Rekomendasi

                            </label>

                        </div>


                        <div class="radio-option">

                            <input
                                type="radio"
                                id="supplier_no"
                                name="supplier_recommendation"
                                value="Tidak Punya Rekomendasi"
                                {{ old('supplier_recommendation') === 'Tidak Punya Rekomendasi' ? 'checked' : '' }}
                            >

                            <label for="supplier_no">

                                <i class="bi bi-question-circle"></i>

                                Tidak Punya Rekomendasi

                            </label>

                        </div>

                    </div>


                    @error('supplier_recommendation')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- SUPPLIER DETAILS --}}

                <div
                    class="col-12 conditional-section"
                    id="supplierSection"
                >

                    <div class="conditional-box">

                        <div class="conditional-box-title">

                            <i class="bi bi-building"></i>

                            Supplier Details

                        </div>


                        <div class="row g-4">


                            {{-- SUPPLIER NAME --}}

                            <div class="col-md-6">

                                <label
                                    for="reference_supplier"
                                    class="form-label"
                                >

                                    Reference of Supplier

                                    <span
                                        class="required supplier-required"
                                        style="display:none;"
                                    >
                                        *
                                    </span>

                                </label>


                                <input
                                    type="text"
                                    name="reference_supplier"
                                    id="reference_supplier"
                                    class="form-control @error('reference_supplier') is-invalid @enderror"
                                    value="{{ old('reference_supplier') }}"
                                    placeholder="Enter supplier name"
                                >


                                @error('reference_supplier')

                                    <div class="error-message">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- CONTACT PERSON --}}

                            <div class="col-md-6">

                                <label
                                    for="supplier_contact_person"
                                    class="form-label"
                                >

                                    Supplier Contact Person

                                    <span
                                        class="required supplier-required"
                                        style="display:none;"
                                    >
                                        *
                                    </span>

                                </label>


                                <input
                                    type="text"
                                    name="supplier_contact_person"
                                    id="supplier_contact_person"
                                    class="form-control @error('supplier_contact_person') is-invalid @enderror"
                                    value="{{ old('supplier_contact_person') }}"
                                    placeholder="Enter contact person"
                                >


                                @error('supplier_contact_person')

                                    <div class="error-message">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- CONTACT --}}

                            <div class="col-md-6">

                                <label
                                    for="supplier_contact"
                                    class="form-label"
                                >

                                    Phone / Email

                                    <span
                                        class="required supplier-required"
                                        style="display:none;"
                                    >
                                        *
                                    </span>

                                </label>


                                <input
                                    type="text"
                                    name="supplier_contact"
                                    id="supplier_contact"
                                    class="form-control @error('supplier_contact') is-invalid @enderror"
                                    value="{{ old('supplier_contact') }}"
                                    placeholder="Enter phone number or email"
                                >


                                @error('supplier_contact')

                                    <div class="error-message">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- QUOTATION --}}

                            <div class="col-md-6">

                                <label
                                    for="supplier_quotation_file"
                                    class="form-label"
                                >

                                    Supplier Quotation

                                </label>


                                <input
                                    type="file"
                                    name="supplier_quotation_file"
                                    id="supplier_quotation_file"
                                    class="form-control @error('supplier_quotation_file') is-invalid @enderror"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                >


                                <div class="file-note">

                                    PDF, JPG, JPEG, or PNG.
                                    Maximum 10 MB.

                                </div>


                                @error('supplier_quotation_file')

                                    <div class="error-message">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- PROCUREMENT SLA --}}

                <div
                    class="col-12 conditional-section"
                    id="slaSection"
                >

                    <div class="conditional-box">

                        <div class="conditional-box-title">

                            <i class="bi bi-calendar-check"></i>

                            Procurement SLA

                        </div>


                        <div class="row g-4">

                            <div class="col-md-6">

                                <label
                                    for="procurement_sla_date"
                                    class="form-label"
                                >

                                    Target Date

                                    <span
                                        class="required sla-required"
                                        style="display:none;"
                                    >
                                        *
                                    </span>

                                </label>


                                <input
                                    type="date"
                                    name="procurement_sla_date"
                                    id="procurement_sla_date"
                                    class="form-control @error('procurement_sla_date') is-invalid @enderror"
                                    value="{{ old('procurement_sla_date') }}"
                                >


                                <div class="field-help">
                                    Target date for Procurement to search for a supplier.
                                </div>


                                @error('procurement_sla_date')

                                    <div class="error-message">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- 2. REQUIREMENT DETAILS --}}
        {{-- ========================================================= --}}

        <div class="form-card">

            <div class="section-title">

                <i class="bi bi-list-check"></i>

                <span>Requirement Details</span>

            </div>


            <div class="row g-4">


                {{-- ITEM / SERVICE NAME --}}

                <div class="col-12">

                    <label
                        for="item_service_name"
                        class="form-label"
                    >

                        Item / Service Name

                        <span class="required">*</span>

                    </label>


                    <input
                        type="text"
                        name="item_service_name"
                        id="item_service_name"
                        class="form-control @error('item_service_name') is-invalid @enderror"
                        value="{{ old('item_service_name') }}"
                        placeholder="Enter item or service name"
                        required
                    >


                    @error('item_service_name')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- SPECIAL REQUIREMENTS --}}

                <div class="col-12">

                    <label
                        for="special_requirements"
                        class="form-label"
                    >

                        Special Requirements

                    </label>


                    <textarea
                        name="special_requirements"
                        id="special_requirements"
                        class="form-control @error('special_requirements') is-invalid @enderror"
                        placeholder="Enter any special requirements such as minimum quantity, installation cost, warranty, etc."
                    >{{ old('special_requirements') }}</textarea>


                    @error('special_requirements')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ================================================= --}}
                {{-- ESTIMATE QUANTITY + UNIT + CURRENCY + UNIT PRICE --}}
                {{-- ================================================= --}}

                <div class="col-12">

                    <div class="row g-3 requirement-price-row">


                        {{-- ESTIMATE QUANTITY --}}

                        <div class="col-lg-3 col-md-6">

                            <label
                                for="quantity"
                                class="form-label"
                            >

                                Estimate Quantity

                                <span class="required">*</span>

                            </label>


                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity') }}"
                                min="1"
                                step="1"
                                placeholder="Quantity"
                                required
                            >


                            @error('quantity')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- UNIT --}}

                        <div class="col-lg-3 col-md-6">

                            <label
                                for="unit"
                                class="form-label"
                            >

                                Unit

                                <span class="required">*</span>

                            </label>


                            <select
                                name="unit"
                                id="unit"
                                class="form-select @error('unit') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Select Unit
                                </option>

                                <option
                                    value="Pcs"
                                    {{ old('unit') === 'Pcs' ? 'selected' : '' }}
                                >
                                    Pcs
                                </option>

                                <option
                                    value="Pack"
                                    {{ old('unit') === 'Pack' ? 'selected' : '' }}
                                >
                                    Pack
                                </option>

                                <option
                                    value="Unit"
                                    {{ old('unit') === 'Unit' ? 'selected' : '' }}
                                >
                                    Unit
                                </option>

                                <option
                                    value="Set"
                                    {{ old('unit') === 'Set' ? 'selected' : '' }}
                                >
                                    Set
                                </option>

                                <option
                                    value="Lot"
                                    {{ old('unit') === 'Lot' ? 'selected' : '' }}
                                >
                                    Lot
                                </option>

                                <option
                                    value="Box"
                                    {{ old('unit') === 'Box' ? 'selected' : '' }}
                                >
                                    Box
                                </option>

                                <option
                                    value="Bottle"
                                    {{ old('unit') === 'Bottle' ? 'selected' : '' }}
                                >
                                    Bottle
                                </option>

                                <option
                                    value="Roll"
                                    {{ old('unit') === 'Roll' ? 'selected' : '' }}
                                >
                                    Roll
                                </option>

                                <option
                                    value="Meter"
                                    {{ old('unit') === 'Meter' ? 'selected' : '' }}
                                >
                                    Meter
                                </option>

                            </select>


                            @error('unit')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- CURRENCY --}}

                        <div class="col-lg-3 col-md-6">

                            <label
                                for="currency"
                                class="form-label"
                            >

                                Currency

                                <span class="required">*</span>

                            </label>


                            <select
                                name="currency"
                                id="currency"
                                class="form-select @error('currency') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Select Currency
                                </option>

                                <option
                                    value="IDR"
                                    {{ old('currency') === 'IDR' ? 'selected' : '' }}
                                >
                                    IDR
                                </option>

                                <option
                                    value="USD"
                                    {{ old('currency') === 'USD' ? 'selected' : '' }}
                                >
                                    USD
                                </option>

                                <option
                                    value="EUR"
                                    {{ old('currency') === 'EUR' ? 'selected' : '' }}
                                >
                                    EUR
                                </option>

                                <option
                                    value="JPY"
                                    {{ old('currency') === 'JPY' ? 'selected' : '' }}
                                >
                                    JPY
                                </option>

                                <option
                                    value="CHF"
                                    {{ old('currency') === 'CHF' ? 'selected' : '' }}
                                >
                                    CHF
                                </option>

                            </select>


                            @error('currency')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- UNIT PRICE --}}

                        <div class="col-lg-3 col-md-6">

                            <label
                                for="unit_price_display"
                                class="form-label"
                            >

                                Unit Price

                                <span class="required">*</span>

                            </label>


                            <div class="price-input-wrapper">

                                <input
                                    type="text"
                                    id="unit_price_display"
                                    class="form-control price-input @error('unit_price') is-invalid @enderror"
                                    value="{{ old('unit_price') ? number_format((float) old('unit_price'), 0, ',', '.') : '' }}"
                                    placeholder="0"
                                    inputmode="numeric"
                                    autocomplete="off"
                                    required
                                >


                                <input
                                    type="hidden"
                                    name="unit_price"
                                    id="unit_price"
                                    value="{{ old('unit_price') }}"
                                >

                            </div>


                            <div class="field-help">
                                Enter price. Format will be added automatically.
                            </div>


                            @error('unit_price')

                                <div class="error-message">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- AMOUNT ACTUAL --}}
                {{-- ================================================= --}}

                <div class="col-12">

                    <label class="form-label">
                        Amount Actual
                    </label>


                    <div class="amount-actual-wrapper">

                        <div
                            class="amount-display"
                            id="amountActualDisplay"
                        >

                            <span
                                class="amount-currency"
                                id="amountCurrencyDisplay"
                            >
                                -
                            </span>

                            <span class="amount-number">

                                <span id="amountValueDisplay">
                                    0
                                </span>

                            </span>

                        </div>


                        <div class="calculation-info">

                            Automatically calculated:
                            Estimate Quantity × Unit Price

                        </div>

                    </div>


                    <input
                        type="hidden"
                        name="amount_actual"
                        id="amount_actual"
                        value="{{ old('amount_actual') }}"
                    >

                </div>


                {{-- ================================================= --}}
                {{-- EXPECTED DATE OF DELIVERY --}}
                {{-- ================================================= --}}

                <div class="col-12">

                    <label
                        for="expected_arrival_date"
                        class="form-label"
                    >

                        Expected Date of Delivery

                        <span class="required">*</span>

                    </label>


                    <input
                        type="date"
                        name="expected_arrival_date"
                        id="expected_arrival_date"
                        class="form-control @error('expected_arrival_date') is-invalid @enderror"
                        value="{{ old('expected_arrival_date') }}"
                        required
                    >


                    @error('expected_arrival_date')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- 3. BRAND --}}
        {{-- ========================================================= --}}

        <div class="form-card">

            <div class="section-title">

                <i class="bi bi-tags"></i>

                <span>Brand</span>

            </div>


            <div class="row g-4">

                <div class="col-md-6">

                    <label
                        for="preferred_brand"
                        class="form-label"
                    >

                        Preferred Brand

                    </label>


                    <input
                        type="text"
                        name="preferred_brand"
                        id="preferred_brand"
                        class="form-control @error('preferred_brand') is-invalid @enderror"
                        value="{{ old('preferred_brand') }}"
                        placeholder="Enter preferred brand"
                    >


                    @error('preferred_brand')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="alternative_brand"
                        class="form-label"
                    >

                        Alternative Brand

                    </label>


                    <input
                        type="text"
                        name="alternative_brand"
                        id="alternative_brand"
                        class="form-control @error('alternative_brand') is-invalid @enderror"
                        value="{{ old('alternative_brand') }}"
                        placeholder="Enter alternative brand"
                    >


                    @error('alternative_brand')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- 4. TECHNICAL SPECIFICATION --}}
        {{-- ========================================================= --}}

        <div class="form-card">

            <div class="section-title">

                <i class="bi bi-gear"></i>

                <span>Technical Specification</span>

            </div>


            <div class="row g-4">

                <div class="col-12">

                    <label
                        for="technical_description"
                        class="form-label"
                    >

                        Detail Specification

                        <span class="required">*</span>

                    </label>


                    <textarea
                        name="technical_description"
                        id="technical_description"
                        class="form-control @error('technical_description') is-invalid @enderror"
                        placeholder="Describe the technical specification, requirements, dimensions, materials, or other relevant details."
                        required
                    >{{ old('technical_description') }}</textarea>


                    @error('technical_description')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="technical_reference_file"
                        class="form-label"
                    >

                        Technical Reference File

                    </label>


                    <input
                        type="file"
                        name="technical_reference_file"
                        id="technical_reference_file"
                        class="form-control @error('technical_reference_file') is-invalid @enderror"
                        accept=".pdf,.jpg,.jpeg,.png"
                    >


                    <div class="file-note">

                        Attach picture, design, drawing, or technical specification.
                        Maximum 10 MB.

                    </div>


                    @error('technical_reference_file')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- 5. CAPEX PROJECT --}}
        {{-- ========================================================= --}}

        <div
            class="form-card conditional-section"
            id="capexSection"
        >

            <div class="section-title">

                <i class="bi bi-building-gear"></i>

                <span>CAPEX Project Information</span>

            </div>


            <div class="conditional-box">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label
                            for="capex_budget_number"
                            class="form-label"
                        >

                            Budget Project Number

                            <span class="required">*</span>

                        </label>


                        <input
                            type="text"
                            name="capex_budget_number"
                            id="capex_budget_number"
                            class="form-control @error('capex_budget_number') is-invalid @enderror"
                            value="{{ old('capex_budget_number') }}"
                            placeholder="Enter budget project number"
                        >


                        @error('capex_budget_number')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="capex_layout_file"
                            class="form-label"
                        >

                            Layout / Technical Specification

                            <span class="required">*</span>

                        </label>


                        <input
                            type="file"
                            name="capex_layout_file"
                            id="capex_layout_file"
                            class="form-control @error('capex_layout_file') is-invalid @enderror"
                            accept=".pdf,.jpg,.jpeg,.png"
                        >


                        <div class="file-note">

                            PDF, JPG, JPEG, or PNG.
                            Maximum 10 MB.

                        </div>


                        @error('capex_layout_file')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- 6. IT RECOMMENDATION --}}
        {{-- ========================================================= --}}

        <div
            class="form-card conditional-section"
            id="itSection"
        >

            <div class="section-title">

                <i class="bi bi-pc-display"></i>

                <span>IT Recommendation</span>

            </div>


            <div class="conditional-box">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label
                            for="it_ram"
                            class="form-label"
                        >

                            RAM

                        </label>


                        <input
                            type="text"
                            name="it_ram"
                            id="it_ram"
                            class="form-control @error('it_ram') is-invalid @enderror"
                            value="{{ old('it_ram') }}"
                            placeholder="e.g. 8 GB / 16 GB"
                        >


                        @error('it_ram')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="it_internal_memory"
                            class="form-label"
                        >

                            Internal Memory

                        </label>


                        <input
                            type="text"
                            name="it_internal_memory"
                            id="it_internal_memory"
                            class="form-control @error('it_internal_memory') is-invalid @enderror"
                            value="{{ old('it_internal_memory') }}"
                            placeholder="e.g. 256 GB SSD"
                        >


                        @error('it_internal_memory')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="it_connectivity"
                            class="form-label"
                        >

                            Connectivity

                        </label>


                        <select
                            name="it_connectivity"
                            id="it_connectivity"
                            class="form-select @error('it_connectivity') is-invalid @enderror"
                        >

                            <option value="">
                                Select Connectivity
                            </option>

                            <option
                                value="Wifi Only"
                                {{ old('it_connectivity') === 'Wifi Only' ? 'selected' : '' }}
                            >
                                Wifi Only
                            </option>

                            <option
                                value="E-SIM"
                                {{ old('it_connectivity') === 'E-SIM' ? 'selected' : '' }}
                            >
                                E-SIM
                            </option>

                            <option
                                value="Ethernet"
                                {{ old('it_connectivity') === 'Ethernet' ? 'selected' : '' }}
                            >
                                Ethernet
                            </option>

                        </select>


                        @error('it_connectivity')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="it_os"
                            class="form-label"
                        >

                            Operating System

                        </label>


                        <input
                            type="text"
                            name="it_os"
                            id="it_os"
                            class="form-control @error('it_os') is-invalid @enderror"
                            value="{{ old('it_os') }}"
                            placeholder="e.g. Windows 11 Pro"
                        >


                        @error('it_os')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-12">

                        <label
                            for="it_recommendation_details"
                            class="form-label"
                        >

                            IT Recommendation Details

                        </label>


                        <textarea
                            name="it_recommendation_details"
                            id="it_recommendation_details"
                            class="form-control @error('it_recommendation_details') is-invalid @enderror"
                            placeholder="Enter additional IT requirements or recommendations."
                        >{{ old('it_recommendation_details') }}</textarea>


                        @error('it_recommendation_details')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FORM ACTION --}}
        {{-- ========================================================= --}}

        <div class="form-actions">

            <a
                href="{{ route('user.dashboard') }}"
                class="btn-cancel"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="btn-submit"
            >

                <i class="bi bi-send me-2"></i>

                Submit USR

            </button>

        </div>

    </form>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       ELEMENTS
    ========================================================= */

    const departmentSelect =
        document.getElementById('department');

    const approverDisplay =
        document.getElementById('approverDisplay');

    const capexSection =
        document.getElementById('capexSection');

    const itSection =
        document.getElementById('itSection');

    const supplierSection =
        document.getElementById('supplierSection');

    const slaSection =
        document.getElementById('slaSection');

    const supplierInputs = [
        document.getElementById('reference_supplier'),
        document.getElementById('supplier_contact_person'),
        document.getElementById('supplier_contact')
    ];

    const supplierRequired =
        document.querySelectorAll('.supplier-required');

    const slaDate =
        document.getElementById('procurement_sla_date');

    const slaRequired =
        document.querySelector('.sla-required');

    const capexBudgetNumber =
        document.getElementById('capex_budget_number');

    const capexLayoutFile =
        document.getElementById('capex_layout_file');


    /* =========================================================
       PRICE ELEMENTS
    ========================================================= */

    const quantityInput =
        document.getElementById('quantity');

    const currencyInput =
        document.getElementById('currency');

    const unitPriceDisplay =
        document.getElementById('unit_price_display');

    const unitPriceInput =
        document.getElementById('unit_price');

    const amountActualInput =
        document.getElementById('amount_actual');

    const amountValueDisplay =
        document.getElementById('amountValueDisplay');

    const amountCurrencyDisplay =
        document.getElementById('amountCurrencyDisplay');


    /* =========================================================
       APPROVER MAPPING
    ========================================================= */

    const approverMapping =
        @json($approverMapping);


    function updateApprover() {

        const department =
            departmentSelect.value;

        if (!department) {

            approverDisplay.innerHTML =
                'Approval person will be assigned automatically.';

            return;
        }

        const approver =
            approverMapping[department];

        if (approver) {

            approverDisplay.innerHTML =
                '<i class="bi bi-person-check me-1"></i>' +
                approver;

        } else {

            approverDisplay.innerHTML =
                '<span style="color:#dc3545;">' +
                'Approval person has not been configured yet.' +
                '</span>';

        }

    }


    /* =========================================================
       DEPARTMENT CONDITIONAL FIELDS
    ========================================================= */

    function updateDepartmentFields() {

        const department =
            departmentSelect.value;


        /* CAPEX */

        if (department === 'CAPEX Project') {

            capexSection.style.display = 'block';

            capexBudgetNumber.required = true;

            capexLayoutFile.required = true;

        } else {

            capexSection.style.display = 'none';

            capexBudgetNumber.required = false;

            capexLayoutFile.required = false;

            capexBudgetNumber.value = '';

            capexLayoutFile.value = '';

        }


        /* IT */

        if (department === 'IT') {

            itSection.style.display = 'block';

        } else {

            itSection.style.display = 'none';

            document.getElementById('it_ram').value = '';

            document.getElementById('it_internal_memory').value = '';

            document.getElementById('it_connectivity').value = '';

            document.getElementById('it_os').value = '';

            document.getElementById('it_recommendation_details').value = '';

        }

    }


    /* =========================================================
       SUPPLIER CONDITIONAL FIELDS
    ========================================================= */

    function updateSupplierFields() {

        const selected =
            document.querySelector(
                'input[name="supplier_recommendation"]:checked'
            );


        if (!selected) {

            supplierSection.style.display = 'none';

            slaSection.style.display = 'none';

            supplierInputs.forEach(function (input) {

                if (input) {
                    input.required = false;
                }

            });

            if (slaDate) {
                slaDate.required = false;
            }

            supplierRequired.forEach(function (item) {
                item.style.display = 'none';
            });

            if (slaRequired) {
                slaRequired.style.display = 'none';
            }

            return;
        }


        /* PUNYA REKOMENDASI */

        if (selected.value === 'Punya Rekomendasi') {

            supplierSection.style.display = 'block';

            slaSection.style.display = 'none';


            supplierInputs.forEach(function (input) {

                if (input) {
                    input.required = true;
                }

            });


            if (slaDate) {

                slaDate.required = false;
                slaDate.value = '';

            }


            supplierRequired.forEach(function (item) {
                item.style.display = 'inline';
            });


            if (slaRequired) {
                slaRequired.style.display = 'none';
            }

        }


        /* TIDAK PUNYA REKOMENDASI */

        else {

            supplierSection.style.display = 'none';

            slaSection.style.display = 'block';


            supplierInputs.forEach(function (input) {

                if (input) {

                    input.required = false;
                    input.value = '';

                }

            });


            if (slaDate) {
                slaDate.required = true;
            }


            supplierRequired.forEach(function (item) {
                item.style.display = 'none';
            });


            if (slaRequired) {
                slaRequired.style.display = 'inline';
            }

        }

    }


    /* =========================================================
       FORMAT NUMBER
    ========================================================= */

    function formatNumber(value) {

        if (
            value === null ||
            value === undefined ||
            value === ''
        ) {
            return '';
        }

        const number =
            Number(value);

        if (!Number.isFinite(number)) {
            return '';
        }

        return new Intl.NumberFormat('id-ID', {
            maximumFractionDigits: 0
        }).format(number);

    }


    /* =========================================================
       GET CLEAN NUMBER
    ========================================================= */

    function getCleanNumber(value) {

        if (
            value === null ||
            value === undefined ||
            value === ''
        ) {
            return 0;
        }

        const cleaned =
            String(value)
                .replace(/\./g, '')
                .replace(/[^\d]/g, '');

        return parseInt(cleaned, 10) || 0;

    }


    /* =========================================================
       UPDATE AMOUNT ACTUAL
    ========================================================= */

    function updateAmountActual() {

        const quantity =
            parseFloat(quantityInput.value) || 0;

        const unitPrice =
            getCleanNumber(unitPriceDisplay.value);

        const currency =
            currencyInput.value;


        const amount =
            quantity * unitPrice;


        /* =====================================================
           STORE CLEAN UNIT PRICE
        ===================================================== */

        unitPriceInput.value =
            unitPrice > 0
                ? unitPrice
                : '';


        /* =====================================================
           STORE AMOUNT ACTUAL
        ===================================================== */

        amountActualInput.value =
            amount > 0
                ? amount
                : '';


        /* =====================================================
           CURRENCY
        ===================================================== */

        if (currency) {

            amountCurrencyDisplay.textContent =
                currency;

        } else {

            amountCurrencyDisplay.textContent =
                '-';

        }


        /* =====================================================
           AMOUNT DISPLAY
        ===================================================== */

        amountValueDisplay.textContent =
            amount > 0
                ? formatNumber(amount)
                : '0';

    }


    /* =========================================================
       UNIT PRICE INPUT
    ========================================================= */

    unitPriceDisplay.addEventListener(
        'input',
        function () {

            let value =
                this.value.replace(/[^\d]/g, '');


            if (value === '') {

                this.value = '';

                unitPriceInput.value = '';

                updateAmountActual();

                return;

            }


            const number =
                parseInt(value, 10);


            this.value =
                new Intl.NumberFormat('id-ID', {
                    maximumFractionDigits: 0
                }).format(number);


            unitPriceInput.value =
                number;


            updateAmountActual();

        }
    );


    /* =========================================================
       QUANTITY
    ========================================================= */

    quantityInput.addEventListener(
        'input',
        updateAmountActual
    );


    /* =========================================================
       CURRENCY
    ========================================================= */

    currencyInput.addEventListener(
        'change',
        updateAmountActual
    );


    /* =========================================================
       BEFORE SUBMIT
    ========================================================= */

    document
        .getElementById('eursForm')
        .addEventListener(
            'submit',
            function () {

                /*
                 * Pastikan Unit Price yang dikirim ke Laravel
                 * adalah angka tanpa titik.
                 */

                const cleanPrice =
                    getCleanNumber(
                        unitPriceDisplay.value
                    );


                unitPriceInput.value =
                    cleanPrice > 0
                        ? cleanPrice
                        : '';


                const quantity =
                    parseFloat(
                        quantityInput.value
                    ) || 0;


                const amount =
                    quantity * cleanPrice;


                amountActualInput.value =
                    amount > 0
                        ? amount
                        : '';

            }
        );


    /* =========================================================
       DEPARTMENT EVENT
    ========================================================= */

    departmentSelect.addEventListener(
        'change',
        function () {

            updateApprover();

            updateDepartmentFields();

        }
    );


    /* =========================================================
       SUPPLIER EVENT
    ========================================================= */

    document
        .querySelectorAll(
            'input[name="supplier_recommendation"]'
        )
        .forEach(function (radio) {

            radio.addEventListener(
                'change',
                updateSupplierFields
            );

        });


    /* =========================================================
       INITIAL LOAD
    ========================================================= */

    updateApprover();

    updateDepartmentFields();

    updateSupplierFields();

    updateAmountActual();

});

</script>

@endsection