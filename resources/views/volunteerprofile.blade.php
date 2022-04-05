@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:2000px">
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
                        <th scope="row">Your Location : </th>
                        <td>{{ App\Models\Location::find(Auth::User()->location_id)->location }}</td>
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
                                    <select name="service_type_id" required class="form-control">
                                        <option disabled selected>Choose...</option>
                                        {{ $services = App\Models\ServiceType::all() }}
                                        @foreach ($services as $service)
                                            <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <h3 class="text-danger fw-bold">{{ app('request')->input('error') }}</h3>
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
                                $i = 1;
                            @endphp
                            @foreach ($volunteer_service_types as $volunteer_service_type)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ App\Models\ServiceType::find($volunteer_service_type['service_type_id'])['name'] }}
                                    </td>
                                    <td>
                                        <form method="post"
                                            action="{{ route('destroy_volunteer_service_type', $volunteer_service_type['id']) }}"
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

        {{-- new volunteer service type section --}}
        <div class="container">
            @if (count($posts) == 0)
                <h1 class="py-5 fw-bold font-monospace text-danger text-center">No Post Found </h1>
            @else
                <h1 class="my-3 text-center">Services You Are giving</h1>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Service Type</th>
                            <th>Posted</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ App\Models\ServiceType::find($post['service_type_id'])['name'] }}</td>
                                <td>{{ $post['created_at']->diffForHumans() }}</td>
                                <td>{{ App\Models\Status::where('post_id', '=', $post->id)->get()[0]->status }}
                                </td>
                                <td>
                                    @if (App\Models\Status::where('post_id', '=', $post->id)->get()[0]->status == 'processing')
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('postdetail', $post['id']) }}">See
                                            Details</a>
                                    @else
                                    @endif
                                </td>
                                @if (App\Models\Status::where('post_id', '=', $post->id)->get()[0]->status == 'processing')
                                    <td>
                                        <form action="{{ route('updatestatus', $post['id']) }}" method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-between">
                                                <select class="border border-info rounded" name="status" required>
                                                    <option disabled selected>Choose...</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                                <button type="submit" class="btn btn-outline-primary">Update
                                                    Service</button>
                                            </div>
                                        </form>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endsection
