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
    <script>window.location = "/home";</script>
    @endif
    <div class="bg-image" style="background-image: url({{url('images/see.jpg')}});
    background-size: cover;
      position: absolute;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;
      opacity: 0.75;">
        @if (Route::has('login'))
            <div class="my-3 text-end" style="position: relative;">
                @auth
                    <a href="{{ url('/home') }}" class="text-white font-weight-bold">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-weight-bold">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white mx-2 font-weight-bold">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="text-center " style="position: relative;  color: #000;  
        font-size: 3rem;
        line-height: 0.9;margin-top:200px">
            <p>Welcome to Rajshahi local area Volunteer Network</p>
            <p>Please login to get or provide service</p>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
