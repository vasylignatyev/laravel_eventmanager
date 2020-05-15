@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="d-flex justify-content-center">{{__('Trainer List')}}</h1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Full name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Position') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($trainers as $row)
                    <tr>
                        <td>
                            <a href="/trainer/{{$row->id}}">
                                <span class="pr-1">{{$row->name}}</span>
                                <span class="pr-1">{{$row->second_name}}</span>
                                <span>{{$row->last_name}}</span>
                            </a>
                        </td>
                        <td>
                            <a href="mailto:{{$row->email}}" target="_blank" rel="noopener noreferrer">{{$row->email}}</a>
                        </td>
                        <td>
                            {{$row->position}}
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $trainers->links() }}
        </div>
        <div class="col-12">
            <a href="/trainer/create" class="btn btn-primary">{{ __('Add Trainer') }}</a>
        </div>

    </div>
</div>
@endsection
