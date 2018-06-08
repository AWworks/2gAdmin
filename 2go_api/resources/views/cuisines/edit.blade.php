@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('cuisine.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($cuisine, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['cuisine.update', $cuisine->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Cuisine Name</label>
            {!! Form::text('cuisineName', null,array('placeholder' => 'cuisine name','class' => 'uk-form-width-large')) !!}
        </div>
        <div class="form-group">
            <label>Cuisine Name In Arabic</label>
            {!! Form::text('cuisineNameInArabic', null,array('placeholder' => 'cuisine name in arabic','class' => 'uk-form-width-large arabic')) !!}
        </div>
        <div class="form-group">
            <label>Status</label>

            <select class="form-control" name="cuisineStatus">
                @if($cuisine->cuisineStatus=="Active")
                    <option value="Active" selected="selected">Active</option>
                    <option value="InActive">InActive</option>
                @else
                    <option value="InActive" selected="selected">InActive</option>
                    <option value="Active">Active</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label></label>
            <input type="submit" value="Update Cuisine"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
    <style>
        .arabic {
            direction: rtl;
        }   
    </style>
@endsection