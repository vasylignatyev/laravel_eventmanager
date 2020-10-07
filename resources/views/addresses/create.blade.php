@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{__('Add Address')}}</h1>
    <form method="POST" action="{{route('address.store')}}">
        @csrf
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Zip')}}</label>
            <div class="col-md-6">
                <input
                    id="zip"
                    type="text"
                    class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}"
                    name="zip"
                    value="{{ old('zip') }}"
                    placeholder="{{__('zip')}}"
                    autocomplete="zip" autofocus>

                @if ($errors->has('zip'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('zip') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-md-4 col-form-label text-md-right">{{__('Country')}}</label>
            <div class="col-md-6">
                <input
                    id="country"
                    type="text"
                    class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                    name="country"
                    value="{{ old('country') }}"
                    placeholder="{{__('country')}}"
                    autocomplete="country" autofocus>

                @if ($errors->has('country'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="region" class="col-md-4 col-form-label text-md-right">{{__('Region')}}</label>
            <div class="col-md-6">
                <input
                    id="region"
                    type="text"
                    class="form-control{{ $errors->has('region') ? ' is-invalid' : '' }}"
                    name="region"
                    value="{{ old('region') }}"
                    placeholder="{{__('region')}}"
                    autocomplete="region" autofocus>

                @if ($errors->has('region'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('region') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="locality" class="col-md-4 col-form-label text-md-right">{{__('Locality')}}</label>
            <div class="col-md-6">
                <input
                    id="locality"
                    type="text"
                    class="form-control{{ $errors->has('locality') ? ' is-invalid' : '' }}"
                    name="locality"
                    value="{{ old('locality') }}"
                    placeholder="{{__('locality')}}"
                    autocomplete="locality" autofocus>

                @if ($errors->has('locality'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('locality') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="street" class="col-md-4 col-form-label text-md-right">{{__('Street')}}</label>
            <div class="col-md-6">
                <input
                    id="street"
                    type="text"
                    class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}"
                    name="street"
                    value="{{ old('street') }}"
                    placeholder="{{__('street')}}"
                    autocomplete="street" autofocus>

                @if ($errors->has('street'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('street') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="office" class="col-md-4 col-form-label text-md-right">{{__('Office')}}</label>
            <div class="col-md-6">
                <input
                    id="office"
                    type="text"
                    class="form-control{{ $errors->has('office') ? ' is-invalid' : '' }}"
                    name="office"
                    value="{{ old('office') }}"
                    placeholder="{{__('office')}}"
                    autocomplete="office" autofocus>

                @if ($errors->has('office'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('office') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
            <div class="col-md-6">
                <input
                    id="email"
                    type="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="{{__('email')}}"
                    autocomplete="email" autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{__('Add New')}}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
