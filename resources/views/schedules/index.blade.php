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
                        <th>{{ __('Address')}}</th>
                        <th>{{ __('Longitude')}}</th>
                        <th>{{ __('Latitude')}}</th>
                        <th>{{ __('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($schedule as $row)
                    <tr>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}">{{$row->start_date}}</a>
                        </td>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}"> {{$row->event->title}}</a>
                        </td>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}"> {{$row->address}}</a>
                        </td>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}"> {{$row->latitude}}</a>
                        </td>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}"> {{$row->longitude}}</a>
                        </td>
                        <td>
                            <a href="/schedule/{{$row->id}}" class="glyphicon glyphicon-user" title="Trainers"></a>
                        </td>
                    <tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10" align="center">
                        <span class="d-flex justify-content-center">
{{--
                            {{ $schedule->links() }}
--}}
                        </span>
                    </td>
                </tr>
                </tfoot>
            </table>
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
