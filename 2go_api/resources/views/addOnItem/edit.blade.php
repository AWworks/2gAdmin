@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('addOnItem.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($addOnItem, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['addOnItem.update', $addOnItem->id], 'files' => true]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>AddOnItem Name</label>
            {!! Form::text('addOnItemName', null,['placeholder' => 'addOnItem name','class' => 'uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label>Description</label>
            {!! Form::text('addOnItemDescription', null,['placeholder' => 'addOnItem description','class' => 'uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label>AddOnItem Name In Arabic</label>
            {!! Form::text('addOnItemNameInArabic', null,['placeholder' => 'addOnItem name in arabic','class' => 'uk-form-width-large arabic']) !!}
        </div>

        <div class="form-group">
            <label>Description In Arabic</label>
            {!! Form::text('addOnItemDescriptionInArabic', null,['placeholder' => 'addOnItem in arabic description','class' => 'uk-form-width-large arabic']) !!}
        </div>

        <div class="form-group">
            <label>AddOnItem Price</label>
            {!! Form::text('addOnItemPrice', null,['placeholder' => 'addOnItem price','class' => 'uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label class="uk-form-label uk-h3">AddOnCategory</label>
            <div class="clear"></div>
            @if ($addOnCategory->count())
                <ul class="uk-list uk-list-striped">
                    @foreach($addOnCategory as $category)
                        <?php $value = null ?>
                        @foreach($addOnItem->category as $item)
                            @if($category->id == $item->id)
                                <?php $value = "checked" ?>
                                @break
                            @endif
                        @endforeach
                        <li><input class="icheck" name="addOnItemCategory[]" type="checkbox"
                                   value="{{$category->id}}" {{$value}}>
                            {{$category->addOnCatName}}
                        </li>

                    @endforeach
                </ul>
            @endif
        </div>

        <div class="form-group">
            <label>Image input</label>
            <input type="file" class="form-control-file" id="image" name="addOnItemImage">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="addOnItemStatus">
                @if($addOnItem->addOnItemStatus=="Active")
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
            <input type="submit" value="Update AddOnItem"
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