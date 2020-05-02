`@extends('layouts.app')

@section('content')
    <h1>Edit Schedule</h1>
    <div class="container">
        {!!Form::open([
            'action' => [
                'ScheduleController@update',
                $schedule->id,
                ],
            'method' => 'patch',
            'enctype' => 'multipart/form-data'
        ])!!}
        <div class="form-group row">
            <div class="form-group">
                {{Form::label('startd_date', _('Start Date'),[
                    'class' => "col-md-4 col-form-label text-md-right"
    ]           )}}
                {{Form::text('title', $schedule->start_date, [
                    'class' => 'form-control',
                    'placeholder' => __('Start Date')
                 ])}}
            </div>
        </div>
        {{Form::submit('Save')}}
        {{ Form::close() }}
    </div>
@endsection
`
