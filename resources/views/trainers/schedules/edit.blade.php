@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trainers list for Event:</h1>
        <h2>{{$schedule->event->title}}</h2>
        <h3>Start at<span class="pl-2">{{$schedule->start_date}}</span></h3>
        <hr>
        <schedule-trainer 
            :trainers="{{$schedule->trainers}}"
            :trainer-list="{{$trainerList}}"
            :event="{{$schedule->event}}"
            :schedule-id="{{$schedule->id}}"
            :editable="true">
        </schedule-trainer>
    </div>
@endsection
`
