<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Do It YourSelf</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="welcome-page">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="jumbotron mx-3">
                <h1 class="display-md-4 display-5">Welcome to Do-It-Yourself</h1>
                <p class="lead text-center">A community that you can get and share DIY ideas.</p>
                <hr class="my-4">
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary btn-lg text-yellow" href="/login" role="button">Login</a>
                    <a class="btn btn-primary btn-lg text-yellow" href="/register" role="button">Register</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
