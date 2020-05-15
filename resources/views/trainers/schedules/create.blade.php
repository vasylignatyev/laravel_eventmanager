@extends('layouts.app')

@section('content')
    <schedule data-hello="hello" :trainer="{{$trainer}}" schedule="{{$trainer->schedule}}" />
@endsection
`
