@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:100vh">
        <div class="container">
            <div class="w-50 mx-auto">
                <h1 class="text-center mb-3">User Profile</h1>
                <table class="table table-striped table-dark">
                    <tbody>
                        <tr>
                            <th scope="row">User Name : </th>
                            <td>{{ $user['name'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">User Email : </th>
                            <td>{{ $user['email'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">User Gender : </th>
                            <td>{{ $user['gender'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">User phone Number : </th>
                            <td>{{ $user['phone'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">User word Number : </th>
                            <td>{{ $user['word'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">User Type : </th>
                            <td>{{ $user['type'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
