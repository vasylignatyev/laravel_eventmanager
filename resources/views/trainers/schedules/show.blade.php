@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Trainers list for Event:</h1>
        <h2>{{$schedule->event->title}}</h2>
        <h3>Start at<span class="pl-2">{{$schedule->start_date}}</span></h3>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{_('Trainers name')}}</th>
                    <th>{{_('Trainers role')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedule->trainers as $trainer)
                    <tr>
                        <td>
                            <span>{{$trainer->name}}</span>
                            <span class="pr-2">{{$trainer->second_name}}</span>
                        </td>
                        <td>
                            {{$trainer->pivot->role}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="/trainer/schedule/{{$schedule->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
    </div>
@endsection
`
