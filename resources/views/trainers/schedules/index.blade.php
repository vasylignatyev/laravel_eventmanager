@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{_('Trainer Schedule')}}</h1>
        <h2>
            <span class="pr-2">{{$trainer->name}}</span><span class="pr-2">{{$trainer->second_name}}</span><span>{{$trainer->last_name}}</span>
        </h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Start Date</th>
                    <th>Event</th>
                    <th>Role</th>
                </tr>
            </thead>
            @foreach ($trainer->schedules as $schedule)
            <tbody>
                <tr>
                    <td><a href="/trainer/schedule/{{$schedule->id}}">{{$schedule->start_date}}</a></td>
                    <td><a href="/trainer/schedule/{{$schedule->id}}">{{$schedule->event->title}}</a></td>
                    <td><a href="/trainer/schedule/{{$schedule->id}}">{{$schedule->pivot->role}}</a></td>
                </tr>
            </tbody>
            @endforeach
        </table>
    <a href="/trainer/{{$trainer->id}}/schedule/create">Add</a>
@endsection