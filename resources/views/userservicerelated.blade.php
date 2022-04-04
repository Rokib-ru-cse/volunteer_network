@extends('layouts.app')
@section('content')
    <div class="container-fluid" style="background: rgba(96, 155, 243, 0.3); padding-bottom: 100px;height:1000px">
        <div class="w-50 mx-auto ">
            <h1 class="py-3 text-center">Users Services</h1>
            <div class="row">
                <div class="col-md-8 offset-2 d-flex justify-content-between">
                    @if (App\Models\User::find($id)->type == 'user')
                        <a href="{{ route('adminservices', [$id, 'pending']) }}"
                            class="btn btn-outline-dark">Pending</a>
                    @endif
                    <a href="{{ route('adminservices', [$id, 'processing']) }}" class="btn btn-outline-dark">Processing</a>
                    <a href="{{ route('adminservices', [$id, 'completed']) }}" class="btn btn-outline-dark">Completed</a>
                    <a href="{{ route('adminservices', [$id, 'rejected']) }}" class="btn btn-outline-dark">Rejected</a>
                </div>
            </div>
            @foreach ($posts as $post)
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="card-title">Service Type :
                            {{ App\Models\ServiceType::find($post['service_type'])['name'] }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Word Number : {{ $post['word'] }}</p>
                        <p class="card-text">Email : {{ $post['email'] }}</p>
                        <p class="card-text">Description : {{ $post['description'] }}</p>
                        <p class="card-text">Posted : {{ $post['created_at']->diffForHumans() }}</p>
                        <a class="btn btn-outline-success" href="{{ route('postdetail', $post['id']) }}">See
                            Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
