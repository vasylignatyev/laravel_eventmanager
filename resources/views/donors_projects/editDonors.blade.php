`@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Donors for:</h1>
        <h2>"{{$project->title}}"</h2>
        <hr>
        <edit-donors
            :project="{{$project}}"
            :current-donors="{{$currentDonors}}"
            :available-donors="{{$availableDonors}}">
        </edit-donors>
        <hr>
        <small>
            <div class="pr-2">
                <span>{{__('Created at')}}</span>
                <span>{{$project->created_at}}</span>
            </div>
            <div class="pr-2">
                <span>{{__('Updated at')}}</span>
                <span>{{$project->updated_at}}</span>
            </div>
        </small>
        <hr>
    </div>
@endsection
