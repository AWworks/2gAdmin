@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('paymentMode.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($paymentMode, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['paymentMode.update', $paymentMode->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>PaymentMode Name</label>
            {!! Form::text('paymentName', null,array('placeholder' => 'paymentMode name','class' => 'uk-form-width-large')) !!}
        </div>

        <div class="form-group">
            <label>Status</label>

            <select class="form-control" name="paymentStatus">
                @if($paymentMode->paymentStatus=="Active")
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
            <input type="submit" value="Update PaymentMode"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
@endsection