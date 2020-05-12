`@extends('layouts.app')

@section('content')
    <h1>Edit Trainer</h1>
    <div class="container">
        {!! Form::open([
            'action' => ['TrainerController@update',
                        $trainer->id,],
            'method' => 'patch',
            'enctype' => 'multipart/form-data'
        ]) !!}
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Name')}}</label>
            <div class="col-md-6">
                <input
                    name="name"
                    type="text"
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                    value="{{$trainer->name ? $trainer->name : old('name')}}"
                    placeholder="{{__('Name')}}"
                    autocomplete="name" autofocus
                    required=true
                >
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="second_name" class="col-md-4 col-form-label text-md-right">{{__('Second Name')}}</label>
            <div class="col-md-6">
                {{Form::text('second_name',
                    $trainer->second_name ? $trainer->second_name : old('second_name'),
                    [
                        'class' => "form-control",
                        'placeholder' => __('Second Name'),
                        'autocomplete' => "second_name",
                        'autofocus' => true,
                        'required' => true
                    ]
                )}}
                <input
                    name="second_name"
                    type="text"
                    class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}"
                    value="{{$trainer->second_name ? $trainer->second_name : old('second_name')}}"
                    placeholder="{{ __('Second Name')}}"
                    autocomplete="second_name" autofocus
                    required=true
                >
                @if ($errors->has('second_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('second_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{__('Last Name')}}</label>
            <div class="col-md-6">
                <input
                    name="last_name"
                    type="text"
                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                    value="{{$trainer->last_name ? $trainer->last_name : old('last_name') }}"
                    placeholder="{{__('Last Name')}}"
                    autocomplete="last_name" autofocus
                >
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">{{__('Position')}}</label>
            <div class="col-md-6">
                <input
                    name="position"
                    type="text"
                    class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}"
                    value="{{$trainer->position ? $trainer->position : old('position') }}"
                    placeholder="{{__('Position')}}"
                    autocomplete="position" autofocus
                >
                @if ($errors->has('position'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('position') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
            <div class="col-md-6">
                <input
                    name="email"
                    type="text"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    value="{{$trainer->email ? $trainer->email : old('email') }}"
                    placeholder="{{__('Email')}}"
                    autocomplete="email" autofocus
                    required="true"
                >
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        date
                    </th>
                    <th>
                        event
                    </th>
                </tr>
                </thead>
                @foreach($trainer->schedule as $row)
                    <tr>
                        <td>
                            {{Form::date('schedule-date', $row->start_date)}}
                        </td>
                        <td>
                            {{Form::hidden('schedule-id',$row->event->id)}}
                            <span @click="this.set_event" event-id="{{$row->event->id}}">
                                {{$row->event->title}}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! Form::submit(__('Save')) !!}
        {!! Form::close() !!}
        <!-- Modal -->
        <event-selector v-if="showModal" @close="showModal = false" :event-id="this.eventId"/>
        <button id="show-modal" @click="showModal=true">Show Modal</button>
        <modal v-if="showModal" @close="showModal=false">
            <h3 slot="header">custom header</h3>
        </modal>
    </div>
@endsection
`
