@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('merchant.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th style="font-size:13px;">ID</th>
                <th style="font-size:13px;">Icon Image</th>
                <th style="font-size:13px;">Name</th>
                <th style="font-size:13px;">Payment Methods</th>
                <th style="font-size:13px;">Cuisines</th>
                <th style="font-size:13px;">Status</th>
                <th style="font-size:13px;">Owners</th>
                <th style="font-size:13px;">Date Updated</th>
                <th style="font-size:13px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($merchants as $merchant)
                <tr>
                    <td>res-{{$merchant->id}}</td>
                    <td>
                        <img id="img" class="card-img-top"
                             src="{{asset('images/Merchant/'.$merchant->merchantName.'.png')}}"
                             alt="Card image cap" width="70" height="70">
                    </td>
                    <td>{{$merchant->merchantName}}</td>
                    <td>
                        @foreach($merchant->payment as $payment)
                            {{$payment->paymentName.','}}
                        @endforeach
                    </td>
                    <td>
                        @foreach($merchant->cuisine as $cuisine)
                            {{$cuisine->cuisineName.','}}
                        @endforeach
                    </td>
                    <td style="padding-top:15px;">
                        @if($merchant->merchantStatus=='Active')
                            <span class="label-custom label label-default">{{$merchant->merchantCurrentStatus}}</span>
                        @else
                            <span class="label-danger label label-default">{{$merchant->merchantCurrentStatus}}</span>
                        @endif
                    </td>
                    <td>
                        @foreach($merchant->owner as $owner)
                            {{$owner->email.','}}
                        @endforeach
                    </td>
                    <td>{{date('d M,Y',strtotime($merchant->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('merchant.edit',$merchant->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['merchant.destroy', $merchant->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection

