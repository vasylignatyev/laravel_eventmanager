@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/schedule" class="btn btn-primary">{{__('Back')}}</a>
        <div class="pt-2 pb-4">
            <h4>{{__('Start Date')}}</h4>
            <div>
                {!!$schedule->start_date!!}
            </div>
        </div>

        <div v-if="{{$schedule->address !== null}}" class="pt-2 pb-4">
            <h4>{{__('Address')}}</h4>
            <div>
                {{$schedule->address}}
            </div>
        </div>

        <div class="pt-2 pb-4">
            <h4>{{__('Geotag')}}</h4>
            <div><span class="pr-2">Latitude:</span>{{$schedule->latitude}}</div>
            <div><span class="pr-2">Longitude:</span>{{$schedule->longitude}}</div>
        </div>

        <div class="pt-2 pb-4">
            <h4>{{__('Trainer')}}</h4>
        </div>

        <div class="pt-2 pb-4">
            <h4>{{__('Event')}}</h4>
        </div>

        <hr>
        <small>Created at {{$schedule->created_at}}</small>
        <hr>
        <a href="/schedule/{{$schedule->id}}/edit" class="btn btn-primary">Edit</a>

        {!!Form::open(['action' => ['ScheduleController@destroy', $schedule->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

    </div>
@endsection
