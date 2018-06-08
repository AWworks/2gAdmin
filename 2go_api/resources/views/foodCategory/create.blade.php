@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('foodCategory.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('foodCategory.store')}}">
            {{ csrf_field() }}
            @include('errors.errors')


            <div class="form-group">
                <label>Food Category Name</label>
                <input class="form-control" type="text"
                       name="foodCatName" required autofocus/>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input class="form-control" type="text"
                       name="foodCatDescription" required/>
            </div>
            <div class="form-group">
                <label>Food Category Name In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="foodCatNameInArabic"/>
            </div>

            <div class="form-group">
                <label>Description In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="foodCatDescriptionInArabic"/>
            </div>

            <div class="form-group">
                <label class="uk-form-label uk-h3">Dish</label>
                <div class="clear"></div>
                @if ($dishes->count())
                    <ul class="uk-list uk-list-striped">
                        @foreach($dishes as $dish)

                            <li><input class="icheck" name="foodCatDish[]" type="checkbox"
                                       value="{{ $dish->id }}">{{ $dish->dishName }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="foodCatStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add Food Category"
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