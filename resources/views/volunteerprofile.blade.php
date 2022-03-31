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
        <div class="container">
            <div class="w-50 mx-auto">
                <div class="container">
                    <div class="mx-auto">
                        <h1>Services You Are giving</h1>
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
            </div>
        </div>
    @endsection
