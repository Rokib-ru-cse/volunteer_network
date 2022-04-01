<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteer Network</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
</head>

<body >
    @if (Auth::user())
        {{-- {{ Redirect::to('home') }} --}}
        <script>
            window.location = "/home";
        </script>
    @endif
    <div class="bg-image img-responsive" style="
     background: linear-gradient(rgba(255,255,255,.4), rgba(255,255,255,.4)),url({{ url('images/volunteer.png') }}) no-repeat center center;
     background-size: cover;
    position:absoulte;
    margin-left: auto;
    margin-right: auto;
    width:95%;
    height:100vh;
    content:'';
    top:0px;
    left: 0px;
    z-index:-1;
      "
      >
        @if (Route::has('login'))
            <div class="my-3 text-end " style="position: relative;">
                @auth
                    <a href="{{ url('/home') }}" class="font-weight-bold text-dark">Home</a>
                @else
                    <a href="{{ route('login') }}" class="font-weight-bold text-dark">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="mx-2 font-weight-bold text-dark">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="text-center " style="position: relative;  color: #000;
        font-size: 3rem;
        z-index:1;
        line-height: 0.9;margin-top:300px">
            <p>Welcome to Rajshahi local area Volunteer Network</p>
            <p>Please login to get or provide service</p>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
