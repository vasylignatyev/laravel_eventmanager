@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/project" class="btn btn-lg btn-primary">{{__('Back')}}</a>
        <h1>{{$project->title}}</h1>
        <div class="pt-2 pb-4">
            <h4>{{__('Short Description')}}</h4>
            <div>
                {!!$project->short_desc!!}
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h4>{{__('Full Description')}}</h4>
            <div>{!!$project->full_desc!!}</div>
        </div>
        <div class="pt-2 pb-4">
            <h4>{{__('Start Date')}}</h4>
            <div>{!!$project->start_date!!}</div>
        </div>
        <div class="pt-2 pb-4">
            <h4>{{__('End Date')}}</h4>
            <div>{!!$project->end_date!!}</div>
        </div>
        <hr>
        <small>
            <span class="pr-2">{{__('Created at')}}</span><span>{{$project->created_at}}</span>
        </small>
        <hr>
        @if(!Auth::guest())
            <div>
                <a href="/project/{{$project->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
            </div>
        @endif
    </div>
@endsection
