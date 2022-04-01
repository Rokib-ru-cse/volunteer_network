@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);">
        <div class="container">
            <h1 class="text-center mb-3">Your Profile</h1>
            <table class="table table-striped table-dark">
                <tbody>
                    <tr>
                        <th scope="row">Your Name : </th>
                        <td>{{ Auth::User()->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your Email : </th>
                        <td>{{ Auth::User()->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your Gender : </th>
                        <td>{{ Auth::User()->gender }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your phone Number : </th>
                        <td>{{ Auth::User()->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your word Number : </th>
                        <td>{{ Auth::User()->word }}</td>
                    </tr>
                    <tr>
                        <th scope="row">You logged in as : </th>
                        <td>{{ Auth::User()->type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- volunteer service type section --}}
       
    <div class="container text-center mt-4">
        <div class="row">
            <div class="col-md-6 offset-3">
                <form action="{{ route('volunteer_service_type') }}" method="post">
                @csrf
                <div class="form-group">
                    <h4 class="pb-2">Please Add Service Types you are giving</h4>
                        <div class="row mb-3">
                            <label for="service_type"
                                class="col-md-4 col-form-label text-md-end">{{ __('Select service_type') }}</label>
                            <div class="col-md-6">
                                <select name="service_type" required class="form-control">
                                    <option disabled selected>Choose...</option>
                                    {{$services = App\Models\ServiceType::all()}}
                                    @foreach($services as $service)
                                    <option value="{{$service['id']}}">{{$service['name']}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                </div>
                <button type="submit" class="mt-3 btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 offset-3">
                <h4 class="pb-2">Types of Service you are giving</h4>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Service Type</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach ($volunteer_service_types as $volunteer_service_type)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{App\Models\ServiceType::find($volunteer_service_type['service_type'])['name'] }}</td>
                                <td>
                                    <form method="post" action="{{ route('destroy_volunteer_service_type', $volunteer_service_type['id']) }}"
                                        onsubmit="return confirm('Sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-outline-danger" />
                                    </form>
                                </td>
                            </tr>
                            @php
                            $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


        {{--! volunteer service type section --}}
        <div class="container" style="padding-bottom: 100px">
            <div class="w-50 mx-auto ">
                <h1 class="my-3 text-center">Services You Are giving</h1>
                <div class="row">
                    <div class="col-md-8 offset-2 d-flex justify-content-between">
                        <a href="{{ route('volunteerprofile', 'processing') }}"
                            class="btn btn-outline-dark">Processing</a>
                        <a href="{{ route('volunteerprofile', 'completed') }}"
                            class="btn btn-outline-dark">Completed</a>
                        <a href="{{ route('volunteerprofile', 'rejected') }}"
                            class="btn btn-outline-dark">Rejected</a>
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
                            @php
                                $status = App\Models\Status::select('status')
                                    ->where('post_id', '=', $post->id)
                                    ->get();
                            @endphp
                            @if ($status[0]->status == 'processing')
                                <form action="{{ route('updatestatus', $post['id']) }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-between">
                                        <label class="">Complete or Reject ? </label>
                                        <select class="border border-info rounded" name="status" required>
                                            <option disabled selected>Choose...</option>
                                            <option value="completed">Completed</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-primary">Update
                                            Service</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
