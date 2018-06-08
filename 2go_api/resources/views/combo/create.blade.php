@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('combo.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('combo.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>Combo Name</label>
                <input class="form-control" type="text"
                       name="comboName" required autofocus/>
            </div>
            <div class="form-group">
                <label>Combo Description</label>
                <input class="form-control" type="text"
                       name="comboDescription" required/>
            </div>

            <div class="form-group">
                <label>Combo Name In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="comboNameInArabic"/>
            </div>
            <div class="form-group">
                <label>Combo Description In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="comboDescriptionInArabic"/>
            </div>

            <div class="form-group">
                <label>Image input</label>
                <input type="file" class="form-control-file" id="image" name="comboImage" required>
            </div>

            <div class="form-group">
                <label>Combo Price</label>
                <input class="form-control" type="text"
                       name="comboPrice" required/>
            </div>
            <div class="form-group">
                <label>Food Item</label>
                <select class="form-control" style="width:100px;" name="comboFoodItem[]" multiple>
                    @foreach($foodItem as $item)
                        <option value="{{$item->id}}">{{$item->foodItemName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="comboStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add Dish" class="btn btn-success">
            </div>
        </form>
    </div>
    <style>
        .arabic {
            direction: rtl;
        }   
    </style>
@endsection