`@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{_('Edit Trainer')}}</h1>
        {!! Form::open([
            'action' =>['TrainerController@update', $trainer->id],
            'method' => 'PUT'
        ]) !!}
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Name')}}</label>
            <div class="col-md-6">
                <input
                    name="name"
                    type="text"
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                    value="{{$trainer->name}}"
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
                    value="{{$trainer->second_name}}"
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
                    value="{{$trainer->last_name}}"
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
                    value="{{$trainer->position}}"
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
                    value="{{$trainer->email}}"
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

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">{{__('Description')}}</label>
            <div class="col-md-6">
                <textarea
                    name="description"
                    type="text"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    placeholder="{{__('Description')}}"
                    autocomplete="description" autofocus
                >{{$trainer->description}}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                {!! Form::submit(__('Save'),['class'=>'btn btn-lg btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open([
            'action' =>['TrainerController@destroy', $trainer->id],
            'method' => 'DELETE'
        ],
        ) !!}
        {!! Form::submit(__('Delete'),['class'=>'btn btn-lg btn-danger']) !!}
        {!! Form::close() !!}
    </div>
@endsection
`
