@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="col-md-4 text-md-right font-weight-bold">{{__('Full Name')}}:</span>
                <span class="text-md-right pr-3">{{ $customer->first_name }}</span>
                <span class="text-md-right pr-3">{{ $customer->second_name }}</span>
                <span class="text-md-right pr-3">{{ $customer->last_name }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <span class="col-md-4 text-md-right font-weight-bold">{{__('Email')}}:</span>
                <span class="">{{$customer->email}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <span class="col-md-4 text-md-right font-weight-bold">{{__('Sex')}}:</span>
                <span class="">{{$customer->sex}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <span class="col-md-4 text-md-right font-weight-bold">{{__('Company')}}:</span>
                <span class="">{{$customer->company->title}}</span>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4 d-flex">
                <a href="/customer" class="btn btn-primary">{{__('Back')}}</a>
                @if ( Auth::check() )
                    <a href="/customer/{{$customer->id}}/edit" class="btn btn-primary ml-2">{{__('Edit')}}</a>
                    <form method="post" action="/customer/{{$customer->id}}" id="delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-2">Delete</button>
                        <!--a href="#" class="glyphicon glyphicon-trash" onclick="$(this).parent().submit()"></a-->
                    </form>
                @endif
            </div>
        </div>
        <hr>
        <div><small class="pr-2">{{__('Created at')}} {{$customer->created_at}}</small></div>
        <div><small class="pr-2">{{__('Updated at')}} {{$customer->updated_at}}</small></div>
        <hr>

    </div>
@endsection
