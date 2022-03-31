@extends('layouts.app')

@section('content')
    <div class="container-fluid "
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%)">

        <div class="w-50 mx-auto py-5">
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-header" style="background: #55efc4">
                        Service Type : {{ App\Models\ServiceType::find($post['service_type'])['name'] }}
                    </div>
                    <div class="card-body" style="background: #e3f2fd">
                        <p class="card-text">Word Number : {{ $post['word'] }}</p>
                        <p class="card-text">Posted : {{ $post['created_at']->diffForHumans() }}</p>
                        <div class="d-flex justify-content-between mt-2">
                            <a class="btn btn-outline-success" href="{{ route('postdetail', $post['id']) }}">See
                                Details</a>
                                <p>Status : {{App\Models\Status::where('post_id','=',$post->id)->get()[0]->status}}</p>
                        </div>
                        @if (Auth::user()->type == 'admin')
                            <div class="d-flex justify-content-between mt-2">

                                <a class="btn btn-outline-success" href="{{ route('edit', $post['id']) }}">Edit</a>
                                <form method="post" action="{{ route('destroy', $post['id']) }}"
                                    onsubmit="return confirm('Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-outline-danger" />
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
