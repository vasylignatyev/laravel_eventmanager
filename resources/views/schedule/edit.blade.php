@extends('layouts.app')

@section('content')
    <div class="container text">
        <h1 class="d-flex justify-content-center">{{_('Edit Schedule')}}</h1>
        <schedule-create schedule="{{$schedule}}"></schedule-create>
    </div>
@endsection
`
