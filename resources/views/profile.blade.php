@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Your Profile</h1>
   <h4>Your Name : {{ Auth::User()->name}}</h4>  
   <h5>Your Email : {{ Auth::User()->email}}</h5>  
   <h5>You logged in as : {{ Auth::User()->type}}</h5>  
   <h5>Your word Number : {{ Auth::User()->word}}</h5>  
   <h5>Your phone Number : {{ Auth::User()->phone}}</h5>  
</div>

<div class="container">
    <div class="w-50 mx-auto">
        <h1 class="my-5">Your Posts</h1>
@foreach($posts as $post)
    <div class="card my-3">
        <div class="card-header">
        Title : {{$post['title']}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Service Type : {{$post['service_type']}}</h5>
            <p class="card-text">Word Number : {{$post['word']}}</p>
            <p class="card-text">Email : {{$post['email']}}</p>
            <p class="card-text">Description : {{$post['description']}}</p>
            <div class="d-flex justify-content-between">

                <a class="btn btn-success" href="{{route('edit',$post['id'])}}">Edit</a> 
                <form method="post" action="{{route('destroy',$post['id'])}}" onsubmit="return confirm('Sure?')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger"/>
                 </form>
            </div>

        </div>
    </div>
@endforeach
</div>
@endsection
<!-- <div class="container ">
<div class="w-50 mx-auto">
<table class="table table-striped table-bordered">
        
        <th>Title</th>
        <th>Email</th>
        <th>Word</th>
        <th>Service_type</th>
        <th>Description</th>

        <th colspan="3" class="text-center">Action</th>
          
        @foreach($posts as $post)
            <tr>     
                <td>{{$post['title']}}</td>
                <td>{{$post['email']}}</td> 
                <td>{{$post['word']}}</td>
                <td>{{$post['service_type']}}</td>
                <td>{{$post['description']}}</td>
                <td>
                    <a href="{{route('edit',$post['id'])}}">Edit</a> 
                </td>
                <td>
                    <form method="post" action="{{route('destroy',$post['id'])}}" onsubmit="return confirm('Sure?')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-link text-danger"/>
                    </form>
                </td>
            </tr>

        @endforeach
      </table>
</div> -->



