@extends('layouts.app')

@section('content')
    <schedule-create data-hello="hello" :trainer="{{$trainer}}" schedule="{{$trainer->schedule}}">
    </schedule-create>
@endsection
`
