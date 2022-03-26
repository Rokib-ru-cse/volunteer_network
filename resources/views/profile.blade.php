@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5" style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);">
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
                    <th scope="row">Your phone Number : </th>
                    <td>{{ Auth::User()->phone }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Your word Number : </th>
                    <td>{{ Auth::User()->word }}</td>
                  </tr><tr>
                    <th scope="row">You logged in as : </th>
                    <td>{{ Auth::User()->type }}</td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="container">
            <div class="w-50 mx-auto">
                <h1 class="my-5 text-center">Your Posts</h1>
                @foreach ($posts as $post)
                    <div class="card my-3">
                        <div class="card-header">
                            Title : {{ $post['title'] }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Service Type : {{ $post['service_type'] }}</h5>
                            <p class="card-text">Word Number : {{ $post['word'] }}</p>
                            <p class="card-text">Email : {{ $post['email'] }}</p>
                            <p class="card-text">Description : {{ $post['description'] }}</p>
                            <p class="card-text">Posted : {{$post['created_at']->diffForHumans()}}</p>
                            <div class="d-flex justify-content-between">

                                <a class="btn btn-success" href="{{ route('edit', $post['id']) }}">Edit</a>
                                <form method="post" action="{{ route('destroy', $post['id']) }}"
                                    onsubmit="return confirm('Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger" />
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
