@extends('layouts.app')

@section('content')
    <div class="container">
    <a href="/donor/{{$donor->id}}" class="btn btn-lg btn-primary">{{__('Back')}}</a>
        <h1>
            <span>{{$donor->title}}</span>
            <span>{{__('trainers list')}}</span>
        </h1>

        <div class="pt-2 pb-4">
            <h4>
                <span>{{__('Projects')}}</span>
            <a href="{{$donor->id}}/trainers">({{__('edit')}})</a>
            </h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Short Descriptions')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donor->projects as $row)
                    <tr>
                        <td>
                            <a href="/project/{{$row->id}}">{{$row->title}}</a>
                        </td>
                        <td>
                            <a href="/project/{{$row->id}}">{{$row->short_desc}}</a>
                        </td>
                        <td>
                            <a href="/project/{{$row->id}}">{{$row->start_date}}</a>
                        </td>
                        <td>
                            <a href="/project/{{$row->id}}">{{$row->end_date}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div><small class="pr-2">{{__('Created at')}} {{$donor->created_at}}</small></div>
        <div><small class="pr-2">{{__('Updaetd at')}} {{$donor->updated_at}}</small></div>
        <hr>
        @if(!Auth::guest())
            <div>
                <a href="/donor/{{$donor->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
            </div>
        @endif
    </div>
@endsection
