@extends('layouts.app')

@section('content')
{{--
    <schedule-edit :trainer="{{$trainer}}" schedule="{{$trainer->schedule->toJson(JSON_INVALID_UTF8_IGNORE)}}" inline-template>
--}}
    <schedule-edit :trainer="{{$trainer}}" schedule="{{$trainer->schedule}}" inline-template>
        <div>
            <h1 class="d-flex justify-content-center">{{__('Trainer Schedule')}}</h1>
            <div class="container">
                {!! Form::open([
                    'action' => ['TrainerController@updateSchedule',
                                $trainer->id,],
                    'method' => 'patch',
                    'enctype' => 'multipart/form-data'
                    ])
                !!}
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            {{_('Date')}}
                        </th>
                        <th>
                            {{_('Event')}}
                        </th>
                        <th>
                            {{_('Action')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
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
                            <td>
                                <span class="glyphicon glyphicon-trash" aria-hidden="true" schedule-id="{{$row->id}}" @click="this.delete"/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <span class="glyphicon glyphicon-plus" aria-hidden="true" event-id="{{}}" @click="this.add"/>
                <hr>
            {!! Form::submit(__('Save')) !!}
            {!! Form::close() !!}
            <!-- Modal -->
                <event-selector v-if="showModal" @close="showModal = false" :event-id="this.eventId"/>
                <button id="show-modal" @click="showModal=true">Show Modal</button>
                <modal v-if="showModal" @close="showModal=false">
                    <h3 slot="header">custom header</h3>
                </modal>
            </div>
        </div>
    </schedule-edit>
@endsection
`
