`@extends('layouts.app')

@section('content')
    <h1>Create Trainer</h1>
    <div class="container">
        {!! Form::open([
            'action' =>'TrainerController@store',
            'method' => 'POST'
        ]) !!}
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Name')}}</label>
            <div class="col-md-6">
                <input
                    name="name"
                    type="text"
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                    value="{{old('name')}}"
                    placeholder="{{__('Name')}}"
                    autocomplete="name" autofocus
                    required=true
                >
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="second_name" class="col-md-4 col-form-label text-md-right">{{__('Second Name')}}</label>
            <div class="col-md-6">
                <input
                    name="second_name"
                    type="text"
                    class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}"
                    value="{{old('second_name')}}"
                    placeholder="{{__('Second Name')}}"
                    autocomplete="second_name" autofocus
                    required=true
                >
                @if ($errors->has('second_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('second_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{__('Last Name')}}</label>
            <div class="col-md-6">
                <input
                    name="last_name"
                    type="text"
                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                    value="{{old('last_name') }}"
                    placeholder="{{__('Last Name')}}"
                    autocomplete="last_name" autofocus
                >
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">{{__('Position')}}</label>
            <div class="col-md-6">
                <input
                    name="position"
                    type="text"
                    class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}"
                    value="{{old('position') }}"
                    placeholder="{{__('Position')}}"
                    autocomplete="position" autofocus
                >
                @if ($errors->has('position'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('position') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
            <div class="col-md-6">
                <input
                    name="email"
                    type="text"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    value="{{old('email') }}"
                    placeholder="{{__('Email')}}"
                    autocomplete="email" autofocus
                >
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {!! Form::submit(__('Save')) !!}
        {!! Form::close() !!}
    </div>
@endsection
`
