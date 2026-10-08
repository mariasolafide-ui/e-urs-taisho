<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>E-URS | Verify Email</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .verification-card {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            border-radius: 24px;
            padding: 48px 42px;
            text-align: center;
            box-shadow: 0 15px 45px rgba(24, 110, 155, .10);
            border: 1px solid #e5f1f7;
        }

        .verification-icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 25px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(
                135deg,
                #62c8ee,
                #187eb7
            );
            color: #ffffff;
            font-size: 34px;
            box-shadow: 0 10px 25px rgba(31, 143, 190, .20);
        }

        h1 {
            color: #123b58;
            font-size: 28px;
            font-weight: 750;
            margin-bottom: 12px;
        }

        .description {
            color: #718b9b;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .email-box {
            background: #f5fbff;
            border: 1px solid #dceef7;
            border-radius: 12px;
            padding: 13px 16px;
            color: #247da9;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
            word-break: break-word;
        }

        .btn-resend {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(
                135deg,
                #42b8e7,
                #167bb4
            );
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-resend:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(34, 143, 190, .20);
        }

        .status {
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 10px;
            background: #edf9f1;
            color: #368051;
            font-size: 13px;
        }

        .back-login {
            display: inline-block;
            margin-top: 22px;
            color: #6f8999;
            text-decoration: none;
            font-size: 13px;
        }

        .back-login:hover {
            color: #2385b4;
        }

    </style>

</head>

<body>

<div class="verification-card">

    <div class="verification-icon">

        <i class="bi bi-envelope-check"></i>

    </div>


    <h1>
        Verify Your Email
    </h1>


    <p class="description">

        We have sent a verification link to your email address.
        Please check your inbox and click the verification link
        to activate your E-URS account.

    </p>


    <div class="email-box">

        {{ auth()->user()->email }}

    </div>


    @if (session('status'))

        <div class="status">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('status') }}

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('verification.send') }}"
    >

        @csrf

        <button
            type="submit"
            class="btn-resend"
        >

            <i class="bi bi-send me-1"></i>

            Resend Verification Email

        </button>

    </form>


    <a
        href="{{ route('login') }}"
        class="back-login"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Back to Sign In

    </a>

</div>

</body>

</html>