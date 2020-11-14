@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Event List</H1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Short description') }}</th>
                        <th>{{ __('Duration') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $row)
                    <tr>
                        <td>
                            <a class="pr-3" href="/event/{{$row->id}}">{{$row->title}}</a>
                        </td>
                        <td>{{$row->short_desc}}</td>
                        <td>{{durationToStr($row->duration)}}</td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
    @if ( Auth::check() )
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="/event/create" class="btn btn-primary">{{ __('Add Event') }}</a>
            </div>
        </div>
    @endif
</div>
@endsection
