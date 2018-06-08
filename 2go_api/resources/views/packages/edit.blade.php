@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('package.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

                {{ Form::model($package, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
                'route' => ['package.update', $package->id]]) }}
                {{ csrf_field() }}
                @include('errors.errors')

                <div class="form-group">
                    <label>Package Name</label>
                    {!! Form::text('packageName', null,array('placeholder' => 'package name','class' => 'uk-form-width-large')) !!}
                </div>
                <div class="form-group">
                    <label>Package Description</label>
                    {!! Form::text('packageDescription', null,array('placeholder' => 'package Description','class' => 'uk-form-width-large')) !!}
                </div>
                <div class="form-group">
                    <label>Package Price</label>
                    {!! Form::text('packagePrice', null,array('placeholder' => 'package Price','class' => 'uk-form-width-large')) !!}
                </div>
                <div class="form-group">
                    <label>Package PromoPrice</label>
                    {!! Form::text('packagePromoPrice', null,array('placeholder' => 'package PromoPrice','class' => 'uk-form-width-large')) !!}
                </div>
                <div class="form-group">
                    <label>Package Expiration(Days)</label>
                    {!! Form::text('packageExpiration', null,array('placeholder' => 'package Expiration','class' => 'uk-form-width-large')) !!}
                </div>
                <div class="form-group">
                    <label>Package Usage</label>
                    <select class="form-control" name="packageUsage">
                        @if($package->packageUsage=="Unlimited")
                            <option value="Unlimited" selected="selected">Unlimited</option>
                            <option value="Limited">Limited</option>
                        @else
                            <option value="Limited" selected="selected">Limited</option>
                            <option value="Unlimited">Unlimited</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Package No. Of Items</label>
                    {!! Form::text('packageNoItem', null,array('placeholder' => 'package Package No. Of Items','class' => 'uk-form-width-large')) !!}
                </div>
                <div class="form-group">
                    <label>Package Limit</label>
                    {!! Form::text('packageLimit', null,array('placeholder' => 'package Limit','class' => 'uk-form-width-large')) !!}
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select class="form-control" name="packageStatus">
                        @if($package->packageStatus=="Active")
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
                    <input type="submit" value="Update Package"
                           class="btn btn-success">
                </div>
                {!! Form::close() !!}
            </div>
        </div> <!--INNER-->
    </div>
    </div>
@endsection