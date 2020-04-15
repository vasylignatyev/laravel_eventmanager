@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/event/{{ $event->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit Event</h1>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>

                    <input id="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title"
                           value="{{ old('title') ?? $event->title }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="short_desc" class="col-md-4 col-form-label">Short Description</label>
                    
                    {{ Form::textarea('description', isset($shippingClass->description) ? $shippingClass->description : '', ['class' => 'form-control editable_field textarea_input '. $viewFuncs->setFieldErrorTag($errorsList, 'description', ' has-danger '), 'rows' => '5', 'cols' =>  120, 'placeholder' => 'Enter string description in 255 characters.', 'id' => 'description']) }}

                    <textarea class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               name="short_desc"
                               autocomplete="title" autofocus>
                        <?php echo $event->short_desc ?>
                    </textarea>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Event</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection