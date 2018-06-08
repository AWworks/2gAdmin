@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('combo.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i> List</a>
        </div>
        @if(Session::has('comboName_err'))
        <p class="alert alert-danger" id="editResponse">{{ Session::get('comboName_err') }}</p>
        @endif
        {{ Form::model($combo, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['combo.update', $combo->id], 'files' => true]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Combo Name</label>
            {!! Form::text('comboName', null,['placeholder' => 'combo name','class' => 'form-control uk-form-width-large']) !!}
        </div>
        <div class="form-group">
            <label>Combo Description</label>
            {!! Form::text('comboDescription', null,['placeholder' => 'combo description','class' => 'form-control uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label>Combo Name In Arabiv</label>
            {!! Form::text('comboNameInArabic', null,['placeholder' => 'combo name in arabic','class' => 'form-control uk-form-width-large arabic']) !!}
        </div>
        <div class="form-group">
            <label>Combo Description In Arabic</label>
            {!! Form::text('comboDescriptionInArabic', null,['placeholder' => 'combo description in arabic','class' => 'form-control uk-form-width-large arabic']) !!}
        </div>

        <div class="form-group">
            <label>Image input</label>
            <input type="file" class="form-control-file" id="image" name="comboImage">
        </div>

        <div class="form-group">
            <label>Food Item</label>
            <select class="form-control"  style="width:100px;" name="comboFoodItem[]" multiple>
                    @foreach($foodItem as $item)
                        <option value="{{ $item->id }}">{{ $item->foodItemName }}</option>
                    @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Combo Price</label>
            {!! Form::text('comboPrice', null,['placeholder' => 'combo description','class' => 'form-control uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="comboStatus">
                @if($combo->comboStatus=="Active")
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
            <input type="submit" value="Update Combo" class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
    <style>
        .arabic {
            direction: rtl;
        }
    </style>
@endsection
