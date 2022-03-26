@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <div class="py-5">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Word</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Created</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Volunteer Total Posts</th>
                        <th scope="col">Volunteer Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($volunteers as $volunteer)
                        <tr>
                            <th scope="row">{{ $volunteer['id'] }}</th>
                            <td>{{ $volunteer['name'] }}</td>
                            <td>{{ $volunteer['email'] }}</td>
                            <td>{{ $volunteer['word'] }}</td>
                            <td>{{ $volunteer['phone'] }}</td>
                            <td>{{ $volunteer['created_at']->diffForHumans() }}</td>
                            <td>
                                <form method="post" action="{{ route('deleteuser', $volunteer['id']) }}"
                                    onsubmit="return confirm('Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete volunteer" class="btn btn-outline-danger" />
                                </form>
                            </td>
                            <td>{{App\Models\Post::where('user_id','=',$volunteer['id'])->get()->count()}}</td>
                            <td><a href="{{route('volunteerposts',$volunteer['id'])}}" class="btn btn-outline-success">View Posts</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
