@php
    $user = Auth::user();
    $role = $user->role ?? 'user';
    $roleLabels = ['user' => 'Requester', 'procurement' => 'Procurement', 'ehs' => 'EHS Reviewer'];
    $roleLabel = $roleLabels[$role] ?? ucfirst($role);
    $initials = collect(preg_split('/\s+/', trim($user->name)))->take(2)->map(fn ($w) => strtoupper(mb_substr($w, 0, 1)))->implode('');

    // Ganti dengan data asli dari controller: return view('urs.create', compact('departments', 'hods'));
    $departments = $departments ?? ['Production', 'Quality Control', 'Quality Assurance', 'Warehouse', 'Engineering', 'EHS', 'Finance', 'HR & GA', 'IT'];
    $hods = $hods ?? [];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New URS | E-URS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --taisho:#049BDE; --sky:#6CCBF5; --baby:#EAF6FD; --cobalt:#1E6FD9;
  --deep:#0A4F8F; --night:#06294A; --bg:#E8F4FB;
  --ink:#0B2F4D; --muted:#5A7790; --line:#D6E9F5; --danger:#C93A3A;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',sans-serif;font-size:14px;background:var(--bg);color:var(--ink);overflow-x:hidden}
h1,h2,h3,h4,.sora{font-family:'Sora',sans-serif}
a:focus-visible,button:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:2px solid var(--sky);outline-offset:2px}

