`@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>
    <div class="container">
        {!!Form::open([
            'action' => [
                'ProjectController@update',
                $project->id,
                ],
            'method' => 'patch',
            'enctype' => 'multipart/form-data'
        ]) !!}
        <div class="form-group">
            {{Form::label('title', _('Title'))}}
            {{Form::text('title', $project->title, ['class' => 'form-control-lg input-lg', 'placeholder' => __('Title')])}}
        </div>

        <div class="form-group">
            {{Form::label('short_desc', __('Short Description'))}}
            {{Form::textarea('short_desc', $project->short_desc,
                [
                    'class' => 'form-control-lg',
                    'placeholder' => _('Short Description'),
//                    'rows' => 5,
                ])
            }}
        </div>

        <div class="form-group">
            {{Form::label('full_desc', __('Full Description'))}}
            {{Form::textarea('full_desc', $project->full_desc, ['class' => 'form-control-lg input-lg', 'placeholder' => _('Full Description')])}}
        </div>

        <div class="pt-2 pb-4">
            <h4>Duration</h4>
            <duration :duration="{{json_encode($project->duration)}}" :disabled="false"/>
        </div>
        <hr>
        <div class="btn-group btn-group-lg">
            {{Form::submit(__('Save'), ['class' => 'btn btn-lg btn-primary  btn-block p-3'])}}
            {{ Form::close() }}

            {!!Form::open([
                'action' => [
                    'ProjectController@destroy',
                    $project->id,
                    ],
                'method' => 'delete',
            ]) !!}
            {{Form::submit(__('Delete'), ['class' => 'btn btn-lg btn-danger btn-block p-3'])}}
            {{ Form::close() }}
        </div>
    </div>
@endsection
`
