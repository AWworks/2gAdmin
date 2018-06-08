@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('addOnCat.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($addOnCat, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['addOnCat.update', $addOnCat->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>AddOnCategory Name</label>
            {!! Form::text('addOnCatName', null,array('placeholder' => 'addOnCategory name','class' => 'uk-form-width-large')) !!}
        </div>

        <div class="form-group">
            <label>AddOnCategory Description</label>
            {!! Form::text('addOnCatDescription', null,array('placeholder' => 'addOnCategory description','class' => 'uk-form-width-large')) !!}
        </div>

        <div class="form-group">
            <label>Status</label>

            <select class="form-control" name="addOnCatStatus">
                @if($addOnCat->addOnCatStatus=="Active")
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
            <input type="submit" value="Update AddOnCategory"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
@endsection