/* SIDEBAR */
.sidebar{width:260px;height:100vh;position:fixed;left:0;top:0;z-index:1000;display:flex;flex-direction:column;background:linear-gradient(180deg,#FFFFFF 0%,#DDEFFA 100%);border-right:1px solid var(--line);transition:transform .3s}
.sb-logo{height:72px;padding:0 22px;display:flex;align-items:center;gap:12px;border-bottom:1px solid var(--line);text-decoration:none}
.sb-logo img{height:28px}
.sb-logo .d{width:1px;height:26px;background:var(--sky)}
.sb-logo strong{display:block;font-family:'Sora';font-size:16px;color:var(--deep);line-height:1.1}
.sb-logo small{font-size:8px;letter-spacing:.6px;color:var(--muted)}
.sb-menu{padding:22px 14px;flex:1;overflow-y:auto}
.menu-title{font-size:10.5px;font-weight:700;letter-spacing:1.1px;color:#8DB4CC;padding:0 12px;margin-bottom:8px}
.menu-title:not(:first-child){margin-top:24px}
.menu-item{display:flex;align-items:center;gap:12px;padding:11px 14px;margin-bottom:4px;border-radius:12px;color:var(--ink);text-decoration:none;font-size:13.5px;font-weight:500;border:0;background:none;width:100%;text-align:left;transition:.2s}
.menu-item i{font-size:16px;width:20px;color:var(--taisho)}
.menu-item:hover{background:#fff;color:var(--taisho);box-shadow:0 4px 12px rgba(4,155,222,.12)}
.menu-item.active{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;font-weight:600;box-shadow:0 8px 18px rgba(4,155,222,.4)}
.menu-item.active i{color:#fff}
.sb-bottom{padding:14px;border-top:1px solid var(--line)}
.overlay{display:none;position:fixed;inset:0;background:rgba(6,41,74,.55);z-index:999}
.overlay.show{display:block}

/* MAIN */
.main{margin-left:260px;min-height:100vh;display:flex;flex-direction:column}
.topbar{height:72px;background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 32px;position:sticky;top:0;z-index:50}
.page-title h1{font-size:19px;font-weight:700;color:var(--night)}
.page-title p{font-size:12px;color:var(--muted);margin-top:2px}
.mobile-menu{display:none;border:0;background:none;font-size:24px;color:var(--deep);margin-right:12px}
.profile{display:flex;align-items:center;gap:12px;background:var(--baby);padding:6px 16px 6px 6px;border-radius:50px}
.avatar{width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700}
.profile strong{display:block;font-size:13px;color:var(--night)}
.profile span{font-size:11.5px;color:var(--muted)}
.content{padding:28px 32px 40px;flex:1}
.dash-footer{padding:18px 32px;border-top:1px solid var(--line);background:#fff;font-size:12px;color:var(--muted);display:flex;justify-content:space-between;flex-wrap:wrap;gap:6px}

/* FORM WIZARD */
.wrap{max-width:860px;margin:0 auto}
.back{display:inline-flex;align-items:center;gap:6px;color:var(--muted);text-decoration:none;font-size:13px;margin-bottom:14px}
.back:hover{color:var(--taisho)}
.intro h2{font-size:24px;font-weight:700;color:var(--night);letter-spacing:-.3px;margin-bottom:6px}
.intro p{color:var(--muted);line-height:1.7;max-width:600px;margin-bottom:22px}

.steps{display:flex;gap:8px;margin-bottom:20px}
.step{flex:1;display:flex;align-items:center;gap:10px;padding:12px 14px;background:#fff;border:1px solid var(--line);border-radius:14px;color:var(--muted);font-size:13px;font-weight:500}
.step .n{width:28px;height:28px;border-radius:50%;background:var(--baby);color:var(--deep);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12.5px;flex:none}
.step.active{border-color:var(--taisho);color:var(--night);font-weight:600;box-shadow:0 6px 18px rgba(4,155,222,.16)}
.step.active .n{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff}
.step.done .n{background:var(--taisho);color:#fff}

.card-x{background:#fff;border:1px solid var(--line);border-radius:20px;padding:30px;box-shadow:0 4px 18px rgba(10,79,143,.05)}
.card-x h3{font-size:18px;font-weight:700;color:var(--night);margin-bottom:4px}
.card-x .sub{font-size:13px;color:var(--muted);margin-bottom:24px}
.pane{display:none}
.pane.show{display:block}

.field{margin-bottom:22px}
.field>label,.field>.lbl{display:block;font-weight:600;font-size:13.5px;color:var(--night);margin-bottom:4px}
.field .req{color:var(--danger)}
.field .opt{font-weight:400;color:var(--muted);font-size:12px;margin-left:4px}
.hint{font-size:12.5px;color:var(--muted);margin-bottom:8px;line-height:1.5}
.inp,.sel,.txt{width:100%;font:inherit;font-size:14px;color:var(--ink);background:#fff;border:1.5px solid var(--line);border-radius:12px;padding:12px 14px;transition:.2s}
.inp:focus,.sel:focus,.txt:focus{border-color:var(--taisho);box-shadow:0 0 0 4px rgba(4,155,222,.12);outline:0}
.inp[readonly]{background:var(--baby);color:var(--muted)}
.txt{min-height:130px;resize:vertical;line-height:1.6}
.money{position:relative}
.money span{position:absolute;left:14px;top:50%;transform:translateY(-50%);font-weight:600;color:var(--deep)}
.money .inp{padding-left:44px}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.grid2 .field{margin-bottom:22px}

.choices{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.choice{position:relative}
.choice input{position:absolute;opacity:0}
.choice label{display:flex;align-items:center;gap:12px;padding:14px 16px;border:1.5px solid var(--line);border-radius:14px;cursor:pointer;background:#fff;transition:.2s;height:100%}
.choice label i{width:38px;height:38px;border-radius:10px;background:var(--baby);color:var(--taisho);display:flex;align-items:center;justify-content:center;font-size:18px;flex:none}
.choice label strong{display:block;font-size:14px;color:var(--night)}
.choice label small{display:block;font-size:12px;color:var(--muted);margin-top:1px}
.choice label:hover{border-color:var(--sky)}
.choice input:checked+label{border-color:var(--taisho);background:var(--baby);box-shadow:0 0 0 3px rgba(4,155,222,.14)}
.choice input:checked+label i{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff}
.choice input:focus-visible+label{outline:2px solid var(--sky);outline-offset:2px}

.drop{display:flex;align-items:center;gap:14px;padding:18px;border:2px dashed var(--sky);border-radius:14px;background:var(--baby);cursor:pointer;transition:.2s}
.drop:hover{background:#dff1fb}
.drop i{font-size:26px;color:var(--taisho)}
.drop strong{display:block;color:var(--night);font-size:13.5px}
.drop span{font-size:12px;color:var(--muted)}
.drop input{display:none}

.err{display:none;color:var(--danger);font-size:12.5px;margin-top:6px;font-weight:500}
.field.invalid .err{display:block}
.field.invalid .inp,.field.invalid .sel,.field.invalid .txt,.field.invalid .choice label{border-color:var(--danger)}

.note{display:flex;gap:10px;background:var(--baby);border-radius:12px;padding:12px 14px;font-size:12.5px;color:var(--deep);line-height:1.5;margin-bottom:22px}
.note i{color:var(--taisho);font-size:16px}

.review{border:1px solid var(--line);border-radius:14px;overflow:hidden}
.review .row-r{display:flex;gap:16px;padding:12px 16px;border-bottom:1px solid var(--line);font-size:13.5px}
.review .row-r:last-child{border:0}
.review .row-r:nth-child(odd){background:#F8FCFE}
.review dt{width:190px;flex:none;color:var(--muted);font-weight:500}
.review dd{flex:1;color:var(--night);font-weight:500;word-break:break-word;white-space:pre-line}

.nav{display:flex;justify-content:space-between;gap:12px;margin-top:8px;padding-top:22px;border-top:1px solid var(--line)}
.btn-p,.btn-s{font:inherit;font-weight:600;font-size:14px;padding:13px 26px;border-radius:12px;border:0;cursor:pointer;transition:.2s;display:inline-flex;align-items:center;gap:8px}
.btn-p{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;box-shadow:0 10px 24px rgba(4,155,222,.35);margin-left:auto}
.btn-p:hover{filter:brightness(1.08);transform:translateY(-2px)}
.btn-s{background:var(--baby);color:var(--deep)}
.btn-s:hover{background:#dbeefa}
.alert-err{background:#FDECEC;border:1px solid #F3B9B9;color:#8E2424;border-radius:12px;padding:12px 16px;font-size:13px;margin-bottom:18px}

@media(max-width:900px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.show{transform:none}
  .main{margin-left:0}
  .mobile-menu{display:block}
  .topbar{padding:0 18px}
  .content{padding:22px 18px 32px}
  .profile div{display:none}
  .profile{padding:6px}
  .dash-footer{padding:16px 18px}
  .card-x{padding:22px 18px}
  .grid2,.choices{grid-template-columns:1fr}
  .step span.t{display:none}
  .step{justify-content:center;padding:10px}
  .step.active span.t{display:inline}
  .step.active{flex:2.2}
  .review .row-r{flex-direction:column;gap:2px}
  .review dt{width:auto}
}
@media(prefers-reduced-motion:reduce){*{transition:none!important}}
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <a href="{{ route('home') }}" class="sb-logo">
        <img src="https://www.taisho.co.id/assets/frontend/images/LogoNew.png" alt="Taisho">
        <span class="d"></span>
        <span><strong>E-URS</strong><small>PROCUREMNET SYSTEM</small></span>
    </a>
    <nav class="sb-menu">
        <div class="menu-title">MAIN MENU</div>
        <a href="{{ route('dashboard') }}" class="menu-item"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a>
        @if ($role === 'user')
            <a href="{{ route('urs.create') }}" class="menu-item active"><i class="bi bi-file-earmark-plus"></i>New URS Request</a>
            <a href="#" class="menu-item"><i class="bi bi-folder2-open"></i>My Requests</a>
        @endif
        @if ($role === 'procurement')
            <div class="menu-title">PROCESS</div>
            <a href="#" class="menu-item"><i class="bi bi-inbox"></i>Incoming Requests</a>
            <a href="#" class="menu-item"><i class="bi bi-arrow-repeat"></i>In Progress</a>
        @endif
        @if ($role === 'ehs')
            <div class="menu-title">PROCESS</div>
            <a href="#" class="menu-item"><i class="bi bi-shield-check"></i>EHS Review</a>
        @endif
        <div class="menu-title">DOCUMENTS</div>
        <a href="#" class="menu-item"><i class="bi bi-file-earmark-text"></i>Documents</a>
    </nav>
    <div class="sb-bottom">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item"><i class="bi bi-box-arrow-left"></i>Logout</button>
        </form>
    </div>
</aside>
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- MAIN -->
<main class="main">
    <header class="topbar">
        <div class="d-flex align-items-center">
            <button class="mobile-menu" onclick="toggleSidebar()" aria-label="Toggle menu"><i class="bi bi-list"></i></button>
            <div class="page-title">
                <h1>New URS Request</h1>
                <p>User Requirement Specification (General)</p>
            </div>
        </div>
        <div class="profile">
            <div class="avatar">{{ $initials }}</div>
            <div>
                <strong>{{ $user->name }}</strong>
                <span>{{ $roleLabel }}@if($user->department) · {{ $user->department }}@endif</span>
            </div>
        </div>
    </header>

    <section class="content">
    <div class="wrap">

        <a href="{{ route('dashboard') }}" class="back"><i class="bi bi-arrow-left"></i>Back to dashboard</a>

        <div class="intro">
            <h2>Creatte a new URS</h2>
            <p>Fill in the 3 short steps below. You can go back at any time, and you will see a summary to check before sending.</p>
        </div>

        <div class="steps" id="steps">
            <div class="step active"><span class="n">1</span><span class="t">Basic info</span></div>
            <div class="step"><span class="n">2</span><span class="t">What you need</span></div>
            <div class="step"><span class="n">3</span><span class="t">Approval &amp; file</span></div>
            <div class="step"><span class="n"><i class="bi bi-check2"></i></span><span class="t">Check &amp; send</span></div>
        </div>

        <form class="card-x" id="ursForm" action="{{ route('urs.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            @if ($errors->any())
                <div class="alert-err" role="alert">
                    <strong>We could not save your request.</strong> Please check the fields below:
                    <ul class="mb-0 mt-1 ps-3">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <!-- STEP 1 -->
            <div class="pane show" data-step="1">
                <h3>Basic information</h3>
                <p class="sub">Tell us who the purchase is for and who will handle it.</p>

                <div class="field" data-req>
                    <span class="lbl">Who will handle the PO? <span class="req">*</span></span>
                    <p class="hint">HO = Head Office, TO = Tangerang Office / site. Not sure? Ask your HOD.</p>
                    <div class="choices">
                        <div class="choice"><input type="radio" name="po_handled_by" id="po_ho" value="HO" {{ old('po_handled_by') === 'HO' ? 'checked' : '' }}><label for="po_ho"><i class="bi bi-building"></i><span><strong>HO</strong><small>Head Office</small></span></label></div>
                        <div class="choice"><input type="radio" name="po_handled_by" id="po_to" value="TO" {{ old('po_handled_by') === 'TO' ? 'checked' : '' }}><label for="po_to"><i class="bi bi-geo-alt"></i><span><strong>TO</strong><small>Site / Plant Office</small></span></label></div>
                    </div>
                    <div class="err">Please choose HO or TO.</div>
                </div>

                <div class="grid2">
                    <div class="field">
                        <label for="requestor_email">Your email</label>
                        <p class="hint">Filled in automatically from your account.</p>
                        <input class="inp" type="email" id="requestor_email" name="requestor_email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="field" data-req>
                        <label for="department">Purchase for which department? <span class="req">*</span></label>
                        <p class="hint">The department that will use the item.</p>
                        <select class="sel" id="department" name="department">
                            <option value="">Select department</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d }}" {{ old('department', $user->department) === $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                        <div class="err">Please select a department.</div>
                    </div>
                </div>

                <div class="field" data-req>
                    <span class="lbl">Is this request made for another department? <span class="req">*</span></span>
                    <p class="hint">Choose Yes if you are submitting on behalf of someone from a different department.</p>
                    <div class="choices">
                        <div class="choice"><input type="radio" name="for_other_department" id="od_n" value="NO" {{ old('for_other_department') === 'NO' ? 'checked' : '' }}><label for="od_n"><i class="bi bi-person-check"></i><span><strong>No</strong><small>It is for my own department</small></span></label></div>
                        <div class="choice"><input type="radio" name="for_other_department" id="od_y" value="YES" {{ old('for_other_department') === 'YES' ? 'checked' : '' }}><label for="od_y"><i class="bi bi-people"></i><span><strong>Yes</strong><small>On behalf of another department</small></span></label></div>
                    </div>
                    <div class="err">Please choose Yes or No.</div>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="pane" data-step="2">
                <h3>What do you need?</h3>
                <p class="sub">Describe the item or service. Short and clear is fine.</p>

                <div class="field" data-req>
                    <label for="requirement">Requirement <span class="req">*</span></label>
                    <p class="hint">Name of the item or service you want to buy.</p>
                    <input class="inp" id="requirement" name="requirement" value="{{ old('requirement') }}" placeholder="e.g. Stainless steel mixing tank 500 L">
                    <div class="err">Please write what you need.</div>
                </div>

                <div class="grid2">
                    <div class="field" data-req>
                        <label for="quantity">Estimated quantity <span class="req">*</span></label>
                        <p class="hint">Include the unit.</p>
                        <input class="inp" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="e.g. 2 units">
                        <div class="err">Please fill in the quantity.</div>
                    </div>
                    <div class="field" data-req>
                        <label for="delivery_date">Expected delivery date <span class="req">*</span></label>
                        <p class="hint">When do you need it to arrive?</p>
                        <input class="inp" type="date" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}">
                        <div class="err">Please pick a delivery date.</div>
                    </div>
                    <div class="field">
                        <label for="brand">Brand <span class="opt">(optional)</span></label>
                        <p class="hint">Leave empty if any brand is fine.</p>
                        <input class="inp" id="brand" name="brand" value="{{ old('brand') }}">
                    </div>
                    <div class="field" data-req>
                        <label for="amount_view">Total PO amount <span class="req">*</span></label>
                        <p class="hint">Your best estimate is okay.</p>
                        <div class="money"><span>Rp</span><input class="inp" id="amount_view" inputmode="numeric" placeholder="0" value="{{ old('total_po_amount') ? number_format((int) old('total_po_amount'), 0, ',', '.') : '' }}"></div>
                        <input type="hidden" name="total_po_amount" id="total_po_amount" value="{{ old('total_po_amount') }}">
                        <div class="err">Please fill in the amount.</div>
                    </div>
                </div>

                <div class="field" data-req>
                    <label for="detail_spec">Detail specification <span class="req">*</span></label>
                    <p class="hint">Size, material, capacity, standards, or anything the supplier must know.</p>
                    <textarea class="txt" id="detail_spec" name="detail_spec">{{ old('detail_spec') }}</textarea>
                    <div class="err">Please describe the specification.</div>
                </div>

                <div class="field">
                    <label for="reference_supplier">Reference supplier <span class="opt">(optional)</span></label>
                    <p class="hint">If you already know a supplier that can provide this.</p>
                    <input class="inp" id="reference_supplier" name="reference_supplier" value="{{ old('reference_supplier') }}">
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="pane" data-step="3">
                <h3>Approval &amp; attachment</h3>
                <p class="sub">Last details before you check everything.</p>

                <div class="field" data-req>
                    <span class="lbl">Does this need an EHS recommendation? <span class="req">*</span></span>
                    <p class="hint">Choose Yes for chemicals, machines, or anything related to safety, health, or the environment.</p>
                    <div class="choices">
                        <div class="choice"><input type="radio" name="ehs_required" id="ehs_y" value="YES" {{ old('ehs_required') === 'YES' ? 'checked' : '' }}><label for="ehs_y"><i class="bi bi-shield-check"></i><span><strong>Yes</strong><small>EHS will review it</small></span></label></div>
                        <div class="choice"><input type="radio" name="ehs_required" id="ehs_n" value="NO" {{ old('ehs_required') === 'NO' ? 'checked' : '' }}><label for="ehs_n"><i class="bi bi-slash-circle"></i><span><strong>No</strong><small>Not needed</small></span></label></div>
                    </div>
                    <div class="err">Please choose Yes or No.</div>
                </div>

                <div class="field" data-req>
                    <label for="hod_approver">HOD approver <span class="req">*</span></label>
                    <p class="hint">The Head of Department who will approve this request.</p>
                    <select class="sel" id="hod_approver" name="hod_approver">
                        <option value="">Select approver</option>
                        @foreach ($hods as $h)
                            <option value="{{ $h->id }}" {{ (string) old('hod_approver') === (string) $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                        @endforeach
                    </select>
                    <div class="err">Please select your HOD.</div>
                </div>

                <div class="field">
                    <span class="lbl">Specification attachment <span class="opt">(optional)</span></span>
                    <p class="hint">One file, up to 10 MB. Word, Excel, PowerPoint, PDF, or image.</p>
                    <label class="drop" for="attachment">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <div><strong id="fileName">Click to choose a file</strong><span id="fileInfo">No file selected</span></div>
                        <input type="file" id="attachment" name="attachment" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,image/*">
                    </label>
                    <div class="err" id="fileErr">This file is larger than 10 MB. Please choose a smaller one.</div>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="pane" data-step="4">
                <h3>Check your request</h3>
                <p class="sub">Make sure everything is correct, then press Send request.</p>
                <div class="note"><i class="bi bi-info-circle-fill"></i><div>After sending, your HOD and Procurement will be notified. Need to change something? Use the Back button.</div></div>
                <dl class="review" id="review"></dl>
            </div>

            <div class="nav">
                <button type="button" class="btn-s" id="btnBack" style="display:none"><i class="bi bi-arrow-left"></i>Back</button>
                <button type="button" class="btn-p" id="btnNext">Next<i class="bi bi-arrow-right"></i></button>
                <button type="submit" class="btn-p" id="btnSend" style="display:none"><i class="bi bi-send-fill"></i>Send request</button>
            </div>
        </form>
    </div>
    </section>

    <footer class="dash-footer">
        <span>&copy; {{ date('Y') }} E-URS Procurement System</span>
        <span>PT Taisho Pharmaceutical Indonesia</span>
    </footer>
</main>

<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('show');
  document.getElementById('overlay').classList.toggle('show');
}

const form = document.getElementById('ursForm');
const panes = [...form.querySelectorAll('.pane')];
const steps = [...document.querySelectorAll('#steps .step')];
const btnBack = document.getElementById('btnBack');
const btnNext = document.getElementById('btnNext');
const btnSend = document.getElementById('btnSend');
let current = 1;

document.getElementById('delivery_date').min = new Date().toISOString().split('T')[0];

function show(n){
  current = n;
  panes.forEach(p => p.classList.toggle('show', +p.dataset.step === n));
  steps.forEach((s, i) => {
    s.classList.toggle('active', i + 1 === n);
    s.classList.toggle('done', i + 1 < n);
  });
  btnBack.style.display = n > 1 ? '' : 'none';
  btnNext.style.display = n < 4 ? '' : 'none';
  btnSend.style.display = n === 4 ? '' : 'none';
  if (n === 4) buildReview();
  window.scrollTo({top: 0, behavior: 'smooth'});
}

function valid(n){
  let ok = true, first = null;
  form.querySelector(`.pane[data-step="${n}"]`).querySelectorAll('.field[data-req]').forEach(f => {
    const radios = f.querySelectorAll('input[type=radio]');
    let filled;
    if (radios.length) filled = [...radios].some(r => r.checked);
    else {
      const el = f.querySelector('input:not([type=hidden]),select,textarea');
      filled = el && el.value.trim() !== '';
    }
    f.classList.toggle('invalid', !filled);
    if (!filled) { ok = false; first = first || f; }
  });
  if (first) first.scrollIntoView({behavior: 'smooth', block: 'center'});
  return ok;
}

form.addEventListener('input', e => e.target.closest('.field')?.classList.remove('invalid'));
form.addEventListener('change', e => e.target.closest('.field')?.classList.remove('invalid'));

btnNext.onclick = () => { if (valid(current)) show(current + 1); };
btnBack.onclick = () => show(current - 1);

// Rupiah formatting
const av = document.getElementById('amount_view'), ah = document.getElementById('total_po_amount');
av.addEventListener('input', () => {
  const d = av.value.replace(/\D/g, '');
  ah.value = d;
  av.value = d ? Number(d).toLocaleString('id-ID') : '';
});

// File picker
const fi = document.getElementById('attachment');
fi.addEventListener('change', () => {
  const f = fi.files[0], err = document.getElementById('fileErr').parentElement;
  if (f && f.size > 10 * 1024 * 1024) {
    fi.value = ''; err.classList.add('invalid');
    document.getElementById('fileName').textContent = 'Click to choose a file';
    document.getElementById('fileInfo').textContent = 'No file selected';
    return;
  }
  err.classList.remove('invalid');
  document.getElementById('fileName').textContent = f ? f.name : 'Click to choose a file';
  document.getElementById('fileInfo').textContent = f ? (f.size / 1024 / 1024).toFixed(2) + ' MB' : 'No file selected';
});

function buildReview(){
  const v = n => (form.elements[n]?.value || '').trim() || '-';
  const sel = n => { const e = form.elements[n]; return e && e.selectedIndex >= 0 ? e.options[e.selectedIndex].text : '-'; };
  const f = fi.files[0];
  const rows = [
    ['PO handled by', v('po_handled_by')],
    ['Your email', v('requestor_email')],
    ['Purchase for department', sel('department')],
    ['For another department', v('for_other_department')],
    ['Requirement', v('requirement')],
    ['Estimated quantity', v('quantity')],
    ['Expected delivery date', v('delivery_date')],
    ['Brand', v('brand')],
    ['Total PO amount', av.value ? 'Rp ' + av.value : '-'],
    ['Detail specification', v('detail_spec')],
    ['Reference supplier', v('reference_supplier')],
    ['EHS recommendation', v('ehs_required')],
    ['HOD approver', sel('hod_approver')],
    ['Attachment', f ? f.name : 'None']
  ];
  const box = document.getElementById('review');
  box.innerHTML = '';
  rows.forEach(([k, val]) => {
    const r = document.createElement('div'); r.className = 'row-r';
    const dt = document.createElement('dt'); dt.textContent = k;
    const dd = document.createElement('dd'); dd.textContent = val;
    r.append(dt, dd); box.append(r);
  });
}

form.addEventListener('submit', e => {
  if (current !== 4) { e.preventDefault(); return; }
  setTimeout(() => { btnSend.disabled = true; btnSend.textContent = 'Sending...'; }, 0);
});

// Kalau server mengembalikan error validasi, buka langkah pertama
@if ($errors->any()) show(1); @endif
</script>
</body>
</html>