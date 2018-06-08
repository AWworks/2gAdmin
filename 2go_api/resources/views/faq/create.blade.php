@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('faq.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('faq.store')}}">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>Faq Question</label>
                <input class="form-control" type="text"
                       name="faqQuestion" required autofocus/>
            </div>

            <div class="form-group">
                <label>Faq Answer</label>
                <input class="form-control" type="text"
                       name="faqAnswer" required/>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="faqStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add Faq" class="btn btn-success">
            </div>
        </form>
    </div>
@endsection