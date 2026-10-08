<!DOCTYPE html>
    <html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') | E-URS Taisho</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--primary:#005BAC;--primary-dark:#003B73;--navy:#0A2540;--secondary:#2F80C0;--light-blue:#EAF4FA;--bg:#F7FAFC;--text:#17324D;--muted:#66788A;--border:#E2EAF0;--danger:#B42318;--success:#157347}
*{box-sizing:border-box}
body{margin:0;font-family:'Inter',sans-serif;font-size:14px;color:var(--text);background:#fff}
a:focus-visible,button:focus-visible,input:focus-visible{outline:2px solid var(--secondary);outline-offset:2px}
.auth-page{display:flex;min-height:100vh}

/* LEFT */
.auth-left{width:44%;min-height:100vh;color:#fff;padding:48px 7%;display:flex;flex-direction:column;justify-content:space-between;background:linear-gradient(rgba(6,28,52,.93),rgba(8,40,74,.93)),url("https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1400&q=70") center/cover,var(--navy)}
.auth-brand{display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none}
.auth-brand img{height:30px;filter:brightness(0) invert(1)}
.auth-brand .div{width:1px;height:30px;background:rgba(255,255,255,.3)}
.auth-brand strong{display:block;font-size:17px;line-height:1.1}
.auth-brand small{display:block;font-size:8.5px;letter-spacing:.6px;color:rgba(255,255,255,.65);margin-top:2px}
.auth-left h2{font-size:clamp(26px,2.8vw,36px);font-weight:700;line-height:1.2;letter-spacing:-.8px;max-width:460px;padding-left:16px;border-left:3px solid var(--secondary);margin:0 0 18px}
.auth-left p.lead{color:rgba(255,255,255,.78);line-height:1.75;max-width:460px;margin:0 0 28px}
.auth-points{list-style:none;padding:0;margin:0;display:grid;gap:12px}
.auth-points li{display:flex;align-items:center;gap:12px;font-size:13px;color:rgba(255,255,255,.88)}
.auth-points i{width:32px;height:32px;border-radius:4px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;color:#9CCBEF}
.auth-copy{font-size:11.5px;color:rgba(255,255,255,.5)}

/* RIGHT */
.auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;background:#fff}
.auth-box{width:100%;max-width:420px}
.auth-mobile-brand{display:none;margin-bottom:28px}
.auth-mobile-brand img{height:28px}
.auth-heading h1{font-size:26px;font-weight:700;color:var(--navy);letter-spacing:-.4px;margin:0 0 6px}
.auth-heading p{color:var(--muted);margin:0 0 26px;line-height:1.6}
.alert-box{display:flex;gap:10px;padding:12px 14px;border-radius:4px;font-size:13px;margin-bottom:20px;line-height:1.5}
.alert-box.err{background:#FEF3F2;border:1px solid #FDD5D1;color:var(--danger)}
.alert-box.ok{background:#ECF8F1;border:1px solid #BFE3CD;color:var(--success)}
.alert-box ul{margin:0;padding:0;list-style:none}
.field{margin-bottom:18px}
.field label.lbl{display:block;font-size:12.5px;font-weight:600;color:var(--text);margin-bottom:7px}
.input-wrap{position:relative}
.input-wrap>i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#8FA2B3;font-size:15px;pointer-events:none}
.input-wrap input{width:100%;height:46px;border:1px solid var(--border);border-radius:4px;padding:0 44px;font:inherit;font-size:14px;color:var(--text);background:#fff;transition:border-color .2s,box-shadow .2s}
.input-wrap input:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgba(0,91,172,.12)}
.input-wrap input[readonly]{background:var(--bg);color:var(--muted)}
.toggle-pw{position:absolute;right:6px;top:50%;transform:translateY(-50%);border:0;background:transparent;color:#8FA2B3;padding:8px 10px;cursor:pointer}
.toggle-pw:hover{color:var(--primary)}
.row-between{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px;gap:10px;flex-wrap:wrap}
.check{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);cursor:pointer}
.check input{accent-color:var(--primary)}
.link{color:var(--primary);font-weight:500;text-decoration:none;font-size:13px}
.link:hover{color:var(--primary-dark);text-decoration:underline}
.btn-auth{width:100%;height:46px;border:0;border-radius:4px;background:var(--primary);color:#fff;font:inherit;font-weight:600;font-size:14px;cursor:pointer;transition:background .2s;display:flex;align-items:center;justify-content:center;gap:8px}
.btn-auth:hover{background:var(--primary-dark)}
.btn-auth:disabled{opacity:.7;cursor:not-allowed}
.auth-alt{text-align:center;margin-top:22px;color:var(--muted);font-size:13px}
.auth-alt a{color:var(--primary);font-weight:600;text-decoration:none}
.auth-alt a:hover{text-decoration:underline}
.back-home{display:inline-flex;align-items:center;gap:6px;color:var(--muted);font-size:12.5px;text-decoration:none;margin-top:28px}
.back-home:hover{color:var(--primary)}
.auth-foot{text-align:center;margin-top:30px;font-size:11.5px;color:#9AA9B7}

/* ROLE CARDS */
.role-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.role-opt{position:relative;display:block}
.role-opt input{position:absolute;opacity:0}
.role-card{border:1px solid var(--border);border-radius:4px;padding:14px 8px;text-align:center;cursor:pointer;transition:border-color .2s,background .2s}
.role-card i{display:block;font-size:20px;color:var(--secondary);margin-bottom:6px}
.role-card strong{display:block;font-size:12.5px;color:var(--text)}
.role-card span{display:block;font-size:11px;color:var(--muted);margin-top:2px}
.role-opt input:checked+.role-card{border-color:var(--primary);background:var(--light-blue);box-shadow:inset 0 0 0 1px var(--primary)}
.role-opt input:focus-visible+.role-card{outline:2px solid var(--secondary);outline-offset:2px}

@media(max-width:900px){
  .auth-left{display:none}
  .auth-mobile-brand{display:flex;align-items:center;gap:12px}
}
@media(max-width:480px){.role-grid{grid-template-columns:1fr}.auth-right{padding:28px 20px}}
</style>
</head>
<body>
<div class="auth-page">

    <!-- LEFT PANEL -->
    <section class="auth-left">
        <a href="{{ route('home') }}" class="auth-brand">
            <img src="https://taisho.co.id/assets/frontend/images/footer-logo1.svg?v=12" alt="PT Taisho Pharmaceutical Indonesia">
            <span class="div"></span>
            <span><strong>E-URS</strong><small>ELECTRONIC USER REQUIREMENT SPECIFICATION</small></span>
        </a>

        <div>
            <h2>@yield('left-title')</h2>
            <p class="lead">@yield('left-text')</p>
            @hasSection('left-extra')
                @yield('left-extra')
            @else
                <ul class="auth-points">
                    <li><i class="bi bi-shield-check"></i>Secure access</li>
                    <li><i class="bi bi-diagram-3"></i>Structured workflow</li>
                    <li><i class="bi bi-file-earmark-text"></i>Digital documentation</li>
                </ul>
            @endif
        </div>

        <div class="auth-copy">&copy; {{ date('Y') }} PT Taisho Pharmaceutical Indonesia</div>
    </section>

    <!-- RIGHT PANEL -->
    <section class="auth-right">
        <div class="auth-box" style="max-width:@yield('box-width','420px')">

            <a href="{{ route('home') }}" class="auth-mobile-brand auth-brand" style="color:var(--navy)">
                <img src="https://taisho.co.id/assets/frontend/images/footer-logo1.svg?v=12" alt="Taisho" style="filter:none">
                <span class="div" style="background:var(--border)"></span>
                <span><strong>E-URS</strong></span>
            </a>

            <div class="auth-heading">
                <h1>@yield('heading')</h1>
                <p>@yield('subheading')</p>
            </div>

            @if (session('success') || session('status'))
                <div class="alert-box ok" role="status"><i class="bi bi-check-circle-fill"></i><div>{{ session('success') ?? session('status') }}</div></div>
            @endif

            @if ($errors->any())
                <div class="alert-box err" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            @yield('content')

            <div class="auth-foot">E-URS Procurement System &copy; {{ date('Y') }}</div>
        </div>
    </section>
</div>

<script>
    document.querySelectorAll('[data-toggle-pw]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.dataset.togglePw);
            var icon = btn.querySelector('i');
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
            btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        });
    });
    document.querySelectorAll('form[data-loading]').forEach(function (form) {
        form.addEventListener('submit', function () {
            var b = form.querySelector('button[type=submit]');
            if (b) { b.disabled = true; b.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...'; }
        });
    });
</script>
</body>
</html>