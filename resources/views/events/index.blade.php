@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Duration') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $row)
                    <tr>
                        <td>{{$row->title}}</td>
                        <td>{{durationToStr($row->duration)}}</td>
                        <td>
                            <a href="/event/{{$row->id}}">E</a>
                            <a href="/event/{{$row->id}}/delete">D</a>
                        </td>
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
</div>
@endsection