@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/donor" class="btn btn-lg btn-primary">{{__('Back')}}</a>
        <h1>{{$donor->title}}</h1>
        <div class="pt-2 pb-4">
            <h3>{{$donor->tagline}}</h3>
        </div>
        <img 
            src="/image/propic.png"
            alt="LOGO"
            height="200"
            width="200"
        />

        <div class="pt-2 pb-4">
            <h4>{{__('Short Description')}}</h4>
            <div>
                {!!$donor->short_desc!!}
            </div>
        </div>

        <div class="pt-2 pb-4">
            <h4>{{__('Full Description')}}</h4>
            <div>{!!$donor->full_desc!!}</div>
        </div>

        <div class="pt-2 pb-4">
            <h4>{{__('Country')}}</h4>
            <div>{{$donor->country}}</div>
        </div>

        <div class="pt-2 pb-4">
            <h4>
                <span>{{__('Projects')}}</span>
            <a href="{{$donor->id}}/traners">({{__('edit')}})</a>
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
                        <td>{{$row->title}}</td>
                        <td>{{$row->short_desc}}</td>
                        <td>{{$row->start_date}}</td>
                        <td>{{$row->end_date}}</td>
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
