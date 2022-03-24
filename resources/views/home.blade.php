@extends('layouts.app')

@section('content')
<div class="container-fluid " style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%)">

    <div class="w-50 mx-auto py-5">
@foreach($posts as $post)
    <div class="card mb-3">
        <div class="card-header" style="background: #55efc4">
        Title : {{$post['title']}}
        </div>
        <div class="card-body" style="background: #e3f2fd">
            <h5 class="card-title">Service Type : {{$post['service_type']}}</h5>
            <p class="card-text">Word Number : {{$post['word']}}</p>
            <p class="card-text">Posted : {{$post['created_at']->diffForHumans()}}</p>
            <a class="btn btn-outline-success" href="{{route('postdetail',$post['id'])}}">See Details</a>
        </div>
    </div>
@endforeach
</div>

</div>
@endsection
