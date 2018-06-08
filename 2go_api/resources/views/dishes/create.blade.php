@extends('master.masterCreate')

@section('content')
            <div class="panel-body">

                {{--<div class="">
                    <a href="{{route('dish.index')}}" class="uk-button"><i class="fa fa-list"></i>List</a>
                </div>--}}
                <div class="">
            <a href="{{route('dish.index')}}" class="btn btn-exp btn-sm"><i class="fa fa-plus"></i>List</a>
        </div>

                <form class="uk-form uk-form-horizontal forms" id="forms"
                      method="POST" action="{{route('dish.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('errors.errors')

                    <div class="form-group">
                        <label>Dish Name</label>
                        <input class="form-control" type="text"
                               name="dishName" id="dish_name" required autofocus/>
                    </div>

                    <div class="form-group">
                        <label>Image input</label>
                        <input type="file" class="form-control-file" id="image" name="dishImage" required>
                    </div>


                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="dishStatus">
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
        </div> <!--INNER-->
    </div>

@endsection