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

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md  fixed-top navbar-light bg-primary shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->

                <a class="navbar-brand d-flex align-items-center p-0" href="{{ url('home/ideas') }}">
                    <img src="/img/diy-logo.png" width="50" height="50" alt="Do it Yourself logo">
                    <span class="pt-2 text-yellow"> Do It Yourself</span>
                </a>

                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto flex-row">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item mr-3">
                        <a class="nav-link " href="{{ route('login') }}"><span class="text-yellow">{{ __('Login') }}</span></a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-yellow " href="{{ route('register') }}">
                            <span class="text-yellow">{{ __('Register') }}</span></a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item d-flex align-items-center mr-sm-1 mr-md-0">
                        <a href="/profile/{{Auth::user()->id}}">
                            <div class="nav-profile-image">
                                <img src="{{ Auth::user()->profileImage()}}" width="30" height="30" alt="Do it Yourself logo" class="rounded-circle">
                            </div>

                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-yellow" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="text-yellow">{{ Auth::user()->username }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="/profile/{{Auth::user()->id}}" class="dropdown-item text-primary">Your Profile</a>
                            <a class="dropdown-item text-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
                <!-- </div> -->
            </div>
        </nav>

        <main class="main">
            @yield('content')
        </main>
    </div>



</body>

</html>
