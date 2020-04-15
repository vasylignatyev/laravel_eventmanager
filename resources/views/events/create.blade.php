@extends('layouts.app')

@section('content')

<div class="container">
    <form method="POST" action="{{ route('event.store') }}">
        @csrf
        
        <div class="row">
            <h1>Add New Event</h1>
        </div>
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input 
                    id="title" 
                    type="text" 
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                    name="title" 
                    value="{{ old('title') }}" 
                    autocomplete="title" autofocus>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="short_desc" class="col-md-4 col-form-label text-md-right">{{ __('Short Description') }}</label>

            <div class="col-md-6">
                <textarea 
                    id="short_desc" 
                    class="form-control{{ $errors->has('short_desc') ? ' is-invalid' : '' }}" 
                    name="short_desc" 
                    value="{{ old('short_desc')}}" 
                    autocomplete="short_desc">
                </textarea>
                @if ($errors->has('short_desc'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('short_desc') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="full_desc" class="col-md-4 col-form-label text-md-right">{{ __('Full Description') }}</label>

            <div class="col-md-6">
                <textarea 
                    id="full_desc" 
                    class="form-control{{ $errors->has('full_desc') ? ' is-invalid' : '' }}" 
                    name="full_desc" 
                    value="{{ old('full_desc')}}" 
                    autocomplete="full_desc">
                </textarea>
                @if ($errors->has('full_desc'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('full_desc') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add New') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection