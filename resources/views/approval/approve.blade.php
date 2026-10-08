<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">\

    <title>USR Approval | PT Taisho Pharmaceutical Indonesia</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        body {
            background: #f4f9fd;
            font-family: Arial, Helvetica, sans-serif;
            color: #243447;
        }

        .topbar {
            background: linear-gradient(135deg, #75c9ed, #4da8d8);
            min-height: 80px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(50, 130, 170, 0.15);
        }

        .brand-title {
            color: white;
            font-weight: 700;
            font-size: 20px;
            margin: 0;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.85);
            font-size: 12px;
            margin: 2px 0 0;
        }

        .approval-wrapper {
            max-width: 1100px;
            margin: 45px auto;
        }

        .main-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(45, 105, 140, 0.10);
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(
                135deg,
                #e8f7ff,
                #f7fcff
            );
            padding: 30px;
            border-bottom: 1px solid #e5eef4;
        }

        .approval-icon {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: #d8f1ff;
            color: #2586b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .request-number {
            color: #2586b8;
            font-weight: 700;
        }

        .status-badge {
            background: #fff4d6;
            color: #956d00;
            border-radius: 30px;
            padding: 7px 14px;
            font-size: 12px;
            font-weight: 600;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #236d96;
            margin-bottom: 18px;
        }

        .section-title i {
            margin-right: 7px;
        }

        .info-box {
            background: #f8fbfd;
            border: 1px solid #e7f0f5;
            border-radius: 12px;
            padding: 15px;
            height: 100%;
        }

        .info-label {
            font-size: 11px;
            color: #78909c;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #263746;
            word-break: break-word;
        }

        .specification-box {
            background: #f8fbfd;
            border: 1px solid #e7f0f5;
            border-radius: 14px;
            padding: 20px;
            white-space: pre-line;
            line-height: 1.7;
            color: #445563;
        }

        .approval-footer {
            background: #f9fcfe;
            border-top: 1px solid #e7eef3;
            padding: 25px 30px;
        }

        .btn-approve {
            background: #35a66f;
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
        }

        .btn-approve:hover {
            background: #2d9161;
            color: white;
        }

        .btn-note {
            background: #f0ad4e;
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
        }

        .btn-note:hover {
            background: #dc963b;
            color: white;
        }

        .btn-reject {
            background: #dc5a67;
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
        }

        .btn-reject:hover {
            background: #c84855;
            color: white;
        }

        .modal-header {
            background: #eef9ff;
            border-bottom: 1px solid #dceef7;
        }

        .modal-title {
            color: #236d96;
            font-weight: 700;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
        }

        .security-note {
            font-size: 12px;
            color: #78909c;
            margin-top: 18px;
        }

        .footer {
            text-align: center;
            color: #90a4ae;
            font-size: 12px;
            margin: 25px 0 40px;
        }

        @media (max-width: 768px) {

            .approval-wrapper {
                margin: 20px 12px;
            }

            .card-header-custom {
                padding: 22px;
            }

            .approval-footer {
                padding: 22px;
            }

            .approval-footer .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .brand-title {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="container">
            <div>
                <div class="brand-title">
                    PT Taisho Pharmaceutical Indonesia Tbk
                </div>

                <div class="brand-subtitle">
                    User Specification Request Approval System
                </div>
            </div>
        </div>
    </div>


    <!-- MAIN -->
    <div class="container">

        <div class="approval-wrapper">

            <div class="main-card">

                <!-- HEADER -->
                <div class="card-header-custom">

                    <div class="approval-icon">
                        <i class="bi bi-file-earmark-check"></i>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">

                        <div>
                            <h3 class="fw-bold mb-2">
                                User Specification Request
                            </h3>

                            <div class="request-number">
                                {{ $eurs->request_number }}
                            </div>

                            <div class="text-muted mt-1">
                                Please review the request details before taking an approval action.
                            </div>
                        </div>

                        <div>
                            <span class="status-badge">
                                <i class="bi bi-clock me-1"></i>
                                Pending Approval
                            </span>
                        </div>

                    </div>

                </div>


                <!-- BODY -->
                <div class="p-4 p-md-5">

                    <!-- GENERAL INFORMATION -->
                    <div class="mb-5">

                        <div class="section-title">
                            <i class="bi bi-person-vcard"></i>
                            General Information
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Requester
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->user->name ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Requester Email
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->user->email ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Department
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->department ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Submission Date
                                    </div>

                                    <div class="info-value">

                                        @if($eurs->submitted_at)
                                            {{ \Carbon\Carbon::parse($eurs->submitted_at)->format('d F Y, H:i') }}
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- REQUEST DETAILS -->
                    <div class="mb-5">

                        <div class="section-title">
                            <i class="bi bi-box-seam"></i>
                            Requirement Details
                        </div>

                        <div class="row g-3">

                            <div class="col-md-8">
                                <div class="info-box">

                                    <div class="info-label">
                                        Item / Service Name
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->item_service_name ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="info-box">

                                    <div class="info-label">
                                        Quantity
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->quantity ?? '-' }}
                                        {{ $eurs->unit ?? '' }}
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Expected Arrival Date
                                    </div>

                                    <div class="info-value">

                                        @if($eurs->expected_arrival_date)
                                            {{ \Carbon\Carbon::parse($eurs->expected_arrival_date)->format('d F Y') }}
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        PR Amount Category
                                    </div>

                                    <div class="info-value">

                                        @if($eurs->amount_category === 'below_50m')
                                            Below IDR 49,999,900
                                        @elseif($eurs->amount_category === 'above_50m')
                                            Above IDR 50,000,000
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Main Desired Brand
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->preferred_brand ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="info-box">

                                    <div class="info-label">
                                        Alternative Brand
                                    </div>

                                    <div class="info-value">
                                        {{ $eurs->alternative_brand ?? '-' }}
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- SPECIAL REQUIREMENTS -->
                    @if($eurs->special_requirements)

                        <div class="mb-5">

                            <div class="section-title">
                                <i class="bi bi-exclamation-circle"></i>
                                Special Requirements
                            </div>

                            <div class="specification-box">
                                {{ $eurs->special_requirements }}
                            </div>

                        </div>

                    @endif


                    <!-- TECHNICAL SPECIFICATION -->
                    <div class="mb-5">

                        <div class="section-title">
                            <i class="bi bi-gear"></i>
                            Technical Specification
                        </div>

                        <div class="specification-box">
                            {{ $eurs->technical_description ?? '-' }}
                        </div>

                    </div>


                    <!-- SUPPLIER INFORMATION -->
                    @if($eurs->supplier_recommendation === 'Punya Rekomendasi')

                        <div class="mb-5">

                            <div class="section-title">
                                <i class="bi bi-building"></i>
                                Supplier Reference
                            </div>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Supplier
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->reference_supplier ?? '-' }}
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Contact Person
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->supplier_contact_person ?? '-' }}
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Phone / Email
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->supplier_contact ?? '-' }}
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="mb-5">

                            <div class="section-title">
                                <i class="bi bi-search"></i>
                                Procurement Requirement
                            </div>

                            <div class="info-box">

                                <div class="info-label">
                                    Procurement Target Date
                                </div>

                                <div class="info-value">

                                    @if($eurs->procurement_sla_date)
                                        {{ \Carbon\Carbon::parse($eurs->procurement_sla_date)->format('d F Y') }}
                                    @else
                                        -
                                    @endif

                                </div>

                            </div>

                        </div>

                    @endif


                    <!-- CAPEX -->
                    @if($eurs->capex_required)

                        <div class="mb-5">

                            <div class="section-title">
                                <i class="bi bi-diagram-3"></i>
                                CAPEX Project
                            </div>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Budget Project Number
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->capex_budget_number ?? '-' }}
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Layout / Technical Specification
                                        </div>

                                        <div class="info-value">

                                            @if($eurs->capex_layout_file)

                                                <span class="text-success">
                                                    <i class="bi bi-paperclip"></i>
                                                    File attached
                                                </span>

                                            @else
                                                -
                                            @endif

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif


                    <!-- IT -->
                    @if($eurs->it_recommendation)

                        <div class="mb-5">

                            <div class="section-title">
                                <i class="bi bi-pc-display"></i>
                                IT Recommendation
                            </div>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="info-box">

                                        <div class="info-label">
                                            RAM
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->it_ram ?? '-' }}
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Internal Memory
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->it_internal_memory ?? '-' }}
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Connectivity
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->it_connectivity ?? '-' }}
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="info-box">

                                        <div class="info-label">
                                            Operating System
                                        </div>

                                        <div class="info-value">
                                            {{ $eurs->it_os ?? '-' }}
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif


                    <!-- APPROVAL INFORMATION -->
                    <div>

                        <div class="section-title">
                            <i class="bi bi-shield-check"></i>
                            Approval Information
                        </div>

                        <div class="info-box">

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <div class="info-label">
                                        Approver
                                    </div>

                                    <div class="info-value">
                                        {{ $approval->approver_email }}
                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="info-label">
                                        Approval Status
                                    </div>

                                    <div class="info-value">

                                        <span class="status-badge">
                                            Pending Approval
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ACTION FOOTER -->
                <div class="approval-footer">

                    <div class="text-center mb-4">

                        <h5 class="fw-bold mb-2">
                            Approval Action
                        </h5>

                        <p class="text-muted small mb-0">
                            Please select one of the actions below.
                        </p>

                    </div>


                    <div class="d-flex flex-wrap justify-content-center gap-2">

                        <!-- APPROVE -->
                        <form
                            action="{{ route('approval.approve', $approval->approval_token) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-approve"
                                onclick="return confirm('Are you sure you want to approve this USR?')"
                            >
                                <i class="bi bi-check-circle me-1"></i>
                                Approve
                            </button>

                        </form>


                        <!-- APPROVE WITH NOTE -->
                        <button
                            type="button"
                            class="btn btn-note"
                            data-bs-toggle="modal"
                            data-bs-target="#approveNoteModal"
                        >
                            <i class="bi bi-chat-left-text me-1"></i>
                            Approve With Note
                        </button>


                        <!-- REJECT -->
                        <button
                            type="button"
                            class="btn btn-reject"
                            data-bs-toggle="modal"
                            data-bs-target="#rejectModal"
                        >
                            <i class="bi bi-x-circle me-1"></i>
                            Reject
                        </button>

                    </div>


                    <div class="security-note text-center">

                        <i class="bi bi-shield-lock me-1"></i>

                        This approval link is unique and should not be shared
                        with unauthorized persons.

                    </div>

                </div>

            </div>


            <div class="footer">

                PT Taisho Pharmaceutical Indonesia Tbk
                <br>

                Electronic User Specification Request System

            </div>

        </div>

    </div>


    <!-- APPROVE WITH NOTE MODAL -->
    <div
        class="modal fade"
        id="approveNoteModal"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="bi bi-chat-left-text me-2"></i>
                        Approve With Note
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    action="{{ route('approval.approve-with-note', $approval->approval_token) }}"
                    method="POST"
                >

                    @csrf

                    <div class="modal-body">

                        <p class="text-muted small">
                            The request will be approved and your note
                            will be recorded in the approval history.
                        </p>

                        <label class="form-label fw-semibold">
                            Approval Note
                        </label>

                        <textarea
                            name="approval_note"
                            class="form-control"
                            placeholder="Enter your approval note..."
                            required
                        ></textarea>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-note"
                        >
                            <i class="bi bi-check-circle me-1"></i>
                            Submit Approval
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- REJECT MODAL -->
    <div
        class="modal fade"
        id="rejectModal"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-header">

                    <h5 class="modal-title text-danger">

                        <i class="bi bi-x-circle me-2"></i>

                        Reject USR

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <form
                    action="{{ route('approval.reject', $approval->approval_token) }}"
                    method="POST"
                >

                    @csrf

                    <div class="modal-body">

                        <p class="text-muted small">
                            Please provide the reason for rejecting
                            this User Specification Request.
                        </p>

                        <label class="form-label fw-semibold">
                            Rejection Reason
                        </label>

                        <textarea
                            name="rejection_reason"
                            class="form-control"
                            placeholder="Enter the rejection reason..."
                            required
                        ></textarea>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-reject"
                        >
                            <i class="bi bi-x-circle me-1"></i>
                            Reject Request
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>