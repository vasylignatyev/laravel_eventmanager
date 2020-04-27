@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::open([
            'action' => [
                'EventController@update',
                $event->id,
                ],
            ])
         }}
        @method('patch')
        <h3>
            {{Form::text('title', $event->title)}}
        </h3>
            <div class="pt-2 pb-4">
                <h4>Short Description'</h4>
                {{Form::textarea('short_desc', $event->short_desc, ['id' => 'short_desc',])}}
            </div>
            <div class="pt-2 pb-4">
                <h4>Full Description</h4>
                {{Form::textarea('full_desc', $event->full_desc, ['id' => 'full_desc',])}}
            </div>
            <div class="pt-2 pb-4">
                <h4>Duration</h4>
                <duration :duration="{{json_encode($event->duration)}}" :disabled="false"/>
            </div>
        {{Form::submit('Save')}}
        {{ Form::close() }}
    </div>
@endsection
