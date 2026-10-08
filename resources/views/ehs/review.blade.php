@extends('layouts.app')

@section('title', 'E-URS | EHS Review')

@section('page-title', 'EHS Review')

@section('page-description', 'Review E-URS details, EHS assessment, and supporting documents')

@section('content')

<style>
    /* =========================================================
       EHS REVIEW PAGE - versi dirapikan
       Ganti seluruh blok <style> lama dengan blok ini.
       Nama class sama persis, jadi markup tidak wajib diubah.
    ========================================================= */

    .ehs-review-page {
        --ehs-primary: #0879bd;
        --ehs-primary-dark: #06689f;
        --ehs-primary-soft: #eaf6fd;
        --ehs-text: #1f2a3a;
        --ehs-text-2: #4a5568;
        --ehs-muted: #6b7686;
        --ehs-border: #e3eaf0;
        --ehs-surface: #ffffff;
        --ehs-surface-2: #f7fafc;
        --ehs-success: #1d7a4d;
        --ehs-success-soft: #e7f6ee;
        --ehs-danger: #c0392b;
        --ehs-danger-soft: #fdecea;
        --ehs-warning: #a96a0b;
        --ehs-warning-soft: #fff4de;

        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        padding-bottom: 96px;
        font-size: 14px;
        line-height: 1.6;
        color: var(--ehs-text);
    }

    /* ---------- HEADER ---------- */

    .ehs-review-header {
        background: var(--ehs-surface);
        border: 1px solid var(--ehs-border);
        border-radius: 14px;
        padding: 20px 24px;
        margin-bottom: 16px;
    }

    .ehs-review-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .ehs-review-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .ehs-review-heading-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--ehs-primary-soft);
        color: var(--ehs-primary);
        font-size: 20px;
    }

    .ehs-review-title {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 2px;
    }

    .ehs-review-subtitle {
        color: var(--ehs-muted);
        font-size: 13px;
    }

    .ehs-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .ehs-back-btn,
    .ehs-pdf-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background .15s, border-color .15s, color .15s;
        white-space: nowrap;
    }

    .ehs-back-btn {
        background: var(--ehs-surface);
        border: 1px solid var(--ehs-border);
        color: var(--ehs-text-2);
    }

    .ehs-back-btn:hover {
        background: var(--ehs-primary-soft);
        border-color: #bfe3f5;
        color: var(--ehs-primary);
    }

    .ehs-pdf-btn {
        background: var(--ehs-primary);
        border: 1px solid var(--ehs-primary);
        color: #fff;
    }

    .ehs-pdf-btn:hover {
        background: var(--ehs-primary-dark);
        border-color: var(--ehs-primary-dark);
        color: #fff;
    }

    .ehs-back-btn:focus-visible,
    .ehs-pdf-btn:focus-visible,
    .ehs-pdf-action:focus-visible,
    .ehs-btn:focus-visible {
        outline: 3px solid rgba(8, 121, 189, .35);
        outline-offset: 2px;
    }

    /* ---------- ALERT ---------- */

    .ehs-alert {
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .ehs-alert ul {
        padding-left: 20px;
    }

    /* ---------- STATUS ---------- */

    .ehs-status-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 20px;
        margin-bottom: 16px;
        border-radius: 12px;
        background: var(--ehs-surface);
        border: 1px solid var(--ehs-border);
    }

    .ehs-status-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .ehs-status-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--ehs-primary-soft);
        color: var(--ehs-primary);
        font-size: 17px;
    }

    .ehs-status-label {
        color: var(--ehs-muted);
        font-size: 12px;
        font-weight: 500;
    }

    .ehs-status-value {
        font-size: 15px;
        font-weight: 700;
        line-height: 1.3;
    }

    .ehs-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .ehs-status-badge.pending   { background: var(--ehs-warning-soft); color: var(--ehs-warning); }
    .ehs-status-badge.in-review { background: var(--ehs-primary-soft); color: var(--ehs-primary); }
    .ehs-status-badge.approved  { background: var(--ehs-success-soft); color: var(--ehs-success); }
    .ehs-status-badge.rejected  { background: var(--ehs-danger-soft);  color: var(--ehs-danger); }

    /* ---------- CARD ---------- */

    .ehs-review-card {
        background: var(--ehs-surface);
        border: 1px solid var(--ehs-border);
        border-radius: 14px;
        margin-bottom: 16px;
        overflow: hidden;
    }

    .ehs-review-card-header {
        padding: 14px 22px;
        border-bottom: 1px solid var(--ehs-border);
        background: var(--ehs-surface-2);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ehs-review-card-header i {
        color: var(--ehs-primary);
        font-size: 17px;
    }

    .ehs-review-card-title {
        font-size: 15px;
        font-weight: 700;
    }

    .ehs-review-card-body {
        padding: 22px;
    }

    /* ---------- INFO & DETAIL (label di atas, nilai di bawah, tanpa kotak) ---------- */

    .ehs-info-grid-review {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .ehs-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .ehs-info-item,
    .ehs-detail-item {
        min-width: 0;
        padding: 0;
        background: none;
        border: none;
    }

    .ehs-detail-item.full {
        grid-column: 1 / -1;
    }

    /* Item "full" diberi pemisah tipis agar blok panjang mudah dibedakan */
    .ehs-detail-item.full {
        padding-top: 18px;
        border-top: 1px dashed var(--ehs-border);
    }

    .ehs-info-label,
    .ehs-detail-label {
        color: var(--ehs-muted);
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .ehs-info-value,
    .ehs-detail-value {
        color: var(--ehs-text);
        font-size: 14px;
        line-height: 1.65;
        word-break: break-word;
    }

    .ehs-info-value { font-weight: 600; }

    .ehs-detail-value { white-space: pre-line; }

    .ehs-detail-value strong {
        color: var(--ehs-text-2);
        font-weight: 600;
    }

    /* ---------- PDF ---------- */

    .ehs-pdf-wrapper {
        background: var(--ehs-surface-2);
        border: 1px solid var(--ehs-border);
        border-radius: 12px;
        padding: 14px;
    }

    .ehs-pdf-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .ehs-pdf-toolbar-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .ehs-pdf-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--ehs-danger-soft);
        color: var(--ehs-danger);
        font-size: 18px;
    }

    .ehs-pdf-title {
        font-size: 14px;
        font-weight: 700;
    }

    .ehs-pdf-description {
        color: var(--ehs-muted);
        font-size: 12px;
    }

    .ehs-pdf-actions {
        display: flex;
        gap: 8px;
    }

    .ehs-pdf-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 8px;
        background: var(--ehs-surface);
        border: 1px solid var(--ehs-border);
        color: var(--ehs-text-2);
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .ehs-pdf-action:hover {
        background: var(--ehs-primary-soft);
        border-color: #bfe3f5;
        color: var(--ehs-primary);
    }

    .ehs-pdf-frame-wrapper {
        width: 100%;
        height: 720px;
        background: #fff;
        border: 1px solid var(--ehs-border);
        border-radius: 8px;
        overflow: hidden;
    }

    .ehs-pdf-frame {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }

    /* ---------- NOTES ---------- */

    .ehs-previous-note {
        padding: 14px 16px;
        border-radius: 10px;
        background: var(--ehs-surface-2);
        border: 1px solid var(--ehs-border);
        border-left: 4px solid var(--ehs-primary);
        color: var(--ehs-text-2);
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
        word-break: break-word;
    }

    /* ---------- ASSESSMENT ---------- */

    .ehs-assessment-intro {
        padding: 12px 16px;
        margin-bottom: 18px;
        border-radius: 10px;
        background: var(--ehs-primary-soft);
        color: #35607a;
        font-size: 13px;
        line-height: 1.6;
    }

    .ehs-assessment-intro strong { color: var(--ehs-primary); }

    /* Satu kolom: pertanyaan di kiri, pilihan Yes/No di kanan */
    .ehs-assessment-grid {
        display: flex;
        flex-direction: column;
        border: 1px solid var(--ehs-border);
        border-radius: 12px;
        overflow: hidden;
    }

    .ehs-assessment-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 18px;
        background: var(--ehs-surface);
        border: none;
        border-bottom: 1px solid var(--ehs-border);
        border-radius: 0;
    }

    .ehs-assessment-item:last-child { border-bottom: none; }

    .ehs-assessment-item:nth-child(even) { background: var(--ehs-surface-2); }

    .ehs-assessment-question {
        flex: 1;
        min-height: 0;
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.45;
        color: var(--ehs-text);
    }

    /* Yes / No bergaya segmented control */
    .ehs-radio-group {
        display: inline-flex;
        gap: 0;
        padding: 3px;
        border-radius: 9px;
        background: #eef2f6;
        flex-shrink: 0;
    }

    .ehs-radio-option { flex: none; }

    .ehs-radio-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .ehs-radio-option label {
        min-width: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 7px 14px;
        border-radius: 7px;
        border: 1px solid transparent;
        background: transparent;
        color: var(--ehs-muted);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s;
    }

    .ehs-radio-option label:hover { color: var(--ehs-text); }

    .ehs-radio-option input:focus-visible + label {
        outline: 3px solid rgba(8, 121, 189, .35);
    }

    /* Yes = hijau, No = abu gelap, supaya pilihan langsung terbaca */
    .ehs-radio-option input[value="Yes"]:checked + label {
        background: var(--ehs-success);
        color: #fff;
    }

    .ehs-radio-option input[value="No"]:checked + label {
        background: #556070;
        color: #fff;
    }

    /* ---------- FORM ---------- */

    .ehs-form-group { margin-top: 22px; }

    .ehs-form-label {
        display: block;
        color: var(--ehs-text);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ehs-form-label i {
        color: var(--ehs-primary);
        margin-right: 5px;
    }

    .ehs-form-control {
        width: 100%;
        border: 1px solid #cfd9e2;
        border-radius: 10px;
        padding: 11px 14px;
        color: var(--ehs-text);
        font-size: 14px;
        line-height: 1.6;
        background: #fff;
        resize: vertical;
    }

    .ehs-form-control::placeholder { color: #98a3b1; }

    .ehs-form-control:focus {
        outline: none;
        border-color: var(--ehs-primary);
        box-shadow: 0 0 0 3px rgba(8, 121, 189, .15);
    }

    .ehs-form-help {
        margin-top: 6px;
        color: var(--ehs-muted);
        font-size: 12px;
    }

    /* ---------- UPLOAD ---------- */

    .ehs-upload-wrapper { margin-top: 22px; }

    .ehs-upload-box {
        border: 1.5px dashed #a9d6ec;
        border-radius: 12px;
        background: #f6fbfe;
        padding: 16px 18px;
    }

    .ehs-upload-content {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .ehs-upload-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #dff1fb;
        color: var(--ehs-primary);
        font-size: 20px;
    }

    .ehs-upload-title {
        font-size: 14px;
        font-weight: 700;
    }

    .ehs-upload-description {
        color: var(--ehs-muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .ehs-upload-input {
        width: 100%;
        margin-top: 12px;
        padding: 9px 10px;
        border: 1px solid #cfd9e2;
        border-radius: 8px;
        background: #fff;
        color: var(--ehs-text-2);
        font-size: 13px;
    }

    .ehs-upload-help {
        margin-top: 7px;
        color: var(--ehs-muted);
        font-size: 12px;
    }

    .ehs-upload-existing {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 10px;
        padding: 8px 12px;
        border-radius: 8px;
        background: var(--ehs-primary-soft);
        border: 1px solid #cfe9f6;
        color: var(--ehs-primary);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .ehs-upload-existing:hover {
        background: var(--ehs-primary);
        color: #fff;
    }

    /* ---------- FORWARD INFO ---------- */

    .ehs-forward-box {
        margin-top: 22px;
        padding: 12px 16px;
        border-radius: 10px;
        background: var(--ehs-primary-soft);
        color: #35607a;
        font-size: 13px;
        line-height: 1.6;
    }

    .ehs-forward-box strong { color: var(--ehs-primary); }

    /* ---------- ACTION (menempel di bawah layar agar selalu terjangkau) ---------- */

    .ehs-action-wrapper {
        position: sticky;
        bottom: 0;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin: 24px -22px -22px;
        padding: 14px 22px;
        background: rgba(255, 255, 255, .96);
        backdrop-filter: blur(6px);
        border-top: 1px solid var(--ehs-border);
    }

    .ehs-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 20px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 700;
        border: 1px solid transparent;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
    }

    .ehs-btn-approve {
        background: var(--ehs-primary);
        color: #fff;
    }

    .ehs-btn-approve:hover {
        background: var(--ehs-primary-dark);
        color: #fff;
    }

    .ehs-btn-reject {
        background: #fff;
        border-color: #efc5c0;
        color: var(--ehs-danger);
    }

    .ehs-btn-reject:hover {
        background: var(--ehs-danger);
        border-color: var(--ehs-danger);
        color: #fff;
    }

    /* ---------- COMPLETED ---------- */

    .ehs-completed-box {
        padding: 16px 18px;
        border-radius: 12px;
        background: var(--ehs-surface-2);
        border: 1px solid var(--ehs-border);
    }

    .ehs-completed-header {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .ehs-completed-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--ehs-success-soft);
        color: var(--ehs-success);
        font-size: 20px;
    }

    .ehs-completed-icon.rejected {
        background: var(--ehs-danger-soft);
        color: var(--ehs-danger);
    }

    .ehs-completed-title {
        font-size: 15px;
        font-weight: 700;
    }

    .ehs-completed-text {
        color: var(--ehs-muted);
        font-size: 13px;
    }

    /* ---------- MODAL ---------- */

    .ehs-modal-title {
        font-size: 17px;
        font-weight: 700;
    }

    .ehs-modal-text {
        color: var(--ehs-muted);
        font-size: 14px;
        line-height: 1.6;
    }

    /* ---------- RESPONSIVE ---------- */

    @media (max-width: 992px) {
        .ehs-info-grid-review { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .ehs-pdf-frame-wrapper { height: 640px; }
    }

    @media (max-width: 768px) {
        .ehs-review-header-content { flex-direction: column; align-items: flex-start; }
        .ehs-header-actions { width: 100%; }
        .ehs-back-btn, .ehs-pdf-btn { flex: 1; }

        .ehs-info-grid-review,
        .ehs-detail-grid { grid-template-columns: 1fr; }
        .ehs-detail-item.full { grid-column: auto; }

        .ehs-status-box { flex-direction: column; align-items: flex-start; }

        .ehs-pdf-toolbar { flex-direction: column; align-items: flex-start; }
        .ehs-pdf-actions { width: 100%; }
        .ehs-pdf-action { flex: 1; justify-content: center; }
        .ehs-pdf-frame-wrapper { height: 520px; }

        .ehs-assessment-item { flex-direction: column; align-items: stretch; }
        .ehs-radio-group { width: 100%; }
        .ehs-radio-option { flex: 1; }

        .ehs-action-wrapper { flex-direction: column-reverse; align-items: stretch; }
        .ehs-btn { width: 100%; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ehs-review-page * { transition: none !important; }
    }

    /* ---------- PDF COLLAPSIBLE ---------- */

    .ehs-collapsible > summary {
        list-style: none;
        cursor: pointer;
        user-select: none;
    }

    .ehs-collapsible > summary::-webkit-details-marker { display: none; }

    .ehs-collapsible > summary .ehs-review-card-title { flex: 1; }

    .ehs-collapsible > summary:hover { background: #f0f6fa; }

    .ehs-collapsible > summary:focus-visible {
        outline: 3px solid rgba(8, 121, 189, .35);
        outline-offset: -3px;
    }

    .ehs-chevron {
        color: var(--ehs-muted) !important;
        font-size: 14px !important;
        transition: transform .2s ease;
    }

    .ehs-collapsible[open] > summary { border-bottom: 1px solid var(--ehs-border); }
    .ehs-collapsible:not([open]) > summary { border-bottom: none; }
    .ehs-collapsible[open] .ehs-chevron { transform: rotate(180deg); }
</style>

@php
    $ehsStatus = strtolower(trim($eurs->ehs_status ?? 'pending'));
    $isDone    = in_array($ehsStatus, ['approved', 'completed', 'rejected']);
    $isApproved = in_array($ehsStatus, ['approved', 'completed']);

    $statusClass = match ($ehsStatus) {
        'approved', 'completed' => 'approved',
        'rejected'              => 'rejected',
        'in_review', 'review'   => 'in-review',
        default                 => 'pending',
    };

    $statusText = match ($ehsStatus) {
        'approved', 'completed' => 'Approved by EHS',
        'rejected'              => 'Rejected by EHS',
        'in_review', 'review'   => 'In Review',
        default                 => 'Pending EHS Review',
    };

    $assessments = [
        'ppe'      => '1. APD / PPE',
        'hazard'   => '2. Alcohol / Explosive / Flammable / Combustible',
        'asbestos' => '3. Asbestos Containing Material',
        'ods'      => '4. ODS',
        'toxic'    => '5. Toxic Materials / Pesticides / Sanitation',
        'chemical' => '6. Raw Material / New Chemical with MSDS',
    ];

    $pdfUrl = route('ehs.pdf', ['eurs' => $eurs->id]);
@endphp

<div class="ehs-review-page">

    {{-- ================= HEADER ================= --}}
    <div class="ehs-review-header">
        <div class="ehs-review-header-content">
            <div class="ehs-review-heading">
                <div class="ehs-review-heading-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>
                <div>
                    <div class="ehs-review-title">Review User Requirement Specification</div>
                    <div class="ehs-review-subtitle">Review the complete E-URS information and EHS assessment.</div>
                </div>
            </div>

            <div class="ehs-header-actions">
                <a href="{{ route('ehs.dashboard') }}" class="ehs-back-btn">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
                <a href="{{ $pdfUrl }}" target="_blank" class="ehs-pdf-btn">
                    <i class="bi bi-file-earmark-pdf"></i> Open PDF
                </a>
            </div>
        </div>
    </div>

    {{-- ================= ERROR ================= --}}
    @if ($errors->any())
        <div class="alert alert-danger ehs-alert">
            <strong>Please correct the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= STATUS ================= --}}
    <div class="ehs-status-box">
        <div class="ehs-status-left">
            <div class="ehs-status-icon"><i class="bi bi-activity"></i></div>
            <div>
                <div class="ehs-status-label">E-URS Status</div>
                <div class="ehs-status-value">{{ $eurs->request_number ?? '-' }}</div>
            </div>
        </div>

        <span class="ehs-status-badge {{ $statusClass }}">
            @if ($isApproved)
                <i class="bi bi-check-circle"></i>
            @elseif ($ehsStatus === 'rejected')
                <i class="bi bi-x-circle"></i>
            @elseif (in_array($ehsStatus, ['in_review', 'review']))
                <i class="bi bi-hourglass-split"></i>
            @else
                <i class="bi bi-clock"></i>
            @endif
            {{ $statusText }}
        </span>
    </div>

    {{-- ================= REQUEST INFORMATION ================= --}}
    <div class="ehs-review-card">
        <div class="ehs-review-card-header">
            <i class="bi bi-file-earmark-text"></i>
            <div class="ehs-review-card-title">Request Information</div>
        </div>

        <div class="ehs-review-card-body">
            <div class="ehs-info-grid-review">

                <div class="ehs-info-item">
                    <div class="ehs-info-label">Request Number</div>
                    <div class="ehs-info-value">{{ $eurs->request_number ?? '-' }}</div>
                </div>

                <div class="ehs-info-item">
                    <div class="ehs-info-label">Requestor</div>
                    <div class="ehs-info-value">{{ $eurs->user->name ?? '-' }}</div>
                </div>

                <div class="ehs-info-item">
                    <div class="ehs-info-label">Department</div>
                    <div class="ehs-info-value">{{ $eurs->department ?? '-' }}</div>
                </div>

                <div class="ehs-info-item">
                    <div class="ehs-info-label">Requestor Email</div>
                    <div class="ehs-info-value">{{ $eurs->user->email ?? '-' }}</div>
                </div>

                <div class="ehs-info-item">
                    <div class="ehs-info-label">Submitted Date</div>
                    <div class="ehs-info-value">
                        @if ($eurs->submitted_at)
                            {{ \Carbon\Carbon::parse($eurs->submitted_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="ehs-info-item">
                    <div class="ehs-info-label">Current Status</div>
                    <div class="ehs-info-value">{{ ucwords(str_replace('_', ' ', $eurs->status ?? '-')) }}</div>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= REQUIREMENT & SPECIFICATION ================= --}}
    <div class="ehs-review-card">
        <div class="ehs-review-card-header">
            <i class="bi bi-list-check"></i>
            <div class="ehs-review-card-title">Requirement &amp; Specification</div>
        </div>

        <div class="ehs-review-card-body">
            <div class="ehs-detail-grid">

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Item / Service Name</div>
                    <div class="ehs-detail-value">{{ $eurs->item_service_name ?? '-' }}</div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Quantity</div>
                    <div class="ehs-detail-value">{{ $eurs->quantity ?? '-' }} {{ $eurs->unit ?? '' }}</div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Expected Date of Delivery</div>
                    <div class="ehs-detail-value">
                        @if ($eurs->expected_date_of_delivery)
                            {{ \Carbon\Carbon::parse($eurs->expected_date_of_delivery)->format('d M Y') }}
                        @elseif ($eurs->expected_arrival_date)
                            {{ \Carbon\Carbon::parse($eurs->expected_arrival_date)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Brand</div>
                    <div class="ehs-detail-value">
                        <strong>Preferred:</strong> {{ $eurs->preferred_brand ?? $eurs->brand ?? '-' }}
                        @if ($eurs->alternative_brand)
                            <br><strong>Alternative:</strong> {{ $eurs->alternative_brand }}
                        @endif
                    </div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Supplier Recommendation</div>
                    <div class="ehs-detail-value">
                        {{ $eurs->supplier_recommendation ?? '-' }}
                        @if ($eurs->supplier_name)
                            <br><strong>Supplier:</strong> {{ $eurs->supplier_name }}
                        @endif
                        @if ($eurs->supplier_contact_person)
                            <br><strong>Contact Person:</strong> {{ $eurs->supplier_contact_person }}
                        @endif
                        @if ($eurs->supplier_contact)
                            <br><strong>Contact:</strong> {{ $eurs->supplier_contact }}
                        @endif
                    </div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Procurement SLA Target</div>
                    <div class="ehs-detail-value">
                        @if (($eurs->supplier_recommendation ?? '') === 'Tidak Punya Rekomendasi' && $eurs->procurement_sla_date)
                            {{ \Carbon\Carbon::parse($eurs->procurement_sla_date)->format('d M Y') }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">Reference of Supplier</div>
                    <div class="ehs-detail-value">{{ $eurs->reference_supplier ?? '-' }}</div>
                </div>

                <div class="ehs-detail-item">
                    <div class="ehs-detail-label">PR Amount Category</div>
                    <div class="ehs-detail-value">{{ $eurs->amount_category ?? '-' }}</div>
                </div>

                <div class="ehs-detail-item full">
                    <div class="ehs-detail-label">Requirement</div>
                    <div class="ehs-detail-value">{{ $eurs->requirement ?? $eurs->item_service_name ?? '-' }}</div>
                </div>

                <div class="ehs-detail-item full">
                    <div class="ehs-detail-label">Special Requirement</div>
                    <div class="ehs-detail-value">{{ $eurs->special_requirements ?? '-' }}</div>
                </div>

                <div class="ehs-detail-item full">
                    <div class="ehs-detail-label">Detail Specification</div>
                    <div class="ehs-detail-value">{{ $eurs->technical_description ?? '-' }}</div>
                </div>

                @if ($eurs->capex_budget_number || $eurs->capex_layout_file)
                    <div class="ehs-detail-item full">
                        <div class="ehs-detail-label">CAPEX Information</div>
                        <div class="ehs-detail-value">
                            @if ($eurs->capex_budget_number)
                                <strong>Budget Project Number:</strong> {{ $eurs->capex_budget_number }}
                            @endif
                            @if ($eurs->capex_layout_file)
                                <br><strong>Layout / Specification Attachment:</strong> {{ basename($eurs->capex_layout_file) }}
                            @endif
                        </div>
                    </div>
                @endif

                @if ($eurs->it_ram || $eurs->it_internal_memory || $eurs->it_connectivity || $eurs->it_os || $eurs->it_recommendation_details)
                    <div class="ehs-detail-item full">
                        <div class="ehs-detail-label">IT Requirement</div>
                        <div class="ehs-detail-value">
                            @if ($eurs->it_ram)
                                <strong>RAM:</strong> {{ $eurs->it_ram }}
                            @endif
                            @if ($eurs->it_internal_memory)
                                <br><strong>Internal Memory:</strong> {{ $eurs->it_internal_memory }}
                            @endif
                            @if ($eurs->it_connectivity)
                                <br><strong>Connectivity:</strong> {{ $eurs->it_connectivity }}
                            @endif
                            @if ($eurs->it_os)
                                <br><strong>Operating System:</strong> {{ $eurs->it_os }}
                            @endif
                            @if ($eurs->it_recommendation_details)
                                <br><strong>Recommendation Details:</strong> {{ $eurs->it_recommendation_details }}
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- ================= PDF PREVIEW (bisa dilipat) ================= --}}
    <details class="ehs-review-card ehs-collapsible" open>
        <summary class="ehs-review-card-header">
            <i class="bi bi-file-earmark-pdf"></i>
            <div class="ehs-review-card-title">E-URS PDF</div>
            <i class="bi bi-chevron-down ehs-chevron"></i>
        </summary>

        <div class="ehs-review-card-body">
            <div class="ehs-pdf-wrapper">

                <div class="ehs-pdf-toolbar">
                    <div class="ehs-pdf-toolbar-left">
                        <div class="ehs-pdf-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                        <div>
                            <div class="ehs-pdf-title">User Requirement Specification</div>
                            <div class="ehs-pdf-description">Review the generated E-URS document before completing the EHS assessment.</div>
                        </div>
                    </div>

                    <div class="ehs-pdf-actions">
                        <a href="{{ $pdfUrl }}" target="_blank" class="ehs-pdf-action">
                            <i class="bi bi-box-arrow-up-right"></i> Open
                        </a>
                        <a href="{{ $pdfUrl }}" class="ehs-pdf-action" download>
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div>

                <div class="ehs-pdf-frame-wrapper">
                    <iframe src="{{ $pdfUrl }}" class="ehs-pdf-frame" title="E-URS PDF Preview"></iframe>
                </div>

            </div>
        </div>
    </details>

    {{-- ================= EXISTING EHS NOTES (hanya saat belum selesai) ================= --}}
    {{-- Jika sudah selesai, catatan ditampilkan di kartu Assessment agar tidak dobel --}}
    @if (!empty($eurs->ehs_notes) && !$isDone)
        <div class="ehs-review-card">
            <div class="ehs-review-card-header">
                <i class="bi bi-chat-left-text"></i>
                <div class="ehs-review-card-title">EHS Review Notes</div>
            </div>
            <div class="ehs-review-card-body">
                <div class="ehs-previous-note">{{ $eurs->ehs_notes }}</div>
            </div>
        </div>
    @endif

    {{-- ================= EHS ASSESSMENT ================= --}}
    <div class="ehs-review-card">
        <div class="ehs-review-card-header">
            <i class="bi bi-shield-check"></i>
            <div class="ehs-review-card-title">EHS Assessment</div>
        </div>

        <div class="ehs-review-card-body">

            @if ($isDone)

                {{-- ---------- READ ONLY ---------- --}}
                <div class="ehs-completed-box">
                    <div class="ehs-completed-header">
                        <div class="ehs-completed-icon {{ $ehsStatus === 'rejected' ? 'rejected' : '' }}">
                            <i class="bi {{ $isApproved ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                        </div>
                        <div>
                            <div class="ehs-completed-title">
                                {{ $isApproved ? 'EHS Assessment Approved' : 'EHS Assessment Rejected' }}
                            </div>
                            <div class="ehs-completed-text">
                                Reviewed on:
                                @if ($eurs->ehs_reviewed_at)
                                    {{ \Carbon\Carbon::parse($eurs->ehs_reviewed_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ehs-form-group">
                    <div class="ehs-form-label">
                        <i class="bi bi-chat-left-text"></i> EHS Recommendation / Notes
                    </div>
                    <div class="ehs-previous-note">{{ $eurs->ehs_notes ?? '-' }}</div>
                </div>

                @if (!empty($eurs->ehs_attachment))
                    <div class="ehs-form-group">
                        <div class="ehs-form-label">
                            <i class="bi bi-paperclip"></i> EHS Supporting Document
                        </div>
                        <a href="{{ asset('storage/' . $eurs->ehs_attachment) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="ehs-upload-existing">
                            <i class="bi bi-file-earmark-text"></i> View EHS Supporting Document
                        </a>
                    </div>
                @endif

                <div class="ehs-forward-box">
                    <i class="bi bi-info-circle me-1"></i>
                    This E-URS has already been processed by EHS. The assessment is displayed as read-only.
                </div>

            @else

                {{-- ---------- ACTIVE REVIEW ---------- --}}
                <div class="ehs-assessment-intro">
                    <strong>EHS Assessment:</strong>
                    Please review each category below based on the item/service requested.
                    Select <strong>Yes</strong> when the category is applicable and
                    <strong>No</strong> when it is not applicable.
                </div>

                <form id="approveForm"
                      action="{{ route('ehs.approve', ['eurs' => $eurs->id]) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="ehs-assessment-grid">
                        @foreach ($assessments as $key => $label)
                            <div class="ehs-assessment-item">
                                <div class="ehs-assessment-question">{{ $label }}</div>

                                <div class="ehs-radio-group">
                                    @foreach (['Yes', 'No'] as $option)
                                        <div class="ehs-radio-option">
                                            <input type="radio"
                                                   name="assessment_{{ $key }}"
                                                   id="{{ $key }}_{{ strtolower($option) }}"
                                                   value="{{ $option }}"
                                                   {{ old('assessment_' . $key) === $option ? 'checked' : '' }}
                                                   required>
                                            <label for="{{ $key }}_{{ strtolower($option) }}">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- EHS NOTES --}}
                    <div class="ehs-form-group">
                        <label for="ehs_notes" class="ehs-form-label">
                            <i class="bi bi-chat-left-text"></i> EHS Recommendation / Notes
                        </label>

                        <textarea name="ehs_notes"
                                  id="ehs_notes"
                                  class="ehs-form-control"
                                  rows="5"
                                  placeholder="Enter EHS recommendation or additional notes...">{{ old('ehs_notes', $eurs->ehs_notes) }}</textarea>

                        <div class="ehs-form-help">
                            Provide any recommendation, condition, or additional EHS information related to this request.
                        </div>
                    </div>

                    {{-- UPLOAD --}}
                    <div class="ehs-upload-wrapper">
                        <label for="ehs_attachment" class="ehs-form-label">
                            <i class="bi bi-paperclip"></i> Upload EHS Supporting Document
                        </label>

                        <div class="ehs-upload-box">
                            <div class="ehs-upload-content">
                                <div class="ehs-upload-icon"><i class="bi bi-file-earmark-arrow-up"></i></div>
                                <div>
                                    <div class="ehs-upload-title">EHS Supporting Document</div>
                                    <div class="ehs-upload-description">
                                        Upload supporting documents such as MSDS, EHS assessment documents,
                                        or other relevant EHS documentation.
                                    </div>
                                </div>
                            </div>

                            <input type="file"
                                   name="ehs_attachment"
                                   id="ehs_attachment"
                                   class="ehs-upload-input"
                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">

                            <div class="ehs-upload-help">
                                Supported formats: PDF, JPG, JPEG, PNG, DOC, DOCX, XLS, XLSX. Maximum size: 10 MB.
                            </div>

                            @if (!empty($eurs->ehs_attachment))
                                <a href="{{ asset('storage/' . $eurs->ehs_attachment) }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="ehs-upload-existing">
                                    <i class="bi bi-file-earmark-text"></i> View Existing EHS Document
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- FORWARD INFO --}}
                    <div class="ehs-forward-box">
                        <i class="bi bi-info-circle me-1"></i>
                        After EHS approval, this E-URS will proceed to the
                        <strong>Approval Person / Department Head</strong> approval stage.
                    </div>

                    {{-- ACTION --}}
                    <div class="ehs-action-wrapper">
                        <button type="button"
                                class="ehs-btn ehs-btn-reject"
                                data-bs-toggle="modal"
                                data-bs-target="#rejectModal">
                            <i class="bi bi-x-circle"></i> Reject
                        </button>

                        <button type="submit" class="ehs-btn ehs-btn-approve">
                            <i class="bi bi-check-circle"></i> Approve EHS Assessment
                        </button>
                    </div>
                </form>

            @endif

        </div>
    </div>

</div>

{{-- ================= REJECT MODAL ================= --}}
@if (!$isDone)
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title ehs-modal-title" id="rejectModalLabel">Reject E-URS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('ehs.reject', ['eurs' => $eurs->id]) }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <p class="ehs-modal-text">
                            Please provide the reason or recommendation for rejecting this E-URS.
                        </p>

                        <label for="reject_ehs_notes" class="ehs-form-label">Rejection Reason</label>

                        <textarea name="ehs_notes"
                                  id="reject_ehs_notes"
                                  class="ehs-form-control"
                                  rows="5"
                                  required
                                  placeholder="Enter rejection reason..."></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-circle me-1"></i> Reject E-URS
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endif

@endsection