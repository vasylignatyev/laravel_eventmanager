@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="pl-5">{{ $company->title }}</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if ($company->logo_url)
                    <img src="/storage/{{$company->logo_url}}" style="max-height: 150px; max-width: 150px;">
                @else
                    <img src="/images/not-available.jpg" style="max-height: 150px; max-width: 150px;">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <p class="">{!! $company->description !!}</p>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4 d-flex">

                <a href="/company" class="btn btn-primary">{{__('Back')}}</a>
                @if ( Auth::check() )
                    <a href="/company/{{$company->id}}/edit" class="btn btn-primary ml-2">{{__('Edit')}}</a>
                    <form method="post" action="/company/{{$company->id}}" id="delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-2">Delete</button>
                        <!--a href="#" class="glyphicon glyphicon-trash" onclick="$(this).parent().submit()"></a-->
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
