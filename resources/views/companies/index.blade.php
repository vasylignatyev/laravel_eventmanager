@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Companies</H1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $row)
                    <tr>
                        <td>{{$row->title}}</td>
                        <td class="d-flex">
                            <a href="/company/{{$row->id}}" class="glyphicon glyphicon-file pr-2" title="Edit" ></a>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $companies->links() }}
        </div>
    </div>

    @if ( Auth::check() )
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="/company/create" class="btn btn-primary">{{ __('Add Company') }}</a>
            </div>
        </div>
    @endif
</div>
@endsection
