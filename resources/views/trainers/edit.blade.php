`@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="d-flex justify-content-center">Edit Trainer</h1>
        {!! Form::open([
            'action' => ['TrainerController@update',
                        $trainer->id,],
            'method' => 'patch',
            'enctype' => 'multipart/form-data'
        ]) !!}
            <trainer-edit trainer="{{$trainer}}"/>
        {!! Form::submit(__('Save')) !!}
        {!! Form::close() !!}
    </div>
@endsection
`
