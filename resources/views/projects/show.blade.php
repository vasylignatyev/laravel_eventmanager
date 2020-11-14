@extends('layouts.app')

@section('content')
    <div class="container">
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
        <div class="pt-2 pb-4">
            <h4>{{__('Donors')}}</h4>
            <table class="table table-bordered">
                <thead>
                    <tr class="table table-bordered">
                        <th>{{__('Name')}}</th>
                        <th>{{__('Short description')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($donors as $row)
                    <tr>
                        <td>{{$row->title}}</td>
                        <td>{{$row->short_desc}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <a href="/project/{{$project->id}}/donors/edit" class="btn btn-lg btn-primary">{{__('Edit donor list')}}</a>
            </div>
        </div>
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
        @if(!Auth::guest())
            <div>
                <a href="/project/{{$project->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
            </div>
        @endif
    </div>
@endsection
