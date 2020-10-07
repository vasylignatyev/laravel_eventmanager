@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{__('Edit company')}}</h1>
        <form action="/company/{{$company->id}}" enctype="multipart/form-data" method="POST" >
            @csrf
            @method("PATCH")
            <div class="form-group row">
                <div class="col-md-6 col-form-label d-flex align-items-end">
                    <img src="/storage/{{$company->logo_url}}" style="max-height: 150px; max-width: 150px;">
                    <div class="pl-3">
                        <input
                            type="file"
                            id="logo"
                            name="logo"
                        >
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Title')}}</label>
                <div class="col-md-6">
                    <input
                        id="title"
                        type="text"
                        class="form-control{{$errors->has('title')}}"
                        name="title"
                        value="{{$company->title}}"
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
                    name="description">{{ $company->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                    <a href="/company/{{$company->id}}" class="btn btn-primary">{{__('Cancel')}}</a>
                </div>
            </div>
        </form>
    </div>
@endsection
