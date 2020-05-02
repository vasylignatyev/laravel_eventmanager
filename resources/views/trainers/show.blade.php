@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/trainer" class="btn btn-primary">{{__('Back')}}</a>
        <h1>
            <span class="pr-1">{{$trainer->name}}</span>
            <span class="pr-1">{{$trainer->second_name}}</span>
            <span>{{$trainer->last_name}}</span>
        </h1>
        <div class="pt-2 pb-2">
            <h4>{{__('Position')}}</h4>
            <div>{{$trainer->position}}</div>
        </div>
        <div class="pt-2 pb-2">
            <h4>{{__('Email')}}</h4>
            <div>
                <a href="mailto:{{$trainer->email}}" target="_blank" rel="noopener noreferrer">{{$trainer->email}}</a>
            </div>
        </div>
        <div class="pt-2 pb-2">
            <h4>{{__('Schedule')}}</h4>
            <table v-if="{{count($trainer->schedule)}} > 0" class="table">
                <thead>
                <tr>
                    <th>
                        date
                    </th>
                    <th>
                        event
                    </th>
                </tr>
                </thead>
                @foreach($trainer->schedule as $row)
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
                    </tr>
                @endforeach
            </table>
            <div v-else>
                <h5>Empty</h5>
            </div>
        </div>
        <div class="pt-2 pb-2">
            <h4>{{__('Position')}}</h4>
            <div>{{$trainer->position}}</div>
            <hr>
        </div>
        <div><small class="pr-2">{{__('Created at')}}</small><small>{{$trainer->created_at}}</small></div>
        <div><span class="pr-2">{{__('Updatet at')}}</span><small>{{$trainer->updated_at}}</small></div>
        <hr>
        @if(!Auth::guest())
            <div class="d-flex">
                <a href="/trainer/{{$trainer->id}}/edit" class="btn btn-primary">Edit</a>
                {!!Form::open(['action' => ['TrainerController@destroy', $trainer->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            </div>
        @endif
    </div>
@endsection
