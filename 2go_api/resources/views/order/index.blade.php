@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        {{--<div class="">
            <a href="{{route('cuisine.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>--}}
        <div class="table-responsive">
        <form  action="order">
        {{ csrf_field() }}
            {!! Form::label('fromDate', 'From') !!}
            {!! Form::date('fromDate', date('D-m-y'), ['class' => 'field']) !!}
            {!! Form::label('toDate', 'To') !!}
            {!! Form::date('toDate', date('D-m-y'), ['class' => 'field']) !!}
            {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
        </form>
            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>Order_id</th>
                    <th>User</th>
                    <th>foodItem</th>
                    <th>Size</th>
                    <th>addOnItem</th>
                    <th>Combo</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>orderTime</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td><a class="show-modal" href="#" data-id="{{$order->order_id}}">{{$order->order_id}}</a></td>
                        <td>{{$order->user_id}}</td>
                        @if(!is_null($order->foodItem_id))
                            <td>{{$order->foodItem_id}}</td>
                            <td>{{$order->size_id}}</td>
                            <td></td>
                            <td></td>
                        @elseif(!is_null($order->addOnItem_id))
                            <td></td>
                            <td></td>
                            <th>{{$order->addOnItem_id}}</th>
                            <td></td>
                        @elseif(!is_null($order->combo_id))
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>{{$order->combo_id}}</th>
                        @endif
                        <th>{{$order->count}}</th>
                        <th>{{$order->price}}</th>
                        <td style="padding-top:15px;">
                            @if($order->Status=='Accepted')
                                <span class="label-custom label label-default">{{$order->Status}}</span>
                            @elseif($order->Status=='Confirmed')
                                <span class="label-custom label label-default">{{$order->Status}}</span>
                            @elseif($order->Status=='Ready')
                                <span class="label-custom label label-default">{{$order->Status}}</span>
                            @elseif($order->Status=='Delivered')
                                <span class="label-custom label label-default">{{$order->Status}}</span>
                            @elseif($order->Status=='Declined')
                                <span class="label-custom label label-default">{{$order->Status}}</span>
                            @endif
                        </td>
                        <td>{{$order->orderTime}}</td>
                        <td>
                            @if($order->Status == 'Accepted')
                                {!! Form::open(['method' => 'PUT','route' => ['order.update', $order->order_id],'style'=>'display:inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::hidden('status', 'Confirmed') }}
                                {!! Form::submit('Confirm',['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'PUT','route' => ['order.update', $order->order_id],'style'=>'display:inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::hidden('status', 'Declined') }}
                                {!! Form::submit('Decline',['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to cancel order?')"]) !!}
                                {!! Form::close() !!}
                            @elseif($order->Status == 'Confirmed')
                                {!! Form::open(['method' => 'PUT','route' => ['order.update', $order->order_id],'style'=>'display:inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::hidden('status', 'Ready') }}
                                {!! Form::submit('Ready',['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @elseif($order->Status == 'Ready')
                                {!! Form::open(['method' => 'PUT','route' => ['order.update', $order->order_id],'style'=>'display:inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::hidden('status', 'Delivered') }}
                                {!! Form::submit('Delivered',['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal form to show a post -->
    <div id="showModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Order Details</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body-content">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script type="text/javascript">
        // Show a post
        $(document).on('click', '.show-modal', function() {
            id = $(this).data('id');

            $.ajax({
               /*headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },*/
               type:'POST',
               url:'getOrderDetail',
               data:{
                    _token : '<?php echo csrf_token() ?>',
                    'id'  : id
                },
               success:function(data){
                  $('#showModal').modal('show');
                  $('.modal-body-content').html(data.msg);
               }
            });
            
            
        });
        </script>

@endsection
