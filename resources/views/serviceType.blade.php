@extends('layouts.app')
@section('content')
    <div class="container text-center mt-4">
        <div class="row">
            <div class="col-md-6 offset-3">
                @if ($editservice != null)
                    <form action="{{ route('editservice', $editservice['id']) }}" method="post">
                    @else
                        <form action="{{ route('service') }}" method="post">
                @endif
                @csrf
                <div class="form-group">
                    <h1>Add service</h1>
                    @if ($editservice != null)
                        <input type="hidden" value="{{ $editservice['id'] }}" name="id">
                        <input type="text" value="{{ $editservice['name'] }}" name="service" class="mt-2 form-control"
                            placeholder="Enter sesson ex. 2000-2001">
                    @else
                        <input type="text" name="service" class="mt-2 form-control"
                            placeholder="Add service ex. খাবার প্রস্তুতি">
                    @endif
                </div>
                <button type="submit" class="mt-3 btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 offset-3">
                <h1>All services</h1>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $service['name'] }}</td>
                                <td><a href="{{ route('editservice', $service['id']) }}"
                                        class="btn btn-outline-success">Edit</a></td>
                                <td>
                                    <form method="post" action="{{ route('destroyservice', $service['id']) }}"
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
