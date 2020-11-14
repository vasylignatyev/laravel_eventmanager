`@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Projects for:</h1>
        <h2>"{{$donor->title}}"</h2>
        <hr>
        <edit-projects
            :donor="{{$donor}}"
            :current-projects="{{$currentProjects}}"
            :available-projects="{{$availableProjects}}">
        </edit-projects>
        <hr>
        <small>
            <div class="pr-2">
                <span>{{__('Created at')}}</span>
                <span>{{$donor->created_at}}</span>
            </div>
            <div class="pr-2">
                <span>{{__('Updated at')}}</span>
                <span>{{$donor->updated_at}}</span>
            </div>
        </small>
        <hr>
    </div>
@endsection
