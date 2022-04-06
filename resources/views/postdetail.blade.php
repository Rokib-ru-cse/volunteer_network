@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);">
        <div class="table-responsive-sm">
            <div class="row">
                @php
                    $status = App\Models\Status::where('post_id', '=', $post->id)->get()[0];
                @endphp
                <div class="col-md-8 mx-auto">
                    @if (Auth::User()->type == 'volunteer')
                        <form action="{{ route('updatestatus', $post['id']) }}" method="POST">
                            @csrf
                    @endif
                    <table class="table table-striped table-dark">
                        <tbody>
                            <tr>
                                <th scope="row">Service Type : </th>
                                <td>{{ App\Models\ServiceType::find($post['service_type_id'])['name'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Location : </th>
                                <td>{{ App\Models\Location::find($post['location_id'])['location'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Name : </th>
                                <td>{{ App\Models\User::find($post['user_id'])['name'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Email : </th>
                                <td>{{ $post['email'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Phone Number : </th>
                                <td>{{ $post['phone'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Expected Gender : </th>
                                <td>{{ $post['gender'] == 'others' ? 'Any' : $post['gender'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Address : </th>
                                <td>{{ $post['address'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description : </th>
                                <td>{{ $post['description'] }}</td>
                            </tr>
                            @if ($status->status == 'completed')
                                <tr>
                                    <th scope="row">Completed By : </th>
                                    <td><a href="{{ route('userdetails', $status->assigned_to) }}">{{App\Models\User::find($status->assigned_to)['name']}}</a></td>
                                </tr>
                            @endif
                            @if ($status->status == 'processing')
                                <tr>
                                    <th scope="row">Processing By : </th>
                                    <td><a href="{{ route('userdetails', $status->assigned_to) }}">{{App\Models\User::find($status->assigned_to)['name']}}</a></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <input name="status" type="hidden" value="processing">
                    @if (Auth::user()->type == 'volunteer' and ($status->status == 'pending' or $status->status == 'rejected'))
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('Provide Service') }}
                                </button>
                            </div>
                        </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="row py-5">
                <div class="col-md-8 mx-auto">
                    <h3 class="text-center mb-3">Location in Google Map</h3>
                    <hr>
                <iframe src="https://maps.google.com/maps?q={{ $post['latitude'] }}, {{ $post['longitude'] }}&z=15&output=embed" width="100%" height="500" frameborder="0" style="border:0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
