@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);height:1000px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('AddPost') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('storepost') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="service_type_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select service_type') }}</label>
                                <div class="col-md-6">
                                    <select name="service_type_id" required class="form-control">
                                        <option disabled selected>Choose...</option>
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
                                        name="email" value="{{ old('email') }}" autocomplete="email" placeholder="optional">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select Your Expected Gender') }}</label>
                                <div class="col-md-6">
                                    <select name="gender" required class="form-control">
                                        <option disabled selected>Choose...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Any</option>
                                      </select>
                                </div>
                            </div>
                                <div class="row mb-3">
                                    <label for="phone"
                                        class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>

                                    <div class="col-md-6">
                                        <input type="number" name="phone" value="" required autocomplete="phone" autofocus>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="current_location"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Add Your Current Location') }}</label>

                                    <div class="col-md-6">
                                        <input required type="hidden" value="" name="latitude" id="latitude">
                                        <input required type="hidden" value="" name="longitude" id="longitude">
                                        <button id="lbtn" required onclick="getLocation()" class="btn btn-outline-success">Click Here</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="address" required autofocus></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="description" required autofocus></textarea>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-outline-primary">
                                            {{ __('AddPost') }}
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById("lbtn").addEventListener("click", function(event){
  event.preventDefault()
});
var options = {
    enableHighAccuracy: true,
                timeout: 50000,
                maximumAge: 0
};
        var x = document.getElementById("latitude");
        var y = document.getElementById("longitude");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, error, options);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            x.value = position.coords.latitude;
            y.value = position.coords.longitude;
            }
            function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
}
    </script>
@endsection
