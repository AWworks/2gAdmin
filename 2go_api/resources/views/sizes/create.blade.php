@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('size.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('size.store')}}">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>Size Name</label>
                <input class="form-control" type="text"
                       name="sizeName" id="cuisine_name" required autofocus/>
            </div>
            <div class="form-group">
                <label>Size Name In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="sizeNameInArabic" id="cuisine_name"/>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="sizeStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add Size" class="btn btn-success">
            </div>

        </form>
    </div>
    <style>
        .arabic {
            direction: rtl;
        }   
    </style>
@endsection