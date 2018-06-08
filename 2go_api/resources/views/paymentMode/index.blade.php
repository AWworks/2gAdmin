@extends('master.masterIndex')

@section('content')

    <div class="panel-body">
        <div class="">
            <a href="{{route('paymentMode.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>PaymentMode</th>
                <th>Status</th>
                <th>PaymentMode Creator</th>
                <th>Date Updated</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($paymentMode as $payment)
                <tr>
                    <td>{{$payment->id}}</td>
                    <td>{{$payment->paymentName}}</td>
                    <td>{{$payment->paymentStatus}}</td>
                    <td>{{$payment->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($payment->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('paymentMode.edit',$payment->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['paymentMode.destroy', $payment->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

