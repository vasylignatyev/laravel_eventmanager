@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Project List</H1>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('End Date') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Short Description') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($projects as $row)
                    <tr>
                        <td>{{$row->start_date}}</td>
                        <td>{{$row->end_date}}</td>
                        <td>{{$row->title}}</td>
                        <td>{{$row->short_desc}}</td>
                        <td>
                            <a href="/project/{{$row->id}}/edit" class="glyphicon glyphicon-edit pr-2" title="Edit" ></a>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <a href="/project/create" class="btn btn-primary">{{ __('Add Project') }}</a>
        </div>

    </div>
</div>
@endsection
