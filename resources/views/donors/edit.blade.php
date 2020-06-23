`@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Donor</h1>
        {!!Form::open([
            'action' => [
                'DonorController@update',
                $donor->id,
                ],
            'method' => 'patch',
            'enctype' => 'multipart/form-data'
        ]) !!}

        <!--div class="form-group">
            <img src="{{asset('images/cat_1589887194.jpg')}}" alt="LOGO" height="100" max-width="100" />
        </div-->

        <div class="form-group">
            {{Form::label('title', _('Title'))}}
            {{Form::text('title', $donor->title, ['class' => 'form-control-lg input-lg', 'placeholder' => __('Title')])}}
        </div>

        <div class="form-group">
            {{Form::label('short_desc', __('Short Description'))}}
            {{Form::textarea('short_desc', $donor->short_desc,
                [
                    'class' => 'form-control-lginput-lg',
                    'placeholder' => _('Short Description'),
                ])
            }}
        </div>

        <div class="form-group">
            {{Form::label('full_desc', __('Full Description'))}}
            {{Form::textarea('full_desc', $donor->full_desc, ['class' => 'form-control-lg input-lg'])}}
        </div>

        <div class="form-group">
            {{Form::label('country', __('Country'))}}
            {{Form::textarea('country', $donor->country, ['class' => 'form-control-lg input-lg', 'placeholder' => _('Country')])}}
        </div>

        <hr>
        <div class="btn-group" role="group">
            {{Form::submit(__('Save'), ['class' => 'btn btn-lg btn-primary'])}}
            {{ Form::close() }}

            {!!Form::open([
                'action' => [
                    'DonorController@destroy',
                    $donor->id,
                    ],
                'method' => 'delete',
            ]) !!}
            {{Form::submit(__('Delete'), [
                'class' => 'btn btn-lg btn-danger',
                'onclick' => "return confirm('Are you sure?')",
            ])}}
            {{ Form::close() }}
            </div>
    </div>
@endsection
`
