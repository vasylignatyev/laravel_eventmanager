@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/schedule" class="btn btn-primary btn-lg">{{__('Back')}}</a>
        <div class="pt-2 pb-4">
            <h3>{{__('Start Date')}}</h3>
            <div>
                {{$schedule->start_date}}
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h3>{{__('Event')}}</h3>
            <div>
                {{$schedule->event->title}}
            </div>
        </div>
        <div v-if="{{$schedule->address !== null}}" class="pt-2 pb-4">
            <h3>{{__('AddressController')}}</h3>
            <div>
                {{$schedule->address}}
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h3>{{__('Geotag')}}</h3>
            <div><span class="pr-2">Latitude:</span>{{$schedule->latitude}}</div>
            <div><span class="pr-2">Longitude:</span>{{$schedule->longitude}}</div>
        </div>
        <div class="pt-2 pb-4">
            <h3>{{__('Trainers')}} (<a href="/schedule/{{$schedule->id}}/trainer">edit</a>)</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedule->trainers as $trainer)
                    <tr>
                        <td>
                            <span class="pr-2">{{$trainer->last_name}}</span>
                            <span class="pr-2">{{$trainer->name}}</span>
                            <span>{{$trainer->second_name}}</span>
                        </td>
                        <td>{{$trainer->pivot->role}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <small>Created at {{$schedule->created_at}}</small>
        <hr>
        <span class="d-inline">
            <a href="/schedule/{{$schedule->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
        </span>

    </div>
@endsection
