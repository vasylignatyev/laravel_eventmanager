@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Addresses</H1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('ZIP') }}</th>
                    <th>{{ __('Country') }}</th>
                    <th>{{ __('Region') }}</th>
                    <th>{{ __('Locality') }}</th>
                    <th>{{ __('Street') }}</th>
                    <th>{{ __('Office') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($addresses as $row)
                    <tr>
                        <td>{{$row->zip}}</td>
                        <td>{{$row->country}}</td>
                        <td>{{$row->region}}</td>
                        <td>{{$row->locality}}</td>
                        <td>{{$row->street}}</td>
                        <td>{{$row->office}}</td>
                        <td>{{$row->email}}</td>
                        <td class="d-flex">
                            <a href="/address/{{$row->id}}" class="glyphicon glyphicon-file pr-2" title="Edit" ></a>
                            <!--form method="post" action="/address/{{$row->id}}" id="delete">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="glyphicon glyphicon-trash" onclick="$(this).parent().submit()"></a>
                            </form-->
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $addresses->links() }}
        </div>
    </div>

    @if ( Auth::check() )
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="/address/create" class="btn btn-primary">{{ __('Add Address') }}</a>
            </div>
        </div>
    @endif
</div>
@endsection
