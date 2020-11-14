@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Customer</H1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Full name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Sex') }}</th>
                    <th>{{ __('Company') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $row)
                    <tr>
                        <td>
                            <a href="/customer/{{$row->id}}">
                                <span class="pr-2">{{$row->first_name}}</span>
                                <span class="pr-2">{{$row->second_name}}</span>
                                <span class="pr-2">{{$row->last_name}}</span>
                            </a>
                        </td>
                        <td>
                            <span>{{$row->email}}</span>
                        </td>
                        <td>
                            <span>{{$row->sex}}</span>
                        </td>
                        <td>
                            {{$row->company->title}}
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $customers->links() }}
        </div>
    </div>

    @if ( Auth::check() )
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="/сustomer/create" class="btn btn-primary">{{ __('Add') }}</a>
            </div>
        </div>
    @endif
</div>
@endsection
