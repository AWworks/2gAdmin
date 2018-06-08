@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('package.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('package.store')}}">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>Package Name</label>
                <input class="form-control" type="text"
                       name="packageName" required autofocus/>
            </div>
            <div class="form-group">
                <label>Package Description</label>
                <input class="form-control" type="text"
                       name="packageDescription" required/>
            </div>
            <div class="form-group">
                <label>Package Price</label>
                <input class="form-control" type="text"
                       name="packagePrice" required/>
            </div>
            <div class="form-group">
                <label>Package PromoPrice</label>
                <input class="form-control" type="text"
                       name="packagePromoPrice" required/>
            </div>

            <div class="form-group">
                <label>Package Expiration(Days)</label>
                <input class="form-control" type="text"
                       name="packageExpiration" required/>
            </div>
            <div class="form-group">
                <label>Package Usage</label>
                <select class="form-control" name="packageUsage">
                    <option value="UnLimited">Unlimited</option>
                    <option value="Limited">Limited</option>
                </select>
            </div>
            <div class="form-group">
                <label>Package No. Of Items</label>
                <input class="form-control" type="text"
                       name="packageNoItem" required/>
            </div>
            <div class="form-group">
                <label>Package Limit</label>
                <input class="form-control" type="text"
                       name="packageLimit" required/>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="packageStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add Package"
                       class="btn btn-success">
            </div>
        </form>
    </div>
@endsection