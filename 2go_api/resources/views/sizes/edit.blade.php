@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('size.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($size, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['size.update', $size->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Size Name</label>
            {!! Form::text('sizeName', null,array('placeholder' => 'size name','class' => 'uk-form-width-large')) !!}
        </div>
        <div class="form-group">
            <label>Size Name In Arabic</label>
            {!! Form::text('sizeNameInArabic', null,array('placeholder' => 'size name in arabic','class' => 'uk-form-width-large arabic')) !!}
        </div>
        <div class="form-group">
            <label>Status</label>

            <select class="form-control" name="sizeStatus">
                @if($size->sizeStatus=="Active")
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
            <input type="submit" value="Update Size"
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