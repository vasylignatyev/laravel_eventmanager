@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{_('Trainer Schedule')}}</h1>
        <h2>
            <span class="pr-2">{{$schedule->name}}</span><span class="pr-2">{{$schedule->second_name}}</span><span>{{$schedule->last_name}}</span>
        </h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($schedule->trainers as $row)
            <tbody>
                <tr>
                    <td>
                        <span>{{$row->last_name}}</span>
                        <span>{{$row->name}}</span>
                        <span>{{$row->second_name}}</span>
                    </td>
                    <td>{{$row->pivot->role}}</td>
                    <td>
                        <form method="POST" action="/schedule/{{$schedule->id}}/trainer">
                            {!! method_field('delete') !!}
                            {!! csrf_field() !!}
                            <input type="hidden" name="trainer_id" value="{{$row->id}}">
                            <a href="javascript:{}" class="glyphicon glyphicon-trash pr-2" title="Delete" onclick="$(event.target).parent().submit();"></a>
                        </form>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    <a href="/schedule/{{$schedule->id}}/trainer/create">Add</a>
@endsection