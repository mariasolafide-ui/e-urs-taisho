<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>E-URS | Sign In</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4faff;
            overflow-x: hidden;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
        }


        /* =========================================================
           LEFT PANEL
        ========================================================= */

        .brand-panel {
            width: 52%;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 70px;

            background:
                linear-gradient(
                    145deg,
                    #8ed8f8 0%,
                    #55bde8 45%,
                    #197db8 100%
                );

            color: white;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
            top: -180px;
            left: -180px;
        }

        .brand-panel::after {
            content: "";
            position: absolute;
            width: 650px;
            height: 650px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            right: -350px;
            bottom: -300px;
        }

        .brand-content {
            position: relative;
            z-index: 2;
            max-width: 620px;
        }

        .company-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            padding: 9px 16px;

            border: 1px solid rgba(255,255,255,.35);
            background: rgba(255,255,255,.12);

            border-radius: 50px;

            font-size: 13px;
            font-weight: 600;
            letter-spacing: .4px;

            margin-bottom: 32px;

            backdrop-filter: blur(8px);
        }

        .company-label i {
            font-size: 16px;
        }

        .brand-title {
            font-size: clamp(42px, 5vw, 72px);
            line-height: 1.02;
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 24px;
        }

        .brand-title span {
            display: block;
            font-weight: 300;
        }

        .brand-description {
            font-size: 17px;
            line-height: 1.8;
            color: rgba(255,255,255,.92);
            max-width: 530px;
            margin-bottom: 42px;
        }

        .feature-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .feature-item {
            padding: 11px 16px;

            border-radius: 12px;

            background: rgba(255,255,255,.13);
            border: 1px solid rgba(255,255,255,.20);

            font-size: 13px;
            font-weight: 500;

            backdrop-filter: blur(7px);
        }

        .feature-item i {
            margin-right: 6px;
        }

        .copyright {
            position: absolute;
            bottom: 28px;
            left: 70px;
            z-index: 2;

            font-size: 12px;
            color: rgba(255,255,255,.75);
        }


        /* =========================================================
           RIGHT PANEL
        ========================================================= */

        .login-panel {
            width: 48%;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;

            background: #ffffff;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .mobile-brand {
            display: none;
        }

        .login-heading {
            margin-bottom: 34px;
        }

        .login-heading h2 {
            color: #123b58;
            font-size: 32px;
            font-weight: 750;
            margin-bottom: 9px;
        }

        .login-heading p {
            color: #7891a2;
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .form-label {
            color: #31566d;
            font-size: 13px;
            font-weight: 650;
            margin-bottom: 9px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .input-icon {
            position: absolute;

            left: 16px;
            top: 50%;

            transform: translateY(-50%);

            color: #76a6c0;

            z-index: 5;

            font-size: 17px;
        }

        .form-control-custom {
            width: 100%;
            height: 54px;

            padding: 0 47px;

            border: 1px solid #dcecf5;
            border-radius: 13px;

            background: #fafdff;

            color: #173f57;

            font-size: 14px;

            outline: none;

            transition: all .2s ease;
        }

        .form-control-custom:focus {
            border-color: #55bde8;

            background: #fff;

            box-shadow:
                0 0 0 4px rgba(85,189,232,.12);
        }

        .form-control-custom::placeholder {
            color: #a9bbc6;
        }

        .password-toggle {
            position: absolute;

            right: 15px;
            top: 50%;

            transform: translateY(-50%);

            border: none;
            background: transparent;

            color: #89a7b7;

            padding: 5px;

            cursor: pointer;

            z-index: 5;
        }

        .password-toggle:hover {
            color: #247da9;
        }


        /* =========================================================
           CHECKBOX
        ========================================================= */

        .form-check-input {
            border-color: #cbdfe9;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #2997ca;
            border-color: #2997ca;
        }

        .form-check-label {
            color: #708898;
            font-size: 13px;
            cursor: pointer;
        }

        .forgot-link {
            color: #2389ba;
            text-decoration: none;

            font-size: 13px;
            font-weight: 600;
        }

        .forgot-link:hover {
            color: #176d98;
        }


        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .btn-login {
            width: 100%;
            height: 54px;

            border: none;
            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    #42b8e7,
                    #167bb4
                );

            color: white;

            font-size: 14px;
            font-weight: 700;

            letter-spacing: .2px;

            box-shadow:
                0 8px 20px rgba(34,143,190,.22);

            transition: all .25s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(34,143,190,.28);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            margin-left: 7px;
        }


        /* =========================================================
           REGISTER
        ========================================================= */

        .register-note {
            text-align: center;

            margin-top: 20px;

            color: #879ba7;

            font-size: 13px;
        }

        .register-link {
            color: #2389ba;

            text-decoration: none;

            font-weight: 700;

            margin-left: 4px;
        }

        .register-link:hover {
            color: #176d98;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .alert-custom {
            border: none;

            border-radius: 12px;

            background: #fff1f1;

            color: #b64949;

            font-size: 13px;

            padding: 13px 15px;
        }


        /* =========================================================
           SECURITY
        ========================================================= */

        .security-note {
            display: flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            color: #91a5b1;

            font-size: 12px;

            margin-top: 24px;
        }

        .security-note i {
            color: #53a5c8;
        }


        /* =========================================================
           BACK HOME
        ========================================================= */

        .back-home {
            display: block;

            text-align: center;

            margin-top: 22px;

            color: #7893a3;

            text-decoration: none;

            font-size: 13px;

            transition: color .2s;
        }

        .back-home:hover {
            color: #2285b4;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 992px) {

            .brand-panel {
                width: 45%;
                padding: 45px;
            }

            .login-panel {
                width: 55%;
                padding: 35px;
            }

            .copyright {
                left: 45px;
            }

            .brand-title {
                font-size: 48px;
            }

        }


        @media (max-width: 768px) {

            .login-wrapper {
                display: block;
            }

            .brand-panel {
                display: none;
            }

            .login-panel {
                width: 100%;
                min-height: 100vh;

                padding: 30px 22px;
            }

            .mobile-brand {
                display: block;

                margin-bottom: 38px;

                text-align: center;
            }

            .mobile-brand .logo {
                width: 55px;
                height: 55px;

                margin: 0 auto 15px;

                border-radius: 16px;

                display: flex;
                align-items: center;
                justify-content: center;

                color: white;

                font-size: 25px;

                background:
                    linear-gradient(
                        135deg,
                        #62c8ee,
                        #187eb7
                    );

                box-shadow:
                    0 8px 20px rgba(31,143,190,.20);
            }

            .mobile-brand h1 {
                color: #123b58;

                font-size: 25px;
                font-weight: 800;

                margin: 0;
            }

            .mobile-brand p {
                color: #8399a7;

                font-size: 12px;

                margin-top: 5px;
            }

            .login-heading h2 {
                font-size: 28px;
            }

        }

    </style>

</head>


<body>

<div class="login-wrapper">


    <!-- =========================================================
         LEFT BRAND PANEL
    ========================================================== -->

    <section class="brand-panel">

        <div class="brand-content">

            <div class="company-label">

                <i class="bi bi-buildings"></i>

                PT TAISHO PHARMACEUTICAL INDONESIA Tbk

            </div>


            <h1 class="brand-title">

                E-URS

                <span>
                    Procurement Portal
                </span>

            </h1>


            <p class="brand-description">

                A centralized digital platform for managing
                User Requirement Specifications and procurement
                processes in a structured, transparent, and efficient way.

            </p>


            <div class="feature-list">

                <div class="feature-item">
                    <i class="bi bi-file-earmark-text"></i>
                    Digital URS
                </div>

                <div class="feature-item">
                    <i class="bi bi-shield-check"></i>
                    Secure Workflow
                </div>

                <div class="feature-item">
                    <i class="bi bi-check2-circle"></i>
                    Approval Tracking
                </div>

                <div class="feature-item">
                    <i class="bi bi-filetype-pdf"></i>
                    PDF Documentation
                </div>

            </div>

        </div>


        <div class="copyright">

            © {{ date('Y') }}
            PT Taisho Pharmaceutical Indonesia Tbk.

        </div>

    </section>



    <!-- =========================================================
         RIGHT PANEL
    ========================================================== -->

    <section class="login-panel">

        <div class="login-container">


            <!-- MOBILE BRAND -->

            <div class="mobile-brand">

                <div class="logo">

                    <i class="bi bi-file-earmark-check"></i>

                </div>

                <h1>
                    E-URS
                </h1>

                <p>
                    Electronic User Requirement Specification
                </p>

            </div>



            <!-- LOGIN HEADING -->

            <div class="login-heading">

                <h2>
                    Welcome back
                </h2>

                <p>
                    Sign in to continue to the E-URS Procurement Portal.
                </p>

            </div>



            <!-- VALIDATION ERROR -->

            @if ($errors->any())

                <div class="alert alert-custom mb-4">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    {{ $errors->first() }}

                </div>

            @endif



            <!-- LOGIN FORM -->

            <form
                action="{{ route('login.process') }}"
                method="POST"
            >

                @csrf


                <!-- EMAIL -->

                <div class="mb-4">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email Address
                    </label>


                    <div class="input-group-custom">

                        <i class="bi bi-envelope input-icon"></i>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control-custom"
                            placeholder="Enter your email address"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>



                <!-- PASSWORD -->

                <div class="mb-3">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Password
                    </label>


                    <div class="input-group-custom">

                        <i class="bi bi-lock input-icon"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control-custom"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Show password"
                        >

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>



                <!-- REMEMBER / FORGOT -->

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <label
                            class="form-check-label"
                            for="remember"
                        >
                            Remember Me
                        </label>

                    </div>


                    <a
                        href="#"
                        class="forgot-link"
                        onclick="return false;"
                    >
                        Forgot password?
                    </a>

                </div>



                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="btn-login"
                >

                    Sign In

                    <i class="bi bi-arrow-right"></i>

                </button>

            </form>



            <!-- REGISTER -->

            <div class="register-note">

                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="register-link"
                >
                    Create an account
                </a>

            </div>



            <!-- SECURITY -->

            <div class="security-note">

                <i class="bi bi-shield-lock"></i>

                <span>
                    Your connection is protected and secure.
                </span>

            </div>



            <!-- BACK HOME -->

            <a
                href="{{ route('home') }}"
                class="back-home"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Back to homepage

            </a>

        </div>

    </section>

</div>



<!-- =========================================================
     JAVASCRIPT
========================================================== -->

<script>

    const passwordInput =
        document.getElementById('password');

    const togglePassword =
        document.getElementById('togglePassword');


    togglePassword.addEventListener('click', function () {

        const icon =
            this.querySelector('i');


        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            icon.classList.remove('bi-eye');

            icon.classList.add('bi-eye-slash');

            this.setAttribute(
                'aria-label',
                'Hide password'
            );

        } else {

            passwordInput.type = 'password';

            icon.classList.remove('bi-eye-slash');

            icon.classList.add('bi-eye');

            this.setAttribute(
                'aria-label',
                'Show password'
            );

        }

    });

</script>


</body>

</html>
