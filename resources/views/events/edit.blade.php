`@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>
    <div class="container">
        {!!Form::open([
            'action' => [
                'EventController@update',
                $event->id,
                ],
            'method' => 'patch',
            'enctype' => 'multipart/form-data'
        ]) !!}
        <div class="form-group">
            {{Form::label('title', _('Title'))}}
            {{Form::text('title', $event->title, ['class' => 'form-control', 'placeholder' => __('Title')])}}
        </div>

        <div class="form-group">
            {{Form::label('short_desc', __('Short Description'))}}
            {{Form::textarea('short_desc', $event->short_desc, ['class' => 'cke_contents cke_reset form-control', 'placeholder' => _('Short Description')])}}
        </div>

        <div class="form-group">
            {{Form::label('full_desc', __('Full Description'))}}
            {{Form::textarea('full_desc', $event->full_desc, ['class' => 'form-control', 'placeholder' => _('Full Description')])}}
        </div>

        <div class="pt-2 pb-4">
            <h4>Duration</h4>
            <duration :duration="{{json_encode($event->duration)}}" :disabled="false"/>
        </div>
        <hr>
        <div class="btn-group" role="group">
            {{Form::submit(__('Save'), ['class' => 'btn btn-primary'])}}
            {{ Form::close() }}

            {!!Form::open([
                'action' => [
                    'EventController@destroy',
                    $event->id,
                    ],
                'method' => 'delete',
            ]) !!}
            {{Form::submit(__('Delelete'), ['class' => 'btn btn-danger'])}}
            {{ Form::close() }}
        </div>
    </div>
@endsection
`
