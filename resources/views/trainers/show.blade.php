@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/trainer" class="btn btn-lg btn-primary">{{__('Back')}}</a>
        <h1>
            <span class="pr-1">{{$trainer->name}}</span>
            <span class="pr-1">{{$trainer->second_name}}</span>
            <span>{{$trainer->last_name}}</span>
        </h1>
        <div class="pt-2 pb-2">
            <h3>{{__('Position')}}</h3>
            <div>{{$trainer->position}}</div>
        </div>
        <div class="pt-2 pb-2">
            <h3>{{__('Email')}}</h3>
            <div>
                <a href="mailto:{{$trainer->email}}" target="_blank" rel="noopener noreferrer">{{$trainer->email}}</a>
            </div>
        </div>
        <div class="pt-2 pb-2">
            <h3>{{__('Description')}}</h3>
            <div>
                {{$trainer->description}}
            </div>
        </div>
        <div class="pt-2 pb-2">
            <h3>{{__('Schedule')}}</h3>
{{--
            <table v-if="{{count($trainer->schedules)}} > 0" class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Event
                    </th>
                    <th>
                        Role
                    </th>
                </tr>
                </thead>
                @foreach($trainer->schedules as $row)
                    <tr>
                        <td>
                            <a href="/schedule/{{$row->id}}">
                                <span>{{$row->start_date}}</span>
                            </a>

                        </td>
                        <td>
                            <a href="/event/{{$row->event->id}}">
                                <span>{{$row->event->title}}</span>
                            </a>
                        </td>
                        <td>
                            <a href="/event/{{$row->event->id}}">
                                <span>{{$row->pivot->role}}</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div v-else>
                <h5>{{_('Empty')}}</h5>
            </div>
--}}
        </div>
        <div class="pt-2 pb-2">
            <h3>{{__('Position')}}</h3>
            <div>{{$trainer->position}}</div>
            <hr>
        </div>
        <hr>
        <div><small class="pr-2">{{__('Created at')}}</small><small>{{$trainer->created_at}}</small></div>
        <div><small class="pr-2">{{__('Updated at')}}</small><small>{{$trainer->updated_at}}</small></div>
        <hr>
        @if(!Auth::guest())
            <div class="d-flex">
                <a href="/trainer/{{$trainer->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
            </div>
        @endif
    </div>
@endsection
