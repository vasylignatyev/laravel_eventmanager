@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$donor->title}}</h1>
        <div class="pt-2 pb-4">
            <h3>{{$donor->tagline}}</h3>
        </div>
        <img
            src="{{'/storage/' . $donor->logo_url  ?? '/images/not-available.jpg'}}"
            alt="LOGO"
            height="150"
            width="150"
        />
        <div class="pt-2 pb-4">
            <hr>
            <div>
                {!!$donor->short_desc!!}
            </div>
        </div>

        <div class="pt-2 pb-4">
            <hr>
            <div>{!!$donor->full_desc!!}</div>
        </div>

        <div class="pt-2 pb-4">
            <hr>
            <div>{{$donor->country}}</div>
        </div>

        <div class="pt-2 pb-4">
            <h3>
                <span>{{__('Projects')}}</span>
            </h3>
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
                    @foreach ($projects as $row)
                    <tr>
                        <td>{{$row->title}}</td>
                        <td>{{$row->short_desc}}</td>
                        <td>{{$row->start_date}}</td>
                        <td>{{$row->end_date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(!Auth::guest())
            <div>
                <a href="/donor/{{$donor->id}}/projects/edit" class="btn btn-lg btn-primary">{{__('Edit Project List')}}</a>
            </div>
        @endif
        <hr>
        <div><small class="pr-2">{{__('Created at')}} {{$donor->created_at}}</small></div>
        <div><small class="pr-2">{{__('Updated at')}} {{$donor->updated_at}}</small></div>
        <hr>
        @if(!Auth::guest())
            <div>
                <a href="/donor/{{$donor->id}}/edit" class="btn btn-lg btn-primary">Edit</a>
            </div>
        @endif
    </div>
@endsection
