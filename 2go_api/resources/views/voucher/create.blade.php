@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('voucher.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('voucher.store')}}">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>Voucher Name</label>
                <input class="form-control" type="text"
                       name="voucherName" required autofocus/>
            </div>
            <div class="form-group">
                <label>Voucher Type</label>
                <select class="form-control" name="voucherType">
                    <option value="Fixed">fixed amount</option>
                    <option value="Percentage">percentage</option>
                </select>
            </div>
            <div class="form-group">
                <label>Voucher Amount</label>
                <input class="form-control" type="number" min="0" 
                       name="voucherAmount" required/>
            </div>
            <div class="form-group">
                <label>Voucher Expiry</label>
                <input class="form-control" type="date"
                       name="voucherExpiry" required/>
            </div>

            <div class="form-group">
                <label>Applicable To Merchants</label>
                <select class="form-control" name="voucherMerchant">
                    @foreach($merchants as $merchant)
                        <option value="{{$merchant->id}}">{{$merchant->merchantName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Voucher Redeem</label>
                <input class="form-control" type="number" min="0" 
                       name="voucherTimes" required/> Times
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="voucherStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add Voucher"
                       class="btn btn-success">
            </div>

        </form>
    </div>
@endsection