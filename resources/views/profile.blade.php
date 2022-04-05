@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:1000px">
        <div class="container">
            <h1 class="text-center mb-3">Your Profile</h1>
            <table class="table table-striped table-dark">
                <tbody>
                    <tr>
                        <th scope="row">Your Name : </th>
                        <td>{{ Auth::User()->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your Email : </th>
                        <td>{{ Auth::User()->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your Gender : </th>
                        <td>{{ Auth::User()->gender }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your phone Number : </th>
                        <td>{{ Auth::User()->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Your Location : </th>
                        <td>{{ App\Models\Location::find(Auth::User()->location_id)->location }}</td>
                    </tr>
                    <tr>
                        <th scope="row">You logged in as : </th>
                        <td>{{ Auth::User()->type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection
