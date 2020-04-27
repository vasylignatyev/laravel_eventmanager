@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{$event->title}}</h3>
        <div class="pt-2 pb-4">
            <h4>Short Description</h4>
            <div>
                <?php echo $event->short_desc ?>
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h4>Full Description</h4>
            <div>
                <?php echo $event->full_desc ?>
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h4>Duration</h4>
            <duration :duration="{{json_encode($event->duration)}}" :disabled="false"/>
        </div>
    <button type="button" class="btn btn-secondary">
        <a href="/event/{{$event->id}}/edit">Edit Event</a>
    </button>

</div>
@endsection
