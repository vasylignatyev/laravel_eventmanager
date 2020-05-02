@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('Event Title') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($schedule as $row)
                    <tr>
                        <td>
                            <a class="pr-3" href="/schedule/{{$row->id}}">{{$row->start_date}}</a>
                        </td>
                        <td>
                            <a class="pr-3" href="/event/{{$row->event->id}}"> {{$row->event->title}}</a>

                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{--
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $schedule->links() }}
        </div>
    </div>
--}}
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <a href="/schedule/create" class="btn btn-primary">{{ __('Add Schedule') }}</a>
        </div>

    </div>
</div>
@endsection
