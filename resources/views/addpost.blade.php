@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5" style="background: linear-gradient(335deg, rgba(255,140,107,1) 0%, rgba(255,228,168,1) 100%);">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('AddPost') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('storepost')}}">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="service_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select service_type') }}</label>
                                <div class="col-md-6">
                                    <select name="service_type" required id="service_type" class="form-select" aria-label="Default select example">
                                        <option selected>Select Your Service_type</option>
                                        <option value="health">Health</option>
                                        <option value="glossaries">Glossaries</option>
                                        <option value="market">market</option>
                                        <option value="medicine">medicine</option>
                                        <option value="childcare">childcare</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="word"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Select Your Word Number') }}</label>
                                <div class="col-md-6">
                                    <select name="word" required id="word" class="form-select" aria-label="Default select example">
                                        <option selected>Select Your Word Number</option>
                                        @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                            
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>

                                <div class="col-md-6">
                                    <input  type="number"
                                        name="phone" value="" required autocomplete="phone" autofocus> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" required autofocus></textarea> 
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
@endsection
