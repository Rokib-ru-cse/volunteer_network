@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5" style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:1000px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('EditPost') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('editpost',$post['id'])}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="service_type_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select service_type') }}</label>
                                <div class="col-md-6">
                                    <select name="service_type_id" required class="form-control">
                                        <option selected value="{{$post['service_type_id']}}">{{App\Models\ServiceType::find($post['service_type_id'])['name']}}</option>
                                        {{$services = App\Models\ServiceType::all()}}
                                        @foreach($services as $service)
                                        <option value="{{$service['id']}}">{{$service['name']}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $post['email'] }}" required autocomplete="email" placeholder="Optional">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="location"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select Your Location') }}</label>
                                <div class="col-md-6">
                                    <select name="location_id" required class="form-control">
                                        <option selected value="{{$post['location_id']}}">{{App\Models\Location::find($post['location_id'])['location']}}</option>
                                        {{$locations = App\Models\Location::all()}}
                                        @foreach($locations as $location)
                                        <option value="{{$location['id']}}">{{$location['location']}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select Your Expected Gender') }}</label>
                                <div class="col-md-6">
                                    <select name="gender" required class="form-control">
                                        <option selected value="{{ $post['gender'] }}">{{ $post['gender']=='others'?'Any':$post['gender'] }}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Any</option>
                                      </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>

                                <div class="col-md-6">
                                    <input  type="number"
                                        name="phone" value="{{ $post['phone'] }}" required autocomplete="phone" autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="address" required autofocus>{{ $post['address'] }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <textarea class="form-control" name="description" required autofocus>{{ $post['description'] }}</textarea>
                                </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('EditPost') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
