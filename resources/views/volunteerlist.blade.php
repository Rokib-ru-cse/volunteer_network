@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background: rgb(96, 233, 243,.5);height:1000px">
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
                        <th scope="col">Volunteers giving services</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($volunteers as $volunteer)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td><a href="{{ route('userdetails', $volunteer['id']) }}">{{ $volunteer['name'] }}</a></td>
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
                            <td><a href="{{ route('volunteerposts', $volunteer['id']) }}" class="btn btn-outline-success">View
                                    Posts</a></td>
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
