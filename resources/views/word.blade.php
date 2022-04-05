@extends('layouts.app')
@section('content')
    <div class="container-fluid text-center pt-5" style="background: rgb(96, 233, 243,.5);height:1000px">
        <div class="row">
            <div class="col-md-6 offset-3">
                @if ($editword != null)
                    <form action="{{ route('editword', $editword['id']) }}" method="post">
                    @else
                        <form action="{{ route('word') }}" method="post">
                @endif
                @csrf
                <div class="form-group">
                    <h1>Add word</h1>
                    @if ($editword != null)
                        <input type="hidden" value="{{ $editword['id'] }}" name="id">
                        <input type="text" value="{{ $editword['word_no'] }}" name="word" class="mt-2 form-control"
                            placeholder="Enter sesson ex. 2000-2001">
                    @else
                        <input type="number" name="word" class="mt-2 form-control" placeholder="Add word ex. 1">
                    @endif
                </div>
                <button type="submit" class="mt-3 btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 offset-3">
                <h1>All words</h1>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Word Number</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($words as $word)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $word['word_no'] }}</td>
                                <td><a href="{{ route('editword', $word['id']) }}"
                                        class="btn btn-outline-success">Edit</a></td>
                                <td>
                                    <form method="post" action="{{ route('destroyword', $word['id']) }}"
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
