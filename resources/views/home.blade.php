<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-URS | Electronic User Requirement Specification</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --taisho:#049BDE;      /* Taisho brand blue */
  --sky:#6CCBF5;         /* light sky */
  --baby:#EAF6FD;        /* baby blue tint */
  --cobalt:#1E6FD9;      /* mid blue */
  --deep:#0A4F8F;        /* deep blue */
  --night:#06294A;       /* navy */
  --ink:#0B2F4D; --muted:#5A7790; --line:#D6E9F5; --nav-h:72px;
}
html{scroll-behavior:smooth;scroll-padding-top:var(--nav-h)}
body{font-family:'Inter',sans-serif;font-size:15px;color:var(--ink);background:#fff;padding-top:var(--nav-h);overflow-x:hidden}
h1,h2,h3,h4,h5,h6,.display{font-family:'Sora',sans-serif}
a:focus-visible,button:focus-visible{outline:2px solid var(--sky);outline-offset:2px}

/* NAV */
.site-nav{position:fixed;inset:0 0 auto 0;z-index:1000;min-height:var(--nav-h);background:rgba(255,255,255,.94);backdrop-filter:blur(10px);border-bottom:1px solid var(--line);transition:box-shadow .25s}
.site-nav.scrolled{box-shadow:0 6px 24px rgba(10,79,143,.12)}
.brand{display:flex;align-items:center;gap:14px;text-decoration:none}
.brand img{height:32px;width:auto}
.brand-divider{width:1px;height:30px;background:var(--line)}
.brand-text strong{display:block;font-family:'Sora';font-size:18px;font-weight:800;background:linear-gradient(90deg,var(--taisho),var(--deep));-webkit-background-clip:text;background-clip:text;color:transparent;line-height:1.1}
.brand-text span{display:block;font-size:8px;font-weight:600;letter-spacing:.7px;color:var(--muted);margin-top:2px}
.site-nav .nav-link{font-size:13.5px;font-weight:500;color:var(--ink);padding:8px 14px;border-radius:8px;transition:.2s}
.site-nav .nav-link:hover{color:var(--taisho);background:var(--baby)}
.site-nav .login-btn{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;font-weight:600;padding:9px 22px;margin-left:8px;border-radius:8px}
.site-nav .login-btn:hover{color:#fff;filter:brightness(1.08)}
.navbar-toggler{border:0;box-shadow:none!important}

/* BUTTONS */
.btn-corp,.btn-ghost{display:inline-flex;align-items:center;justify-content:center;gap:8px;font-size:14px;font-weight:600;padding:14px 28px;border-radius:10px;text-decoration:none;transition:.25s}
.btn-corp{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;box-shadow:0 10px 24px rgba(4,155,222,.4)}
.btn-corp:hover{color:#fff;transform:translateY(-2px);filter:brightness(1.08)}
.btn-ghost{color:var(--deep);border:1px solid var(--sky);background:#fff}
.btn-ghost:hover{background:var(--baby);color:var(--deep)}
.btn-white{background:linear-gradient(135deg,var(--deep),var(--cobalt));color:#fff;box-shadow:0 10px 24px rgba(10,79,143,.3)}
.btn-white:hover{color:#fff;filter:brightness(1.1)}

/* HERO */
.hero{position:relative;background:linear-gradient(120deg,#F6FBFE 0%,#DDF0FB 50%,#B9E2F8 100%);overflow:hidden}
.hero::before{content:"";position:absolute;width:640px;height:640px;left:-220px;bottom:-320px;border-radius:50%;background:radial-gradient(circle,rgba(4,155,222,.2),transparent 70%)}
.hero .carousel-item{min-height:640px;height:calc(100vh - var(--nav-h));max-height:780px}
.hero-photo{position:absolute;top:0;right:0;bottom:0;width:52%;background-size:cover;background-position:center;clip-path:polygon(18% 0,100% 0,100% 100%,0 100%)}
.hero-photo::before{content:"";position:absolute;inset:0;background:linear-gradient(120deg,rgba(4,155,222,.3),rgba(30,111,217,.12))}
.p1{background-image:url("https://www.taisho.co.id/assets/frontend/images/frontoffice1.jpg?v=3")}
.p2{background-image:url("https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1600&q=80")}
.p3{background-image:url("https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80")}
.hero-content{position:relative;z-index:2;height:100%;display:flex;align-items:center;padding-bottom:40px}
.hero-label{display:inline-flex;align-items:center;gap:8px;color:var(--deep);font-size:11.5px;font-weight:600;letter-spacing:1.4px;background:#fff;border:1px solid var(--line);padding:7px 16px;border-radius:50px;margin-bottom:24px}
.hero-label::before{content:"";width:7px;height:7px;border-radius:50%;background:var(--taisho);box-shadow:0 0 0 4px rgba(4,155,222,.2)}
.hero h1{color:var(--night);font-size:clamp(34px,4.6vw,58px);line-height:1.08;font-weight:800;letter-spacing:-1.6px;max-width:620px}
.hero h1 .hl{background:linear-gradient(90deg,var(--taisho),var(--cobalt));-webkit-background-clip:text;background-clip:text;color:transparent}
.hero-desc{color:var(--muted);font-size:16px;line-height:1.75;max-width:500px;margin-top:22px}
.hero-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:34px}
.hero .carousel-indicators{justify-content:flex-start;margin:0 0 28px;padding:0 calc((100% - 1296px)/2 + 12px);left:0;right:0}
.hero .carousel-indicators button{width:34px;height:4px;border:0;border-radius:4px;margin:0 6px 0 0;background:var(--deep);opacity:.25}
.hero .carousel-indicators button.active{opacity:1;background:var(--taisho)}
.hero .carousel-control-prev,.hero .carousel-control-next{top:auto;bottom:18px;width:44px;height:44px;border-radius:50%;border:1px solid var(--sky);opacity:1;background:#fff}
.hero .carousel-control-prev{left:auto;right:calc((100% - 1296px)/2 + 68px)}
.hero .carousel-control-next{right:calc((100% - 1296px)/2 + 12px)}
.hero .carousel-control-prev-icon,.hero .carousel-control-next-icon{filter:invert(1) brightness(.4)}
.hero-flow{position:absolute;right:calc((100% - 1296px)/2 + 12px);top:50%;transform:translateY(-55%);z-index:3;width:260px;background:rgba(255,255,255,.92);backdrop-filter:blur(12px);border-radius:18px;padding:22px;box-shadow:0 24px 50px rgba(6,41,74,.35)}
.hero-flow h6{font-size:11px;font-weight:700;color:var(--muted);letter-spacing:.9px;margin-bottom:14px}
.hero-flow ol{list-style:none;margin:0;padding:0}
.hero-flow li{display:flex;align-items:center;gap:12px;font-size:13px;font-weight:600;color:var(--deep);padding:8px 0;position:relative}
.hero-flow li i{width:32px;height:32px;border-radius:10px;background:var(--baby);color:var(--taisho);display:flex;align-items:center;justify-content:center;font-size:15px}
.hero-flow li:first-child i{background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff}
.hero-flow li+li::before{content:"";position:absolute;left:15px;top:-8px;height:16px;border-left:2px dotted var(--sky)}

/* SECTIONS */
.section{padding:100px 0}
.bg-soft{background:var(--baby)}
.section-label{display:inline-block;color:var(--taisho);font-size:12px;font-weight:700;letter-spacing:1.4px;margin-bottom:14px}
.section-title{font-size:clamp(27px,3.2vw,38px);font-weight:700;line-height:1.2;letter-spacing:-.8px;color:var(--night)}
.section-desc{color:var(--muted);line-height:1.8}

#about{background:linear-gradient(180deg,#fff 0%,var(--baby) 100%)}
#workflow{background:#F5FAFE}
/* ABOUT */
.about-photo{position:relative}
.about-photo img{width:100%;height:440px;object-fit:cover;border-radius:24px 24px 24px 120px;box-shadow:0 24px 50px rgba(10,79,143,.22)}
.about-photo::before{content:"";position:absolute;inset:24px -18px -18px 24px;border-radius:24px 24px 24px 120px;background:linear-gradient(135deg,var(--sky),var(--cobalt));opacity:.35;z-index:-1}
.about-badge{position:absolute;right:-12px;bottom:34px;background:#fff;border-radius:16px;padding:14px 18px;display:flex;align-items:center;gap:12px;box-shadow:0 14px 34px rgba(10,79,143,.2)}
.about-badge i{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px}
.about-badge strong{display:block;font-family:'Sora';font-size:14px}
.about-badge small{color:var(--muted);font-size:11.5px}
.mini-flow{display:flex;flex-wrap:wrap;gap:10px;margin-top:28px}
.mini-flow span{display:inline-flex;align-items:center;gap:8px;background:var(--baby);color:var(--deep);font-weight:600;font-size:13px;padding:9px 16px;border-radius:50px}
.mini-flow i{color:var(--taisho)}

/* FEATURES */
.feature-card{position:relative;height:100%;background:#fff;border:1px solid var(--line);border-radius:20px;padding:32px 26px 28px;overflow:hidden;transition:.3s}
.feature-card::after{content:attr(data-n);position:absolute;right:18px;top:8px;font-family:'Sora';font-size:54px;font-weight:800;color:var(--baby)}
.feature-card:hover{transform:translateY(-6px);border-color:var(--sky);box-shadow:0 18px 40px rgba(4,155,222,.18)}
.feature-icon{position:relative;z-index:1;width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,var(--taisho),var(--cobalt));color:#fff;display:flex;align-items:center;justify-content:center;font-size:23px;margin-bottom:22px;box-shadow:0 10px 20px rgba(4,155,222,.3)}
.feature-card h5{position:relative;z-index:1;font-size:16.5px;font-weight:700;margin-bottom:8px;color:var(--night)}
.feature-card p{position:relative;z-index:1;color:var(--muted);font-size:13.5px;line-height:1.7;margin:0}

/* WORKFLOW */
.wf-nav{display:flex;background:#fff;border:1px solid var(--line);border-radius:16px 16px 0 0;overflow-x:auto}
.wf-tab{flex:1 0 170px;display:flex;align-items:center;gap:12px;border:0;border-right:1px solid var(--line);background:#fff;padding:20px;text-align:left;color:var(--muted);font-weight:600;font-size:14px;position:relative;transition:.2s}
.wf-tab:last-child{border-right:0}
.wf-tab .n{width:32px;height:32px;border-radius:10px;background:var(--baby);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex:none}
.wf-tab:hover{background:var(--baby)}
.wf-tab.active{color:#fff;background:linear-gradient(135deg,var(--deep),var(--cobalt))}
.wf-tab.active .n{background:rgba(255,255,255,.2);color:#fff}
.wf-panel{background:#fff;border:1px solid var(--line);border-top:0;border-radius:0 0 16px 16px;padding:38px;min-height:240px}
.wf-panel h3{font-size:22px;font-weight:700;color:var(--night)}
.wf-list{list-style:none;padding:0;margin:22px 0 0}
.wf-list li{display:flex;gap:10px;margin-bottom:12px}
.wf-list i{color:var(--taisho)}
.step-content{animation:fade .3s ease}
@keyframes fade{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}

/* MOCKUP */
.mock{background:#fff;border-radius:18px;box-shadow:0 24px 60px rgba(10,79,143,.2);overflow:hidden}
.mock-bar{display:flex;align-items:center;gap:6px;background:linear-gradient(90deg,var(--taisho),var(--cobalt));padding:12px 16px}
.mock-bar span{width:9px;height:9px;border-radius:50%;background:rgba(255,255,255,.4)}
.mock-bar em{margin-left:10px;color:#fff;font-size:12px;font-style:normal;font-weight:500}
.mock-body{padding:22px}
.mock-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
.badge-st{font-size:11px;font-weight:600;color:var(--cobalt);background:var(--baby);padding:4px 12px;border-radius:50px}
.mock-box{background:var(--baby);border-radius:12px;padding:16px;height:100%}
.mock-box h6{font-size:10.5px;font-weight:700;letter-spacing:.8px;color:var(--muted);margin-bottom:12px}
.skel{height:8px;border-radius:4px;background:#C5E3F5;margin-bottom:8px}
.skel.w1{width:90%}.skel.w2{width:70%}.skel.w3{width:50%}
.mini-steps{display:flex;flex-wrap:wrap;align-items:center;gap:4px;font-size:11px;font-weight:600;color:var(--muted)}
.mini-steps .on{color:var(--taisho)}
.doc-row{display:flex;align-items:center;gap:8px;font-size:12px;margin-bottom:8px}
.doc-row i{color:var(--taisho)}
.check-list{list-style:none;padding:0;margin:26px 0 0}
.check-list li{display:flex;gap:10px;margin-bottom:12px}
.check-list i{color:var(--taisho)}

/* CTA */
.cta{position:relative;overflow:hidden;color:var(--night);padding:76px 0;background:linear-gradient(120deg,#CDEBFA 0%,#8FD3F6 55%,#4DB8EC 100%)}
.cta::before{content:"";position:absolute;right:-80px;top:-120px;width:380px;height:380px;border-radius:50%;border:60px solid rgba(255,255,255,.35)}
.cta::after{content:"";position:absolute;left:30%;bottom:-160px;width:260px;height:260px;border-radius:50%;background:rgba(255,255,255,.3)}
.cta .container{position:relative;z-index:1}
.cta h2{font-size:clamp(26px,3vw,36px);font-weight:700;letter-spacing:-.6px}
.cta p{color:var(--deep);max-width:540px;margin:12px 0 0;line-height:1.75}

/* FOOTER */
.site-footer{background:linear-gradient(180deg,#DCEFFB,#C5E6F8);color:var(--ink);padding:60px 0 24px}
.site-footer .f-logo{height:34px}
.site-footer h6{font-size:11.5px;font-weight:700;letter-spacing:1.2px;color:var(--deep);margin-bottom:16px}
.site-footer p{font-size:13px;line-height:1.75;color:var(--muted)}
.site-footer a{color:var(--deep);font-weight:600;text-decoration:none;border-bottom:1px solid var(--sky)}
.site-footer a:hover{color:var(--taisho)}
.f-title{font-family:'Sora';color:var(--deep);font-size:17px;font-weight:700;margin:16px 0 2px}
.f-sub{font-size:9.5px;letter-spacing:.6px;color:var(--muted)!important}
.f-bottom{border-top:1px solid var(--sky);margin-top:36px;padding-top:20px;font-size:12px;color:var(--muted)}

/* REVEAL */
.reveal{opacity:0;transform:translateY(18px);transition:opacity .6s,transform .6s}
.reveal.visible{opacity:1;transform:none}
@media (prefers-reduced-motion:reduce){.reveal{opacity:1;transform:none;transition:none}html{scroll-behavior:auto}.step-content{animation:none}}

/* RESPONSIVE */
@media (max-width:1399px){
  .hero .carousel-indicators{padding:0 24px}
  .hero .carousel-control-prev{right:80px}.hero .carousel-control-next{right:24px}
  .hero-flow{right:24px}
}
@media (max-width:1199px){.hero-flow{display:none}}
@media (max-width:991px){
  .site-nav .navbar-collapse{padding:10px 0 16px;border-top:1px solid var(--line)}
  .site-nav .login-btn{margin:8px 0 0;display:inline-block}
  .section{padding:72px 0}
  .hero-photo{width:100%;clip-path:none;opacity:.28}
  .about-badge{right:8px}
}
@media (max-width:767px){
  .hero .carousel-item{height:auto;min-height:620px}
  .hero-content{padding:70px 0 90px}
  .hero-actions .btn-corp,.hero-actions .btn-ghost{width:100%}
  .hero .carousel-control-prev,.hero .carousel-control-next{display:none}
  .wf-panel{padding:24px 20px}
  .about-photo img{height:300px}
  .cta .btn-white{width:100%}
}
@media (max-width:420px){.brand img{height:24px}.brand-divider{display:none}}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg site-nav" id="navbar">
  <div class="container">
    <a href="{{ route('home') }}" class="brand">
      <img src="https://www.taisho.co.id/assets/frontend/images/LogoNew.png" alt="PT Taisho Pharmaceutical Indonesia">
      <span class="brand-divider"></span>
      <span class="brand-text"><strong>E-URS</strong><span>ELECTRONIC USER REQUIREMENT SPECIFICATION</span></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="bi bi-list fs-2"></i></button>
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
        <li class="nav-item"><a class="nav-link" href="#workflow">Workflow</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link login-btn" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="hero-photo p1"></div>
        <div class="hero-content"><div class="container">
          <span class="hero-label">DIGITAL PROCUREMENT SYSTEM</span>
          <h1>Streamlining <span class="hl">User Requirement</span> Specifications</h1>
          <p class="hero-desc">E-URS provides a structured digital platform for creating, reviewing, approving, and managing User Requirement Specifications within the procurement process.</p>
          <div class="hero-actions">
            <a href="{{ route('login') }}" class="btn-corp">Access E-URS <i class="bi bi-arrow-right"></i></a>
            <a href="#workflow" class="btn-ghost">Explore Workflow</a>
          </div>
        </div></div>
      </div>
      <div class="carousel-item">
        <div class="hero-photo p2"></div>
        <div class="hero-content"><div class="container">
          <span class="hero-label">STRUCTURED WORKFLOW</span>
          <h1>From Request <span class="hl">to Approval</span></h1>
          <p class="hero-desc">Organize requirement submission, review, approval, and procurement coordination in one structured process.</p>
          <div class="hero-actions">
            <a href="#workflow" class="btn-corp">Explore Workflow <i class="bi bi-arrow-right"></i></a>
            <a href="{{ route('login') }}" class="btn-ghost">Login</a>
          </div>
        </div></div>
      </div>
      <div class="carousel-item">
        <div class="hero-photo p3"></div>
        <div class="hero-content"><div class="container">
          <span class="hero-label">CENTRALIZED INFORMATION</span>
          <h1>One Process. <span class="hl">Clear Visibility.</span></h1>
          <p class="hero-desc">Keep requirement information, supporting documents, and approval progress organized throughout the procurement process.</p>
          <div class="hero-actions"><a href="{{ route('login') }}" class="btn-corp">Access E-URS <i class="bi bi-arrow-right"></i></a></div>
        </div></div>
      </div>
    </div>
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous"><span class="carousel-control-prev-icon"></span></button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next"><span class="carousel-control-next-icon"></span></button>
  </div>
  <div class="hero-flow" aria-hidden="true">
    <h6>PROCESS FLOW</h6>
    <ol>
      <li><i class="bi bi-file-earmark-text"></i>Request</li>
      <li><i class="bi bi-search"></i>Review</li>
      <li><i class="bi bi-patch-check"></i>Approval</li>
      <li><i class="bi bi-box-seam"></i>Procurement</li>
    </ol>
  </div>
</section>

<!-- ABOUT -->
<section class="section" id="about">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 reveal">
        <div class="about-photo">
          <img src="https://www.taisho.co.id/assets/frontend/images/frontoffice1.jpg?v=3" alt="PT Taisho Pharmaceutical Indonesia office">
          <div class="about-badge"><i class="bi bi-building"></i><div><strong>PT Taisho Pharmaceutical</strong><small>Indonesia</small></div></div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1 reveal">
        <span class="section-label">ABOUT E-URS</span>
        <h2 class="section-title">Digitalizing the URS Process</h2>
        <p class="section-desc mt-4">E-URS is designed to support the digitalization of the User Requirement Specification process by providing a structured environment for submitting requirements, managing approvals, monitoring request status, and maintaining procurement documentation.</p>
        <div class="mini-flow">
          <span><i class="bi bi-file-earmark-text"></i>Requirement</span>
          <span><i class="bi bi-search"></i>Review</span>
          <span><i class="bi bi-patch-check"></i>Approval</span>
          <span><i class="bi bi-box-seam"></i>Procurement</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="section bg-soft" id="features">
  <div class="container">
    <div class="mb-5 reveal" style="max-width:640px">
      <span class="section-label">KEY FEATURES</span>
      <h2 class="section-title">A Structured Approach to Procurement Requirements</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3 reveal"><div class="feature-card" data-n="01"><div class="feature-icon"><i class="bi bi-file-earmark-plus"></i></div><h5>Digital URS Submission</h5><p>Create and submit procurement requirements through a structured digital form.</p></div></div>
      <div class="col-md-6 col-lg-3 reveal"><div class="feature-card" data-n="02"><div class="feature-icon"><i class="bi bi-patch-check"></i></div><h5>Structured Approval</h5><p>Support a defined review and approval workflow for submitted requirements.</p></div></div>
      <div class="col-md-6 col-lg-3 reveal"><div class="feature-card" data-n="03"><div class="feature-icon"><i class="bi bi-activity"></i></div><h5>Request Tracking</h5><p>Monitor the progress and status of procurement requirements throughout the process.</p></div></div>
      <div class="col-md-6 col-lg-3 reveal"><div class="feature-card" data-n="04"><div class="feature-icon"><i class="bi bi-database"></i></div><h5>Centralized Documentation</h5><p>Keep requirement information and supporting documents organized in one system.</p></div></div>
    </div>
  </div>
</section>

<!-- WORKFLOW -->
<section class="section" id="workflow">
  <div class="container">
    <div class="mb-5 reveal" style="max-width:640px">
      <span class="section-label">E-URS WORKFLOW</span>
      <h2 class="section-title">From Requirement to Procurement</h2>
      <p class="section-desc mt-3">A structured process designed to support requirement submission, review, approval, and procurement activities.</p>
    </div>
    <div class="reveal">
      <div class="wf-nav">
        <button class="wf-tab active" onclick="showStep(1,this)"><span class="n">01</span>Create</button>
        <button class="wf-tab" onclick="showStep(2,this)"><span class="n">02</span>Review</button>
        <button class="wf-tab" onclick="showStep(3,this)"><span class="n">03</span>Approval</button>
        <button class="wf-tab" onclick="showStep(4,this)"><span class="n">04</span>Procurement</button>
      </div>
      <div class="wf-panel">
        <div id="step1" class="step-content"><h3>Create</h3><p class="section-desc mt-2 mb-0">User creates and submits the procurement requirement.</p>
          <ul class="wf-list"><li><i class="bi bi-check-circle-fill"></i>Enter requirement information</li><li><i class="bi bi-check-circle-fill"></i>Add specifications and supporting documents</li><li><i class="bi bi-check-circle-fill"></i>Submit the request for review</li></ul></div>
        <div id="step2" class="step-content" style="display:none"><h3>Review</h3><p class="section-desc mt-2 mb-0">Submitted information and supporting documents are reviewed.</p>
          <ul class="wf-list"><li><i class="bi bi-check-circle-fill"></i>Review submitted information</li><li><i class="bi bi-check-circle-fill"></i>Verify required documents</li><li><i class="bi bi-check-circle-fill"></i>Return or continue the request</li></ul></div>
        <div id="step3" class="step-content" style="display:none"><h3>Approval</h3><p class="section-desc mt-2 mb-0">The requirement moves through the defined approval process.</p>
          <ul class="wf-list"><li><i class="bi bi-check-circle-fill"></i>Approval notification</li><li><i class="bi bi-check-circle-fill"></i>Track approval status</li><li><i class="bi bi-check-circle-fill"></i>Maintain approval history</li></ul></div>
        <div id="step4" class="step-content" style="display:none"><h3>Procurement</h3><p class="section-desc mt-2 mb-0">Approved requirements proceed to procurement activities.</p>
          <ul class="wf-list"><li><i class="bi bi-check-circle-fill"></i>Procurement preparation</li><li><i class="bi bi-check-circle-fill"></i>Requirement coordination</li><li><i class="bi bi-check-circle-fill"></i>Process monitoring</li></ul></div>
      </div>
    </div>
  </div>
</section>

<!-- SYSTEM OVERVIEW -->
<section class="section bg-soft">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5 reveal">
        <span class="section-label">SYSTEM OVERVIEW</span>
        <h2 class="section-title">Built for a Structured Procurement Process</h2>
        <p class="section-desc mt-4"><strong style="color:var(--night)">One structured process, from request to procurement.</strong> E-URS centralizes the requirement process and helps users and procurement teams manage information more systematically.</p>
        <ul class="check-list">
          <li><i class="bi bi-check-circle-fill"></i>Centralized requirement information</li>
          <li><i class="bi bi-check-circle-fill"></i>Clear approval status</li>
          <li><i class="bi bi-check-circle-fill"></i>Organized supporting documents</li>
        </ul>
      </div>
      <div class="col-lg-7 reveal">
        <div class="mock" aria-hidden="true">
          <div class="mock-bar"><span></span><span></span><span></span><em>E-URS · URS Request</em></div>
          <div class="mock-body">
            <div class="mock-head"><strong>URS Request</strong><span class="badge-st">Interface illustration</span></div>
            <div class="row g-3">
              <div class="col-sm-6"><div class="mock-box"><h6>REQUEST INFORMATION</h6><div class="skel w1"></div><div class="skel w2"></div><div class="skel w3"></div></div></div>
              <div class="col-sm-6"><div class="mock-box"><h6>SPECIFICATION</h6><div class="skel w1"></div><div class="skel w1"></div><div class="skel w2"></div></div></div>
              <div class="col-sm-6"><div class="mock-box"><h6>APPROVAL STATUS</h6><div class="mini-steps"><span class="on">Request</span><i class="bi bi-chevron-right"></i><span class="on">Review</span><i class="bi bi-chevron-right"></i><span>Approval</span><i class="bi bi-chevron-right"></i><span>Procurement</span></div></div></div>
              <div class="col-sm-6"><div class="mock-box"><h6>SUPPORTING DOCUMENTS</h6><div class="doc-row"><i class="bi bi-file-earmark-text"></i>Document</div><div class="doc-row mb-0"><i class="bi bi-file-earmark-text"></i>Document</div></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-8"><h2>Access the E-URS System</h2><p>Submit and manage User Requirement Specifications through the digital procurement platform.</p></div>
      <div class="col-lg-4 text-lg-end"><a href="{{ route('login') }}" class="btn-corp btn-white">Login to E-URS <i class="bi bi-arrow-right"></i></a></div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-4">
        <img class="f-logo" src="https://www.taisho.co.id/assets/frontend/images/LogoNew.png" alt="PT Taisho Pharmaceutical Indonesia">
        <div class="f-title">E-URS</div>
        <p class="f-sub mb-3">ELECTRONIC USER REQUIREMENT SPECIFICATION</p>
        <p>PT Taisho Pharmaceutical Indonesia</p>
      </div>
      <div class="col-md-7 col-lg-5">
        <h6>OUR OFFICE</h6>
        <p>Millennium Centennial Center 8th floor, Jl. Jend. Sudirman Kav. 25, Jakarta 12920.<br>Phone: 021-3970 6720</p>
        <p>Jl. Raya Bogor Km. 38, Tapos, Kota Depok,<br>Jawa Barat 16458. Phone: 021-875 2583/2584</p>
      </div>
      <div class="col-md-5 col-lg-3">
        <h6>CONTACT</h6>
        <p>For further information, please contact us at</p>
        <a href="mailto:corporate.secretary@ma.taisho.co.id">corporate.secretary@ma.taisho.co.id</a>
      </div>
    </div>
    <div class="f-bottom">&copy; {{ date('Y') }} PT Taisho Pharmaceutical Indonesia. All rights reserved.</div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const navbar=document.getElementById('navbar');
window.addEventListener('scroll',()=>navbar.classList.toggle('scrolled',window.scrollY>10));
function showStep(step,button){
  document.querySelectorAll('.step-content').forEach(el=>el.style.display='none');
  document.getElementById('step'+step).style.display='block';
  document.querySelectorAll('.wf-tab').forEach(el=>el.classList.remove('active'));
  button.classList.add('active');
}
document.querySelectorAll('.navbar-nav .nav-link').forEach(link=>{
  link.addEventListener('click',()=>{
    const c=bootstrap.Collapse.getInstance(document.getElementById('navbarMenu'));
    if(c)c.hide();
  });
});
(function(){
  const items=document.querySelectorAll('.reveal');
  if(!('IntersectionObserver' in window)){items.forEach(el=>el.classList.add('visible'));return;}
  const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);}}),{threshold:.12});
  items.forEach(el=>io.observe(el));
})();
</script>
</body>
</html>