@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/event" class="btn btn-lg btn-primary">{{__('Back')}}</a>
        <h1>{{$event->title}}</h1>
        <div class="pt-2 pb-4">
            <h4>{{__('Short Description')}}</h4>
            <div>
                {!!$event->short_desc!!}
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h4>{{__('Full Description')}}</h4>
            <div>{!!$event->full_desc!!}</div>
        </div>
        <div class="pt-2 pb-4">
            <h4>{{__('Duration')}}</h4>
            <duration :duration="{{json_encode($event->duration)}}" :disabled="true"/>
        </div>
        <hr>
        <div><span class="pr-2">{{__('Created at')}}</span>{{$event->created_at}}</div>
        <hr>
        @if(!Auth::guest())
            <div>
                <a href="/event/{{$event->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
            </div>
        @endif
    </div>
@endsection
