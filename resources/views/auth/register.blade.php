<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>E-URS | Create Account</title>

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
            color: #17405a;
        }

        a,
        button,
        input {
            outline: none;
        }

        a:focus-visible,
        button:focus-visible,
        input:focus-visible {
            outline: 2px solid #2997ca;
            outline-offset: 2px;
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .register-wrapper {
            min-height: 100vh;
            display: flex;
        }


        /* =========================================================
           LEFT BRAND PANEL
        ========================================================= */

        .brand-panel {
            width: 46%;
            min-height: 100vh;

            position: relative;
            overflow: hidden;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            padding: 55px 65px;

            color: #ffffff;

            background:
                linear-gradient(
                    145deg,
                    #8ed8f8 0%,
                    #55bde8 45%,
                    #197db8 100%
                );
        }

        .brand-panel::before {
            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            background: rgba(255,255,255,.10);

            top: -200px;
            left: -200px;
        }

        .brand-panel::after {
            content: "";

            position: absolute;

            width: 650px;
            height: 650px;

            border-radius: 50%;

            background: rgba(255,255,255,.08);

            right: -350px;
            bottom: -350px;
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .company-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 9px 15px;

            border-radius: 50px;

            border: 1px solid rgba(255,255,255,.35);

            background: rgba(255,255,255,.12);

            backdrop-filter: blur(8px);

            font-size: 12px;
            font-weight: 600;

            letter-spacing: .3px;

            margin-bottom: 38px;
        }

        .company-label i {
            font-size: 15px;
        }


        .brand-title {
            margin: 0 0 22px;

            font-size: clamp(44px, 5vw, 70px);

            line-height: 1.02;

            font-weight: 800;

            letter-spacing: -2px;
        }

        .brand-title span {
            display: block;

            font-weight: 300;

            letter-spacing: -1.5px;
        }


        .brand-description {
            max-width: 520px;

            margin: 0 0 38px;

            font-size: 16px;

            line-height: 1.8;

            color: rgba(255,255,255,.92);
        }


        /* =========================================================
           FEATURES
        ========================================================= */

        .feature-list {
            display: flex;
            flex-wrap: wrap;

            gap: 10px;
        }

        .feature-item {
            padding: 10px 14px;

            border-radius: 10px;

            border: 1px solid rgba(255,255,255,.20);

            background: rgba(255,255,255,.13);

            backdrop-filter: blur(7px);

            font-size: 12px;

            font-weight: 500;
        }

        .feature-item i {
            margin-right: 5px;
        }


        /* =========================================================
           COPYRIGHT
        ========================================================= */

        .copyright {
            position: relative;
            z-index: 2;

            font-size: 11.5px;

            color: rgba(255,255,255,.75);
        }


        /* =========================================================
           RIGHT PANEL
        ========================================================= */

        .register-panel {
            width: 54%;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 45px 60px;

            background: #ffffff;
        }

        .register-container {
            width: 100%;
            max-width: 510px;
        }


        /* =========================================================
           MOBILE BRAND
        ========================================================= */

        .mobile-brand {
            display: none;

            text-align: center;

            margin-bottom: 30px;
        }

        .mobile-brand .logo {
            width: 54px;
            height: 54px;

            margin: 0 auto 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            color: #ffffff;

            font-size: 24px;

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
            margin: 0;

            color: #123b58;

            font-size: 25px;

            font-weight: 800;
        }

        .mobile-brand p {
            margin: 5px 0 0;

            color: #8399a7;

            font-size: 12px;
        }


        /* =========================================================
           HEADING
        ========================================================= */

        .register-heading {
            margin-bottom: 27px;
        }

        .register-heading h2 {
            margin: 0 0 8px;

            color: #123b58;

            font-size: 30px;

            font-weight: 750;

            letter-spacing: -.5px;
        }

        .register-heading p {
            margin: 0;

            color: #7891a2;

            font-size: 14px;

            line-height: 1.6;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .alert-custom {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            padding: 13px 15px;

            margin-bottom: 20px;

            border: none;

            border-radius: 11px;

            font-size: 13px;

            line-height: 1.5;
        }

        .alert-error {
            color: #b64949;

            background: #fff1f1;

            border: 1px solid #f7d8d8;
        }

        .alert-success {
            color: #368051;

            background: #edf9f1;

            border: 1px solid #ccebd7;
        }

        .alert-custom ul {
            padding: 0;
            margin: 0;

            list-style: none;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .form-field {
            margin-bottom: 17px;
        }

        .form-label-custom {
            display: block;

            margin-bottom: 8px;

            color: #31566d;

            font-size: 13px;

            font-weight: 650;
        }


        .input-wrapper {
            position: relative;
        }

        .input-wrapper > .input-icon {
            position: absolute;

            left: 16px;
            top: 50%;

            transform: translateY(-50%);

            color: #76a6c0;

            font-size: 17px;

            pointer-events: none;

            z-index: 2;
        }


        .form-control-custom {
            width: 100%;

            height: 50px;

            padding: 0 17px 0 47px;

            border: 1px solid #dcecf5;

            border-radius: 11px;

            background: #fafdff;

            color: #173f57;

            font-size: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-control-custom::placeholder {
            color: #a9bbc6;
        }

        .form-control-custom:focus {
            border-color: #55bde8;

            background: #ffffff;

            box-shadow:
                0 0 0 4px rgba(85,189,232,.12);
        }


        /* =========================================================
           PASSWORD
        ========================================================= */

        .password-toggle {
            position: absolute;

            right: 10px;
            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            color: #89a7b7;

            padding: 6px 8px;

            cursor: pointer;

            z-index: 3;
        }

        .password-toggle:hover {
            color: #247da9;
        }


        /* =========================================================
           ROLE
        ========================================================= */

        .role-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 10px;
        }

        .role-option {
            position: relative;
        }

        .role-option input {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }

        .role-card {
            min-height: 92px;

            padding: 13px 8px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            text-align: center;

            border: 1px solid #dcecf5;

            border-radius: 11px;

            background: #ffffff;

            cursor: pointer;

            transition:
                border-color .2s ease,
                background .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .role-card:hover {
            border-color: #8acbe7;

            transform: translateY(-1px);
        }

        .role-card i {
            margin-bottom: 7px;

            color: #55bde8;

            font-size: 21px;
        }

        .role-card strong {
            color: #31566d;

            font-size: 12.5px;

            font-weight: 700;
        }

        .role-card span {
            margin-top: 3px;

            color: #8aa0ae;

            font-size: 10.5px;
        }

        .role-option input:checked + .role-card {
            border-color: #2997ca;

            background: #f0faff;

            box-shadow:
                inset 0 0 0 1px #2997ca;
        }

        .role-option input:checked + .role-card i {
            color: #197db8;
        }

        .role-option input:focus-visible + .role-card {
            outline: 2px solid #2997ca;

            outline-offset: 2px;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-register {
            width: 100%;

            height: 52px;

            margin-top: 4px;

            border: none;

            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #42b8e7,
                    #167bb4
                );

            color: #ffffff;

            font-size: 14px;

            font-weight: 700;

            letter-spacing: .15px;

            box-shadow:
                0 8px 20px rgba(34,143,190,.20);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);

            box-shadow:
                0 11px 24px rgba(34,143,190,.27);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register:disabled {
            opacity: .7;

            cursor: not-allowed;

            transform: none;
        }


        /* =========================================================
           LOGIN LINK
        ========================================================= */

        .login-note {
            text-align: center;

            margin-top: 20px;

            color: #879ba7;

            font-size: 13px;
        }

        .login-note a {
            color: #2389ba;

            font-weight: 700;

            text-decoration: none;

            margin-left: 4px;
        }

        .login-note a:hover {
            color: #176d98;

            text-decoration: underline;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .security-note {
            display: flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            margin-top: 22px;

            color: #91a5b1;

            font-size: 11.5px;
        }

        .security-note i {
            color: #53a5c8;
        }

        .back-home {
            display: block;

            margin-top: 17px;

            text-align: center;

            color: #7893a3;

            text-decoration: none;

            font-size: 12.5px;
        }

        .back-home:hover {
            color: #2285b4;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1050px) {

            .brand-panel {
                width: 44%;

                padding:
                    45px;
            }

            .register-panel {
                width: 56%;

                padding:
                    40px;
            }

            .brand-description {
                font-size: 15px;
            }

        }


        @media (max-width: 800px) {

            .brand-panel {
                display: none;
            }

            .register-panel {
                width: 100%;

                min-height: 100vh;

                padding:
                    35px 25px;
            }

            .mobile-brand {
                display: block;
            }

            .register-container {
                max-width: 520px;
            }

        }


        @media (max-width: 500px) {

            .register-panel {
                padding:
                    28px 20px;
            }

            .register-heading h2 {
                font-size: 27px;
            }

            .role-grid {
                grid-template-columns:
                    1fr;
            }

            .role-card {
                min-height: 70px;

                flex-direction: row;

                justify-content: flex-start;

                gap: 12px;

                padding:
                    12px 16px;

                text-align: left;
            }

            .role-card i {
                margin: 0;
            }

            .role-card span {
                margin-top: 0;
                margin-left: auto;
            }

        }

    </style>

</head>


<body>


<div class="register-wrapper">


    <!-- =========================================================
         LEFT PANEL
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

                Create an account to access the
                Electronic User Requirement Specification
                and support a structured procurement workflow.

            </p>


            <div class="feature-list">


                <div class="feature-item">

                    <i class="bi bi-person-plus"></i>

                    Account Registration

                </div>


                <div class="feature-item">

                    <i class="bi bi-envelope-check"></i>

                    Email Verification

                </div>


                <div class="feature-item">

                    <i class="bi bi-shield-check"></i>

                    Secure Access

                </div>


                <div class="feature-item">

                    <i class="bi bi-file-earmark-text"></i>

                    Digital URS

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

    <section class="register-panel">


        <div class="register-container">


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



            <!-- HEADING -->

            <div class="register-heading">

                <h2>
                    Create your account
                </h2>

                <p>
                    Register to access the E-URS Procurement Portal.
                </p>

            </div>



            <!-- SUCCESS MESSAGE -->

            @if (session('success') || session('status'))

                <div class="alert-custom alert-success">

                    <i class="bi bi-check-circle-fill"></i>

                    <div>
                        {{ session('success') ?? session('status') }}
                    </div>

                </div>

            @endif



            <!-- VALIDATION ERRORS -->

            @if ($errors->any())

                <div class="alert-custom alert-error">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <!-- REGISTER FORM -->

            <form
                action="{{ route('register.process') }}"
                method="POST"
                id="registerForm"
            >

                @csrf


                <!-- NAME -->

                <div class="form-field">

                    <label
                        for="name"
                        class="form-label-custom"
                    >
                        Full Name
                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-person input-icon"></i>


                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control-custom"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            autocomplete="name"
                            autofocus
                            required
                        >

                    </div>

                </div>



                <!-- EMAIL -->

                <div class="form-field">

                    <label
                        for="email"
                        class="form-label-custom"
                    >
                        Email Address
                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-envelope input-icon"></i>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control-custom"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>



                <!-- DEPARTMENT -->

                <div class="form-field">

                    <label
                        for="department"
                        class="form-label-custom"
                    >
                        Department
                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-building input-icon"></i>


                        <input
                            type="text"
                            id="department"
                            name="department"
                            class="form-control-custom"
                            value="{{ old('department') }}"
                            placeholder="Enter your department"
                            autocomplete="organization"
                            required
                        >

                    </div>

                </div>



                <!-- ROLE -->

                <div class="form-field">

                    <span class="form-label-custom">
                        Role
                    </span>


                    <div class="role-grid">


                        <!-- USER -->

                        <label class="role-option">

                            <input
                                type="radio"
                                name="role"
                                value="user"
                                {{ old('role') === 'user' ? 'checked' : '' }}
                                required
                            >

                            <div class="role-card">

                                <i class="bi bi-person"></i>

                                <strong>
                                    User
                                </strong>

                                <span>
                                    Requester
                                </span>

                            </div>

                        </label>



                        <!-- PROCUREMENT -->

                        <label class="role-option">

                            <input
                                type="radio"
                                name="role"
                                value="procurement"
                                {{ old('role') === 'procurement' ? 'checked' : '' }}
                                required
                            >

                            <div class="role-card">

                                <i class="bi bi-briefcase"></i>

                                <strong>
                                    Procurement
                                </strong>

                                <span>
                                    Processor
                                </span>

                            </div>

                        </label>



                        <!-- EHS -->

                        <label class="role-option">

                            <input
                                type="radio"
                                name="role"
                                value="ehs"
                                {{ old('role') === 'ehs' ? 'checked' : '' }}
                                required
                            >

                            <div class="role-card">

                                <i class="bi bi-shield-check"></i>

                                <strong>
                                    EHS
                                </strong>

                                <span>
                                    Reviewer
                                </span>

                            </div>

                        </label>


                    </div>

                </div>



                <!-- PASSWORD -->

                <div class="form-field">

                    <label
                        for="password"
                        class="form-label-custom"
                    >
                        Password
                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-lock input-icon"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control-custom"
                            placeholder="Minimum 8 characters"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password"
                            aria-label="Show password"
                        >

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>



                <!-- CONFIRM PASSWORD -->

                <div class="form-field">

                    <label
                        for="password_confirmation"
                        class="form-label-custom"
                    >
                        Confirm Password
                    </label>


                    <div class="input-wrapper">

                        <i class="bi bi-lock-fill input-icon"></i>


                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control-custom"
                            placeholder="Repeat your password"
                            autocomplete="new-password"
                            required
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password_confirmation"
                            aria-label="Show password"
                        >

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>



                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="btn-register"
                    id="registerButton"
                >

                    <i class="bi bi-person-plus"></i>

                    Create Account

                </button>


            </form>



            <!-- LOGIN -->

            <div class="login-note">

                Already have an account?

                <a href="{{ route('login') }}">
                    Sign In
                </a>

            </div>



            <!-- SECURITY -->

            <div class="security-note">

                <i class="bi bi-shield-lock"></i>

                <span>
                    Your account information is protected.
                </span>

            </div>



            <!-- HOME -->

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


    /*
    |--------------------------------------------------------------------------
    | PASSWORD TOGGLE
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.password-toggle')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const target =
                    document.getElementById(
                        this.dataset.target
                    );

                const icon =
                    this.querySelector('i');


                if (target.type === 'password') {

                    target.type = 'text';

                    icon.classList.remove(
                        'bi-eye'
                    );

                    icon.classList.add(
                        'bi-eye-slash'
                    );

                    this.setAttribute(
                        'aria-label',
                        'Hide password'
                    );

                } else {

                    target.type = 'password';

                    icon.classList.remove(
                        'bi-eye-slash'
                    );

                    icon.classList.add(
                        'bi-eye'
                    );

                    this.setAttribute(
                        'aria-label',
                        'Show password'
                    );

                }

            });

        });



    /*
    |--------------------------------------------------------------------------
    | DISABLE BUTTON AFTER SUBMIT
    |--------------------------------------------------------------------------
    */

    const registerForm =
        document.getElementById('registerForm');

    const registerButton =
        document.getElementById('registerButton');


    registerForm.addEventListener(
        'submit',
        function () {

            registerButton.disabled = true;

            registerButton.innerHTML = `
                <span
                    class="spinner-border spinner-border-sm"
                    aria-hidden="true"
                ></span>

                Creating account...
            `;

        }
    );

</script>


</body>

</html>
