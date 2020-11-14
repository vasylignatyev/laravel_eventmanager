@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{__('Edit Project')}}</h1>
    <form method="POST" action="{{route('project.update', ['project' => $project->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group row">
            <div class="form-group row">
                <div class="col-md-6 col-form-label d-flex align-items-end">
                    <img src="/storage/{{$project->logo_url}}" style="max-height: 150px; max-width: 150px;">
                    <div class="pl-3">
                        <input
                            type="file"
                            id="logo"
                            name="logo"
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{__('Title')}}</label>
            <div class="col-md-6">
                <input
                    id="title"
                    type="text"
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                    name="title"
                    value="{{$project->title}}"
                    placeholder="{{__('Title')}}"
                    autocomplete="title" autofocus>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="short_desc" class="col-md-4 col-form-label text-md-right">{{__('Short Description')}}</label>
            <div class="col-md-6">
                <textarea
                    class="form-control{{ $errors->has('short_desc') ? ' is-invalid' : '' }}"
                    id="short_desc"
                    name="short_desc">{{$project->short_desc}}</textarea>
                @if ($errors->has('short_desc'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('short_desc') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="full_desc" class="col-md-4 col-form-label text-md-right">{{__('Full Description')}}</label>
            <div class="col-md-6">
                <textarea
                    id="full_desc"
                    name="full_desc"
 A                  class="form-control{{ $errors->has('full_desc') ? ' is-invalid' : '' }}" >{{ $project->full_desc }}</textarea>
                @if ($errors->has('full_desc'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('full_desc') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{__('Start Date')}}</label>
            <div class="col-md-6">
                <input
                    id="start_date"
                    type="date"
                    class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                    name="start_date"
                    value="{{$project->start_date}}"
                    autocomplete="start_date" autofocus>

                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{__('End Date')}}</label>
            <div class="col-md-6">
                <input
                    id="end_date"
                    type="date"
                    class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                    name="end_date"
                    value="{{$project->end_date}}"
                    autocomplete="end_date" autofocus>

                @if ($errors->has('end_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('end_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{__('Update')}}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
