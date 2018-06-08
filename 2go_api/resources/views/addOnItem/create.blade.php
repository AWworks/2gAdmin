@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('addOnItem.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('addOnItem.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>AddOnItem Name</label>
                <input class="form-control" type="text"
                       name="addOnItemName" id="dish_name" required autofocus/>
            </div>

            <div class="form-group">
                <label>AddOnItem Description</label>
                <input class="form-control" type="text"
                       name="addOnItemDescription" id="dish_name" required/>
            </div>

            <div class="form-group">
                <label>AddOnItem Name In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="addOnItemNameInArabic" id="dish_name"/>
            </div>

            <div class="form-group">
                <label>AddOnItem Description In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="addOnItemDescriptionInArabic" id="dish_name"/>
            </div>

            <div class="form-group">
                <label>AddOnItem Price</label>
                <input class="form-control" type="text"
                       name="addOnItemPrice" id="dish_name" required/>
            </div>

            {{--<div class="form-group">
                <label>AddOnItem Category</label>
                <select class="form-control" name="addOnItemCategory">
                    @foreach($addOnCategory as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->addOnCatName }}</option>
                    @endforeach
                </select>
            </div>--}}
            <div class="form-group">
                <label class="uk-form-label uk-h3">AddOnItem Category</label>
                <div class="clear"></div>
                @if ($addOnCategory->count())
                    <ul class="uk-list uk-list-striped">
                        @foreach($addOnCategory as $category)

                            <li><input class="icheck" name="addOnItemCategory[]" type="checkbox"
                                       value="{{ $category->id }}">{{ $category->addOnCatName }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group">
                <label>Image input</label>
                <input type="file" class="form-control-file" id="image" name="addOnItemImage" required>
            </div>


            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="addOnItemStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add AddOnItem"
                       class="btn btn-success">
            </div>
        </form>
    </div>
    <style>
        .arabic {
            direction: rtl;
        }   
    </style>
@endsection