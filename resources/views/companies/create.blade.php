@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{__('Add company')}}</h1>
    <form action="{{route('company.store')}}" enctype="multipart/form-data" method="POST" >
        @csrf
        <div class="form-group row">
            <label for="logo" class="col-md-4 col-form-label text-md-right">{{__('Logo')}}</label>
            <div class="col-md-6">
                <input
                    type="file"
                    class="form-control-file"
                    id="logo"
                    name="logo">
                @if ($errors->has('image'))
                    <strong>{{ $errors->first('image') }}</strong>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Title')}}</label>
            <div class="col-md-6">
                <input
                    id="title"
                    type="text"
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="{{__('title')}}"
                    autocomplete="title" autofocus>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">{{__('Description')}}</label>
            <div class="col-md-6">
                <textarea
                    id="full_desc"
                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                    name="description">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
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
