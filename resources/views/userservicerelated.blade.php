@extends('layouts.app')
@section('content')
    <div class="container-fluid" style="background: rgba(96, 155, 243, 0.3); padding-bottom: 100px;height:1000px">

        <h1 class="py-3 text-center">Users Services</h1>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Service Type</th>
                    <th>Posted</th>
                    <th>Status</th>
                    <th>Details</th>
                    @if (Auth::user()->type != 'volunteer')
                        @if (Auth::user()->type == 'user')
                            <th>Edit</th>
                        @endif
                        <th>Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($posts as $post)
                    <tr>
                        @php
                            $status =App\Models\Status::where('post_id', '=', $post->id)->get()[0];
                        @endphp
                        <td>{{ $i++ }}</td>
                        <td>{{ App\Models\ServiceType::find($post['service_type_id'])['name'] }}</td>
                        <td>{{ $post['created_at']->diffForHumans() }}</td>
                        <td>{{ $status->status }}
                            @if($status->status =="completed" or $status->status =="processing")
                            By  <a href="{{ route('userdetails', $status->assigned_to) }}">{{App\Models\User::find($status->assigned_to)['name']}}</a>
                        @endif
                        </td>
                        <td><a class="btn btn-outline-primary" href="{{ route('postdetail', $post['id']) }}">See
                                Details</a>
                        </td>
                        @if (Auth::user()->type != 'volunteer')
                            @if (Auth::user()->type == 'user')
                                <td>
                                    <a class="btn btn-outline-success" href="{{ route('edit', $post['id']) }}">Edit</a>
                                </td>
                            @endif
                            <td>
                                <form method="post" action="{{ route('destroy', $post['id']) }}"
                                    onsubmit="return confirm('Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-outline-danger" />
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
