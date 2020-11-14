@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="d-flex justify-content-center">{{__('Donor List')}}</h1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Short Description') }}</th>
                        <th>{{ __('Country') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $row)
                    <tr>
                        <td>
                            <a href="/donor/{{$row->id}}">
                                <span class="pr-1">{{$row->title}}</span>
                            </a>
                        </td>
                        <td>
                            <span class="pr-1">{{$row->short_desc}}</span>
                        </td>
                        <td>
                            <span class="pr-1">{{$row->country}}</span>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $subscriptions->links() }}
        </div>
        <div class="col-12">
            <a href="/donor/create" class="btn btn-lg btn-primary">{{ __('Add Donor') }}</a>
        </div>

    </div>
</div>
@endsection
