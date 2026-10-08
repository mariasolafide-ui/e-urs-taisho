<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-URS | Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-5">

                <h2 class="fw-bold">
                    Welcome, {{ Auth::user()->name }}
                </h2>

                <p class="text-muted mb-1">
                    You are successfully logged in to E-URS.
                </p>

                <p>
                    Role:
                    <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                </p>

                <hr>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Sign Out
                    </button>
                </form>

            </div>

        </div>

    </div>

</body>
</html>