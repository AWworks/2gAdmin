@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('voucher.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($voucher, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['voucher.update', $voucher->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Voucher Name</label>
            {!! Form::text('voucherName', null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>Voucher Type</label>
            <select class="form-control" name="voucherType">
                @if($voucher->voucherType=="Fixed")
                    <option value="Fixed" selected="selected">fixed amount</option>
                    <option value="Percentage">percentage</option>
                @else
                    <option value="Percentage" selected="selected">Percentage</option>
                    <option value="Fixed">fixed amount</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>Voucher Amount</label>
            {!! Form::text('voucherAmount', null,['class' => 'form-control'], 'min'=>'0') !!}
        </div>
        <div class="form-group">
            <label>Voucher Expiry</label>
            {!! Form::date('voucherExpiry', null,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label>Applicable To Merchants</label>
            <select class="form-control" name="voucherMerchant">
                @foreach($merchants as $merchant)
                    @if($merchant->id == $voucher->voucherMerchant)
                        <option value="{{$merchant->id}}" selected="selected">{{$merchant->merchantName}}</option>
                    @else
                        <option value="{{$merchant->id}}">{{$merchant->merchantName}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Redeem Times</label>
            {!! Form::text('voucherTimes', null,['class' => 'form-control'], 'min'=>'0') !!}
        </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="voucherStatus">
                @if($voucher->voucherStatus=="Active")
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
            <input type="submit" value="Update Voucher" class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>

@endsection