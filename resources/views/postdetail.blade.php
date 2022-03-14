@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card my-3">
        <div class="card-header">
        Title : {{$post['title']}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Service Type : {{$post['service_type']}}</h5>
            <p class="card-text">Word Number : {{$post['word']}}</p>
            <p class="card-text">User Email : {{$post['email']}}</p>
            <p class="card-text">User Phone Number : {{$post['phone']}}</p>
            <p class="card-text">Description : {{$post['description']}}</p>
        </div>
    </div>
</div>
@endsection
