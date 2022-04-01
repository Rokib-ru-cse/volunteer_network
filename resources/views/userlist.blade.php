@extends('layouts.app')
@section('content')
    <div class="container-fluid ">
        <div class="py-5">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Word</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Created</th>
                        <th scope="col">Delete</th>
                        <th scope="col">User Total Posts</th>
                        <th scope="col">User Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td><a href="{{ route('userdetails', $user['id']) }}">{{ $user['name'] }}</a></td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['word'] }}</td>
                            <td>{{ $user['phone'] }}</td>
                            <td>{{ $user['created_at']->diffForHumans() }}</td>
                            <td>
                                <form method="post" action="{{ route('deleteuser', $user['id']) }}"
                                    onsubmit="return confirm('Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete User" class="btn btn-outline-danger" />
                                </form>
                            </td>
                            <td>{{ App\Models\Post::where('user_id', '=', $user['id'])->get()->count() }}</td>
                            <td><a href="{{ route('userposts', $user['id']) }}" class="btn btn-outline-success">View Posts</a>
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
@endsection
