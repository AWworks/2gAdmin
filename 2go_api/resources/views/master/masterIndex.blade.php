@extends('layouts.master')

@section('masterContent')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list-alt" style="margin-top:-4px;"></i>
        </div>
        <div class="header-title">
                <h1>{{ucfirst(explode('.',Route::currentRouteName())[0])}}</h1>
        </div>
    </section>
    @include('flash::message')
    <section class="content">
        <div class="row">
            <div class="col-sm-12 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="vDza0ueZjb">
                <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="vDza0ueZjb"
                     data-index="0">
                    <div class="panel-heading ui-sortable-handle">
                        <div class="btn-group" id="buttonexport">
                            <h4>{{ucfirst(str_replace(".index","",Route::currentRouteName()))}} List</h4>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
@endsection