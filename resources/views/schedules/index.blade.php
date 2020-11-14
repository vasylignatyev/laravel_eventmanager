@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('Event Title') }}</th>
                        <th>{{ __('AddressController')}}</th>
                        <th>{{ __('Longitude')}}</th>
                        <th>{{ __('Latitude')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($schedule as $row)
                    <tr>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}">{{$row->start_date}}</a>
                        </td>
                        <td>{{$row->event->title}}</td>
                        <td>{{$row->address}}</td>
                        <td>{{$row->latitude}}</td>
                        <td>{{$row->longitude}}</td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $schedule->links() }}
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            @if (isset($event))
                <a href="/schedule/event/{{$event->id}}/create" class="btn btn-primary">{{__('Add Schedule')}}</a>
            @else
                <a href="/schedule/create" class="btn btn-primary">{{ __('Add Schedule') }}</a>
            @endif

        </div>

    </div>
</div>

@endsection
