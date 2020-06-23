@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{_('Select Trainer From List')}}</h1>
    
    {{ Form::open(array('url' => 'foo/bar')) }}

        {{ Form::select('trainers', $trainers) }}


    {{ Form::close() }}

</div>
@endsection
`
