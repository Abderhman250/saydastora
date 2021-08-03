<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sayd Austora') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    {{-- <script src="{{ asset('js/dashbord.js') }}" defer></script> --}}
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dashbord/style.css') }}" rel="stylesheet">

</head>
<body>

    <div id="app">



        <main class="py-4">
            <div class="flash-message">

                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
            </div>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand">
                        Sayd Aostra
                    </a>
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
                                {{-- @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif --}}
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
            <div id="accordian">
                <ul class="show-dropdown">
                    <li>
                        <a href="/home"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="/users"><i class="far fa-address-book"></i>Users</a>
                        {{-- <ul>
                            <li><a href="javascript:void(0);">Reports</a></li>
                            <li><a href="javascript:void(0);">Search</a></li>
                            <li><a href="javascript:void(0);">Graphs</a></li>
                            <li><a href="javascript:void(0);">Settings</a></li>
                        </ul> --}}
                    </li>
                    <li>
                        <a href="/questions"><i class="far fa-address-book"></i>Questions & Answers</a>
                        {{-- <ul>
                            <li><a href="javascript:void(0);">Reports</a></li>
                            <li><a href="javascript:void(0);">Search</a></li>
                            <li><a href="javascript:void(0);">Graphs</a></li>
                            <li><a href="javascript:void(0);">Settings</a></li>
                        </ul> --}}
                    </li>
                    <li>
                        <a href="/games"><i class="far fa-address-book"></i>Games</a>
                        <ul>
                            {{-- <li><a href="javascript:void(0);">Game</a></li> --}}
                            {{-- <li><a href="javascript:void(0);">Search</a></li>
                            <li><a href="javascript:void(0);">Graphs</a></li>
                            <li><a href="javascript:void(0);">Settings</a></li> --}}
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0);"><i class="far fa-clone"></i>Components</a>
                        <ul class="show-dropdown">
                            <li><a href="javascript:void(0);">Today's tasks</a></li>
                            <li class="active">
                                <a href="javascript:void(0);">DrillDown (active)</a>
                                <ul class="show-dropdown">
                                    <li><a href="javascript:void(0);">Today's tasks</a></li>
                                    <li class="active"><a href="javascript:void(0);">Urgent</a></li>
                                    <li>
                                        <a href="javascript:void(0);">Overdues</a>
                                        <ul>
                                            <li><a href="javascript:void(0);">Today's tasks</a></li>
                                            <li><a href="javascript:void(0);">Urgent</a></li>
                                            <li><a href="javascript:void(0);">Overdues</a></li>
                                            <li><a href="javascript:void(0);">Recurring</a></li>
                                            <li>
                                                <a href="javascript:void(0);">Calendar</a>
                                                <ul>
                                                    <li><a href="javascript:void(0);">Current Month</a></li>
                                                    <li><a href="javascript:void(0);">Current Week</a></li>
                                                    <li><a href="javascript:void(0);">Previous Month</a></li>
                                                    <li><a href="javascript:void(0);">Previous Week</a></li>
                                                    <li><a href="javascript:void(0);">Next Month</a></li>
                                                    <li><a href="javascript:void(0);">Next Week</a></li>
                                                    <li><a href="javascript:void(0);">Team Calendar</a></li>
                                                    <li><a href="javascript:void(0);">Private Calendar</a></li>
                                                    <li><a href="javascript:void(0);">Settings</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0);">Recurring</a></li>
                                    <li><a href="javascript:void(0);">Settings</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Overdues</a>
                                <ul>
                                    <li><a href="javascript:void(0);">Today's tasks</a></li>
                                    <li><a href="javascript:void(0);">Urgent</a></li>
                                    <li><a href="javascript:void(0);">Overdues</a></li>
                                    <li><a href="javascript:void(0);">Recurring</a></li>
                                    <li><a href="javascript:void(0);">Settings</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);">Recurring</a></li>
                            <li><a href="javascript:void(0);">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="far fa-calendar-alt"></i>Calendar</a>
                        <ul>
                            <li><a href="javascript:void(0);">Current Month</a></li>
                            <li><a href="javascript:void(0);">Current Week</a></li>
                            <li><a href="javascript:void(0);">Previous Month</a></li>
                            <li><a href="javascript:void(0);">Previous Week</a></li>
                            <li><a href="javascript:void(0);">Next Month</a></li>
                            <li><a href="javascript:void(0);">Next Week</a></li>
                            <li><a href="javascript:void(0);">Team Calendar</a></li>
                            <li><a href="javascript:void(0);">Private Calendar</a></li>
                            <li><a href="javascript:void(0);">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="far fa-chart-bar"></i>Charts</a>
                        <ul>
                            <li><a href="javascript:void(0);">Global favs</a></li>
                            <li><a href="javascript:void(0);">My favs</a></li>
                            <li><a href="javascript:void(0);">Team favs</a></li>
                            <li><a href="javascript:void(0);">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="far fa-copy"></i>Documents</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="far fa-bookmark"></i>Bookmarks</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="far fa-envelope"></i>Mail</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="far fa-heart"></i>Favorite</a>
                    </li> --}}

                </ul>

            </div>
            @yield('content')
        </main>
    </div>

</body>
</html>

