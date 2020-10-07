@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{__('Address')}}</h1>
        <div class="form-group row">
            <label for="zip" class="col-md-4 col-form-label text-md-right">{{__('Zip')}}</label>
            <div class="col-md-6">
                <input
                    id="zip"
                    type="text"
                    class="form-control"
                    name="zip"
                    readonly="readonly"
                    value="{{ $address->zip}}"
                    placeholder="{{__('zip')}}"
                    autocomplete="zip" autofocus>
           </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-md-4 col-form-label text-md-right">{{__('Country')}}</label>
            <div class="col-md-6">
                <input
                    id="country"
                    type="text"
                    class="form-control"
                    name="country"
                    readonly="readonly"
                    value="{{ $address->country }}"
                    placeholder="{{__('country')}}"
                    autocomplete="country" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="region" class="col-md-4 col-form-label text-md-right">{{__('Region')}}</label>
            <div class="col-md-6">
                <input
                    id="region"
                    type="text"
                    class="form-control"
                    name="region"
                    readonly="readonly"
                    value="{{ $address->region }}"
                    placeholder="{{__('region')}}"
                    autocomplete="region" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="locality" class="col-md-4 col-form-label text-md-right">{{__('Locality')}}</label>
            <div class="col-md-6">
                <input
                    id="locality"
                    type="text"
                    class="form-control"
                    name="locality"
                    readonly="readonly"
                    value="{{ $address->locality }}"
                    placeholder="{{__('locality')}}"
                    autocomplete="locality" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="street" class="col-md-4 col-form-label text-md-right">{{__('Street')}}</label>
            <div class="col-md-6">
                <input
                    id="street"
                    type="text"
                    class="form-control"
                    name="street"
                    readonly="readonly"
                    value="{{ $address->street }}"
                    placeholder="{{__('street')}}"
                    autocomplete="street" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="office" class="col-md-4 col-form-label text-md-right">{{__('Office')}}</label>
            <div class="col-md-6">
                <input
                    id="office"
                    type="text"
                    class="form-control"
                    name="office"
                    readonly="readonly"
                    value="{{ $address->office }}"
                    placeholder="{{__('office')}}"
                    autocomplete="office" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
            <div class="col-md-6">
                <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    readonly="readonly"
                    value="{{ $address->email }}"
                    placeholder="{{__('email')}}"
                    autocomplete="email" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-4 d-flex">
                <a href="/address/" class="btn btn-primary mr-2">Back</a>
                @if ( Auth::check() )
                    <a href="/address/{{$address->id}}/edit" class="btn btn-primary mr-2">{{__('Edit')}}</a>
                    <form method="post" action="/address/{{$address->id}}" id="delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <!--a href="#" class="glyphicon glyphicon-trash" onclick="$(this).parent().submit()"></a-->
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
