<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Volunteer Network') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteer Network</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-attachment: fixed;
background-position: center;
background-repeat: no-repeat;
height: 100vh;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">Volunteer Network</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if (Auth::check())
                    @if (Auth::user()->type == 'user')
                        <a href="{{ route('addpost') }}" class="btn btn-outline-success">Need Help ?</a>
                    @endif
                    <form class="d-flex mx-5" method="GET" action="{{ route('filter') }}">
                        <select name="filter" required class="form-control">
                            <option disabled selected>Filter By ServiceType</option>
                            {{ $services = App\Models\ServiceType::all() }}
                            @foreach ($services as $service)
                                <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-danger mx-2" type="submit">Filter</button>
                    </form>
                    @if (Auth::user()->type == 'admin')
                        <a href="{{ route('userlist') }}" class="btn btn-outline-primary mx-2">User List</a>
                        <a href="{{ route('volunteerlist') }}" class="btn btn-outline-primary">Volunteer List</a>
                        <a href="{{ route('service') }}" class="btn btn-outline-primary mx-2">Service List</a>
                        {{-- <a href="{{ route('word') }}" class="btn btn-outline-primary">word List</a> --}}
                        <a href="{{ route('location') }}" class="btn btn-outline-primary">Location List</a>
                    @endif
                @endif
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    @if (Auth::user()->type == 'volunteer')
                                        <a class="dropdown-item" href="{{ route('volunteerprofile') }}">
                                            {{ __('Profile') }}
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('profile') }}">

                                            {{ __('Profile') }}
                                        </a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        document.getElementById("lbtn").addEventListener("click", function(event) {
            event.preventDefault();
        });
        var options = {
            enableHighAccuracy: true,
            timeout: 50000,
            maximumAge: 0
        };
        var x = document.getElementById("latitude");
        var y = document.getElementById("longitude");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, error, options);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.value = position.coords.latitude;
            y.value = position.coords.longitude;
        }

        function error(err) {
            console.log(err.message);
        }
    </script>
</body>

</html>
