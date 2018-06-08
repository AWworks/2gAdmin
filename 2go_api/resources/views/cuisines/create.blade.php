@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('cuisine.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="col-sm-6" id="forms"
              method="POST" action="{{route('cuisine.store')}}">
            {{csrf_field()}}
            @include('errors.errors')

            <div class="form-group">
                <label>Cuisine Name</label>
                <input class="form-control" type="text" name="cuisineName" id="cuisine_name" required
                       autofocus/>

            </div>
            <div class="form-group">
                <label>Cuisine Name In Arabic</label>
                <input class="form-control arabic" type="text" name="cuisineNameInArabic" id="cuisine_name"/>

            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="cuisineStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="reset-button">
                <a href="#" class="btn btn-warning">Reset</a>
                <input type="submit" class="btn btn-success" value="Add Cuisine">
            </div>
        </form>
    </div>
    <style>
        .arabic {
            direction: rtl;
        }   
    </style>
@endsection