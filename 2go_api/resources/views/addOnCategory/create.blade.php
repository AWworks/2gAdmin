@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('addOnCat.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('addOnCat.store')}}">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>AddOnCategory Name</label>
                <input class="form-control" type="text"
                       name="addOnCatName" id="cuisine_name" required autofocus/>
            </div>

            <div class="form-group">
                <label>AddOnCategory Description</label>
                <input class="form-control" type="text"
                       name="addOnCatDescription" id="cuisine_name" required autofocus/>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="addOnCatStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add AddOnCategory" class="btn btn-success">
            </div>

        </form>
    </div>
@endsection