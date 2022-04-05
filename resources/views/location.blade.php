@extends('layouts.app')
@section('content')
    <div class="container-fluid text-center pt-5" style="background: rgb(96, 233, 243,.5);height:1000px">
        <div class="row">
            <div class="col-md-6 offset-3">
                @if ($editlocation != null)
                    <form action="{{ route('editlocation', $editlocation['id']) }}" method="post">
                    @else
                        <form action="{{ route('location') }}" method="post">
                @endif
                @csrf
                <div class="form-group">
                    <h1>Add location</h1>
                    @if ($editlocation != null)
                        <input type="hidden" value="{{ $editlocation['id'] }}" name="id">
                        <input type="text" value="{{ $editlocation['location'] }}" name="location" class="mt-2 form-control"
                            placeholder="Add location ex. vodra">
                    @else
                        <input type="text" name="location" class="mt-2 form-control" placeholder="Add location ex. vodra">
                    @endif
                </div>
                <button type="submit" class="mt-3 btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 offset-3">
                <h1>All locations</h1>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">location</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $location['location'] }}</td>
                                <td><a href="{{ route('editlocation', $location['id']) }}"
                                        class="btn btn-outline-success">Edit</a></td>
                                <td>
                                    <form method="post" action="{{ route('destroylocation', $location['id']) }}"
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
@endsection
