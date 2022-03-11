@extends('layouts.app')
@section('content')
<div class="container text-center">
   <h1>Your Name : {{ Auth::User()->name}}</h1>  
   <h1>Your Email : {{ Auth::User()->email}}</h1>  
   <h1>You logged in as : {{ Auth::User()->type}}</h1>  
   <h1>Your word Number : {{ Auth::User()->word}}</h1>  
   <h1>Your phone Number : {{ Auth::User()->phone}}</h1>  
</div>
@endsection


