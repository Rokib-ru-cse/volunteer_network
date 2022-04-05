@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:1000px">
        @if (Auth::user()->type == 'user')
            <h1 class="py-3 text-center">Services You Are getting</h1>
        @else
            <h1 class="py-3 text-center">Posts </h1>
        @endif
        @if (count($posts) == 0)
            <h1 class="py-5 fw-bold font-monospace text-danger text-center">No Post Found </h1>
        @else
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Service Type</th>
                        @if (Auth::user()->type != 'user')
                            <th>Posted By</th>
                        @endif
                        <th>Posted At</th>
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
                            <td>{{ $i++ }}</td>
                            <td>{{ App\Models\ServiceType::find($post['service_type_id'])['name'] }}</td>
                            @if (Auth::user()->type != 'user')
                                <td>
                                    {{ App\Models\User::find($post['user_id'])['name'] }}
                                </td>
                            @endif
                            <td>{{ $post['created_at']->diffForHumans() }}</td>
                            @php
                                $status = App\Models\Status::where('post_id', '=', $post->id)->get()[0];
                            @endphp
                            <td>{{ $status->status=="rejected"?"pending":$status->status }}
                                @if($status->status =="completed" or $status->status =="processing")
                                    By  <a href="{{ route('userdetails', $status->assigned_to) }}">{{App\Models\User::find($status->assigned_to)['name']}}</a>
                                @endif
                            </td>
                            <td><a class="btn btn-outline-primary" href="{{ route('postdetail', $post['id']) }}">See
                                    Details</a>
                            </td>
                            @if (Auth::user()->type != 'volunteer')
                                @if (Auth::user()->type == 'user')
                                    @if (App\Models\Status::where('post_id', '=', $post->id)->get()[0]->status == 'completed')
                                        <td>Edit</td>
                                    @else
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ route('edit', $post['id']) }}">Edit</a>
                                        </td>
                                    @endif
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
        @endif
    </div>
@endsection
