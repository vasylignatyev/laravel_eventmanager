@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{__('Add сustomer')}}</h1>
    <form action="{{route('customer.store')}}" enctype="multipart/form-data" method="POST" >
        @csrf

        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('First name')}}</label>
            <div class="col-md-6">
                <input
                    id="first_name"
                    type="text"
                    class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    placeholder="{{__('first_name')}}"
                    autocomplete="first_name" autofocus>

                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Second name')}}</label>
            <div class="col-md-6">
                <input
                    id="second_name"
                    type="text"
                    class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}"
                    name="second_name"
                    value="{{ old('second_name') }}"
                    placeholder="{{__('second_name')}}"
                    autocomplete="second_name" autofocus>

                @if ($errors->has('second_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('second_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Last name')}}</label>
            <div class="col-md-6">
                <input
                    id="last_name"
                    type="text"
                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    placeholder="{{__('last_name')}}"
                    autocomplete="last_name" autofocus>

                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
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
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{__('Password')}}</label>
            <div class="col-md-6">
                <input
                    id="password"
                    type="password"
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password"
                    value="{{ old('password') }}"
                    placeholder="{{__('password')}}"
                    autocomplete="password" autofocus>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Confirm password')}}</label>
            <div class="col-md-6">
                <input
                    id="password_confirmation"
                    type="password"
                    class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                    name="password_confirmation"
                    value="{{ old('password_confirmation') }}">
                @if ($errors->has('confirm_password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('confirm_password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Sex')}}</label>
            <div class="col-md-6">
                <select
                    id="sex"
                    name="sex"
                    class="form-control{{ $errors->has('sex') ? ' is-invalid' : '' }}"
                >
                    <option value="M" label="M"/>
                    <option value="F" label="F"/>
                </select>
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
