@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Schedule for_</h1>
        <schedule-trainer :trainers="{{$schedule->trainers}}" :editable="false"></schedule-trainer>
        <a href="/trainer/schedule/{{$schedule->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
    </div>
@endsection
`
