@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:1000px">
        <div class="table-responsive-sm">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    @if(Auth::User()->type=='volunteer')
                    <form action="{{route('updatestatus',$post['id'])}}" method="POST">
                        @csrf
                    @endif
                    <table class="table table-striped table-dark">
                        <tbody>
                            <tr>
                                <th scope="row">Service Type : </th>
                                <td>{{App\Models\ServiceType::find($post['service_type'])['name']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Word Number : </th>
                                <td>{{ $post['word'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Name : </th>
                                <td>{{App\Models\User::find($post['user_id'])['name']}}</td>
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
                                <td>{{ $post['gender']=='others'?'Any':$post['gender'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Address : </th>
                                <td>{{ $post['address'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description : </th>
                                <td>{{ $post['description'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <input name="status" type="hidden" value="processing">
                    @if(Auth::user()->type=='volunteer')
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
        </div>
    </div>
@endsection
