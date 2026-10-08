<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot Password | E-URS Taisho</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--primary:#1B8CC4;--primary-dark:#0F6A99;--navy:#0D4C70;--secondary:#5BB8E0;--sky:#8FD6F5;--light-blue:#E8F6FC;--bg:#F4FAFD;--text:#17405A;--muted:#5F7E91;--border:#DCEBF3;--danger:#B42318;--success:#157347}
*{box-sizing:border-box}
body{margin:0;font-family:'Inter',sans-serif;font-size:14px;color:var(--text);background:#fff}
a:focus-visible,button:focus-visible,input:focus-visible{outline:2px solid var(--primary);outline-offset:2px}
.auth-page{display:flex;min-height:100vh}
.auth-left{width:44%;min-height:100vh;color:#fff;padding:48px 7%;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden;background:linear-gradient(150deg,#3AA6DA 0%,#1B8CC4 55%,#0F6A99 100%)}
.auth-left::before{content:"";position:absolute;right:-170px;top:-130px;width:420px;height:420px;border:70px solid rgba(255,255,255,.08);border-radius:50%}
.auth-left::after{content:"";position:absolute;left:-140px;bottom:-130px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,.07)}
.auth-left>*{position:relative;z-index:1}
.auth-brand{display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none}
.auth-brand img{height:30px;filter:brightness(0) invert(1)}
.auth-brand .div{width:1px;height:30px;background:rgba(255,255,255,.4)}
.auth-brand strong{display:block;font-size:17px;line-height:1.1}
.auth-brand small{display:block;font-size:8.5px;letter-spacing:.6px;color:rgba(255,255,255,.8);margin-top:2px}
.auth-left h2{font-size:clamp(26px,2.8vw,36px);font-weight:700;line-height:1.2;letter-spacing:-.8px;max-width:460px;margin:0 0 16px}
.auth-left p.lead{color:rgba(255,255,255,.9);line-height:1.75;max-width:460px;margin:0 0 28px}
.auth-points{list-style:none;padding:0;margin:0;display:grid;gap:12px}
.auth-points li{display:flex;align-items:center;gap:12px;font-size:13px;color:#fff}
.auth-points i{width:32px;height:32px;border-radius:6px;background:rgba(255,255,255,.16);display:flex;align-items:center;justify-content:center;flex:none}
.auth-copy{font-size:11.5px;color:rgba(255,255,255,.75)}
.auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;background:#fff}
.auth-box{width:100%;max-width:420px}
.mobile-brand{display:none;align-items:center;gap:12px;margin-bottom:28px;text-decoration:none;color:var(--navy)}
.mobile-brand img{height:28px}.mobile-brand strong{font-size:17px}
.auth-heading h1{font-size:26px;font-weight:700;color:var(--navy);letter-spacing:-.4px;margin:0 0 6px}
.auth-heading p{color:var(--muted);margin:0 0 26px;line-height:1.6}
.alert-box{display:flex;gap:10px;padding:12px 14px;border-radius:6px;font-size:13px;margin-bottom:20px;line-height:1.5}
.alert-box.err{background:#FEF3F2;border:1px solid #FDD5D1;color:var(--danger)}
.alert-box.ok{background:#ECF8F1;border:1px solid #BFE3CD;color:var(--success)}
.alert-box ul{margin:0;padding:0;list-style:none}
.field{margin-bottom:18px}
.lbl{display:block;font-size:12.5px;font-weight:600;margin-bottom:7px}
.input-wrap{position:relative}
.input-wrap>i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#8FB3C7;font-size:15px;pointer-events:none}
.input-wrap input{width:100%;height:46px;border:1px solid var(--border);border-radius:8px;padding:0 44px;font:inherit;color:var(--text);background:#fff;transition:border-color .2s,box-shadow .2s}
.input-wrap input:focus{outline:none;border-color:var(--secondary);box-shadow:0 0 0 3px rgba(91,184,224,.22)}
.input-wrap input[readonly]{background:var(--bg);color:var(--muted)}
.toggle-pw{position:absolute;right:6px;top:50%;transform:translateY(-50%);border:0;background:transparent;color:#8FB3C7;padding:8px 10px;cursor:pointer}
.toggle-pw:hover{color:var(--primary)}
.row-between{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px;gap:10px;flex-wrap:wrap}
.check{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);cursor:pointer}
.check input{accent-color:var(--primary)}
.link{color:var(--primary);font-weight:500;text-decoration:none;font-size:13px}
.link:hover{color:var(--primary-dark);text-decoration:underline}
.btn-auth{width:100%;height:46px;border:0;border-radius:8px;background:var(--primary);color:#fff;font:inherit;font-weight:600;cursor:pointer;transition:background .2s,transform .2s;display:flex;align-items:center;justify-content:center;gap:8px}
.btn-auth:hover{background:var(--primary-dark);transform:translateY(-1px)}
.btn-auth:disabled{opacity:.7;cursor:not-allowed;transform:none}
.auth-alt{text-align:center;margin-top:22px;color:var(--muted);font-size:13px}
.auth-alt a{color:var(--primary);font-weight:600;text-decoration:none}
.auth-alt a:hover{text-decoration:underline}
.auth-foot{text-align:center;margin-top:30px;font-size:11.5px;color:#9FB8C7}
.role-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.role-opt{position:relative;display:block}
.role-opt input{position:absolute;opacity:0}
.role-card{border:1px solid var(--border);border-radius:8px;padding:14px 8px;text-align:center;cursor:pointer;transition:border-color .2s,background .2s}
.role-card i{display:block;font-size:20px;color:var(--secondary);margin-bottom:6px}
.role-card strong{display:block;font-size:12.5px}
.role-card span{display:block;font-size:11px;color:var(--muted);margin-top:2px}
.role-opt input:checked+.role-card{border-color:var(--primary);background:var(--light-blue);box-shadow:inset 0 0 0 1px var(--primary)}
.role-opt input:focus-visible+.role-card{outline:2px solid var(--primary);outline-offset:2px}
@media(max-width:900px){.auth-left{display:none}.mobile-brand{display:flex}}
@media(max-width:480px){.role-grid{grid-template-columns:1fr}.auth-right{padding:28px 20px}}
</style>
</head>
<body>
<div class="auth-page">
    <section class="auth-left">
        <a href="{{ route('home') }}" class="auth-brand">
            <img src="https://taisho.co.id/assets/frontend/images/footer-logo1.svg?v=12" alt="PT Taisho Pharmaceutical Indonesia">
            <span class="div"></span>
            <span><strong>E-URS</strong><small>ELECTRONIC USER REQUIREMENT SPECIFICATION</small></span>
        </a>
        <div>
            <h2>Recover your account access</h2>
            <p class="lead">Enter your registered email address and we will send a link to set a new password.</p>
            <ul class="auth-points">
                <li><i class="bi bi-shield-check"></i>Secure access</li>
                <li><i class="bi bi-diagram-3"></i>Structured workflow</li>
                <li><i class="bi bi-file-earmark-text"></i>Digital documentation</li>
            </ul>
        </div>
        <div class="auth-copy">&copy; {{ date('Y') }} PT Taisho Pharmaceutical Indonesia</div>
    </section>

    <section class="auth-right">
        <div class="auth-box">
            <a href="{{ route('home') }}" class="mobile-brand"><img src="https://taisho.co.id/assets/frontend/images/footer-logo1.svg?v=12" alt="Taisho" style="filter:none"><strong>E-URS</strong></a>

            <div class="auth-heading">
                <h1>Forgot password</h1>
                <p>We will email you a password reset link.</p>
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

            <form action="{{ route('password.email') }}" method="POST" data-loading>
                @csrf
            <div class="field">
                <label class="lbl" for="email">Email address</label>
                <div class="input-wrap"><i class="bi bi-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.com" autocomplete="email" autofocus required>
                    
                </div>
            </div>

                <button type="submit" class="btn-auth"><i class="bi bi-send"></i> Send reset link</button>
            </form>
            <div class="auth-alt"><a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Back to sign in</a></div>

            <div class="auth-foot">E-URS Procurement System &copy; {{ date('Y') }}</div>
            <div class="auth-foot">PT Taisho Pharmaceutical Indonesia</div>
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
        });
    });
    document.querySelectorAll('form[data-loading]').forEach(function (form) {
        form.addEventListener('submit', function () {
            var b = form.querySelector('button[type=submit]');
            if (b) { setTimeout(function () { b.disabled = true; }, 0); }
        });
    });
</script>
</body>
</html>