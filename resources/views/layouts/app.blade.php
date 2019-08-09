<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('SVS', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<style>
    .hiddenX {
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s 2s, opacity 2s linear;
    }
}
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SVS
                </a>
                @if(!(Auth::check()))
                    <button class="btn border-dark disabled" style="cursor: not-allowed;margin: 8px">
                        Home
                    </button>
                    <button class="btn border-dark disabled" style="cursor: not-allowed;">
                        Zum Dashboard
                    </button>
                    <hr style="border-left: 2px dashed #5e5e5e;height: 2vw;margin-left: 8px">
                    <div class="dropdown m-2">
                        <button class="disabled btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: not-allowed;">
                            Verwaltung
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="managerp">Regalplätze verwalten</a>
                            <a class="dropdown-item" href="managekey">Schlüssel verwalten</a>
                            <a class="dropdown-item" href="manageuser">Nutzer verwalten</a>
                        </div>
                    </div>
                @else
                    <a href="/home">
                        <button class="btn border-dark" style="margin: 8px">
                            Home
                        </button>
                    </a>
                    <a href="/dashboard">
                        <button class="btn border-dark">
                            Zum Dashboard
                        </button>
                    </a>
                    <hr style="border-left: 2px dashed #5e5e5e;height: 2vw;margin-left: 8px">
                    <div class="dropdown m-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Verwaltung
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="managerp">Regalplätze verwalten</a>
                            <a class="dropdown-item" href="managekey">Schlüssel verwalten</a>
                            <a class="dropdown-item" href="managekeyperms">Schlüsselrechte verwalten</a>
                            <a class="dropdown-item" href="manageuser">Nutzer verwalten</a>
                            <a class="dropdown-item" href="keyhistory">Schlüsselhistorie anzeigen</a>
                        </div>
                    </div>
                @endif
                @if (Session::has('errorNotLoggedIn'))
                    <div class="alert alert-warning m-2 text-center hiddenX">{{Session::get('errorNotLoggedIn')}}
                    </div>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
