@extends('master.masterIndex')

@section('content')

    <div class="panel-body">

        <div class="">
            <a href="{{route('voucher.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>

        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Voucher</th>
                <th>Amount</th>
                <th>Expiry</th>
                <th>Merchant</th>
                <th>Applicable Times</th>
                <th>Used</th>
                <th>Status</th>
                <th>Cuisine Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($vouchers as $voucher)
                <tr>
                    <td>{{$voucher->id}}</td>
                    <td>{{$voucher->voucherName}}</td>
                    @if($voucher->voucherType=='Percentage')
                        <td>{{$voucher->voucherAmount}}%</td>
                    @else
                        <td>Rs. {{$voucher->voucherAmount}}</td>
                    @endif
                    <td>{{$voucher->voucherExpiry}}</td>
                    <td>{{$voucher->merchant->merchantName}}</td>
                    <td>{{$voucher->voucherTimes}}</td>
                    <td>{{$voucher->voucherCount}}</td>
                    <td>{{$voucher->voucherStatus}}</td>
                    <td>{{$voucher->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($voucher->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('voucher.edit',$voucher->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['voucher.destroy', $voucher->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
     <script type="text/javascript">
        $(document).ready(function(){
          $('.alert-danger').delay(5000).fadeOut('slow');
        });
    </script>
@endsection
