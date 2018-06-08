@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('dish.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($dish, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['dish.update', $dish->id], 'files' => true]) }}
        {{ csrf_field() }}
        @include('errors.errors')


        <div class="form-group">
            <label>Dish Name</label>
            {!! Form::text('dishName', null,['placeholder' => 'dish name','class' => 'uk-form-width-large']) !!}

        </div>

        <div class="form-group">
            <label>Image input</label>
            <input type="file" class="form-control-file" id="image" name="dishImage">
        </div>


        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="dishStatus">
                @if($dish->dishStatus=="Active")
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
            <input type="submit" value="Update Dish" class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
@endsection