@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('merchant.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($merchant, ['method' => 'PATCH','route' => ['merchant.update', $merchant->id], 'files' => true]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Merchant Name</label>
            {!! Form::text('merchantName', null,['placeholder' => 'merchant name','class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Name In Arabic</label>
            {!! Form::text('merchantNameInArabic', null,['placeholder' => 'merchant name in arabic','class' => 'form-control arabic']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Description</label>
            {!! Form::text('merchantDescription', null,['placeholder' => 'merchant description','class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Description In Arabic</label>
            {!! Form::text('merchantDescriptionInArabic', null,['placeholder' => 'merchant description in arabic','class' => 'form-control arabic']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Mobile</label>
            {!! Form::text('merchantMobile', null,['placeholder' => 'merchant mobile','class' => 'form-control mob']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Email</label>
            {!! Form::text('merchantEmail', null,['placeholder' => 'merchant email','class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Address</label>
            {!! Form::text('merchantAddress', null,['placeholder' => 'merchant address','class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Address In Arabic</label>
            {!! Form::text('merchantAddressInArabic', null,['placeholder' => 'merchant address in arabic','class' => 'form-control arabic']) !!}
        </div>
        <div class="form-group">
            <label>Merchant Area</label>
            <select class="form-control" name="merchantArea">
                @foreach($areas as $area)
                    @if($merchant->merchantArea==$area->id)
                        <option value="{{$area->id}}" selected="selected">{{$area->area}}</option>
                    @else
                        <option value="{{$area->id}}">{{$area->area}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Merchant Avg Bill</label>
            {!! Form::text('merchantAvgBill', null,['placeholder' => 'merchant avg Bill','class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label>Co-ordinates</label>
            <div class="clear"></div>

            {!! Form::text('latitude', explode(',',$merchant->merchantCoordinates)[0],['placeholder'=>'Latitude','class'=>'form-control',
            'style'=>'width:30%;float:left;display:inline']) !!}
            {!! Form::text('longitude', explode(',',$merchant->merchantCoordinates)[1],['placeholder'=>'Longitude','class'=>'form-control',
            'style'=>'width:30%;float:left;display:inline;margin-left:10px']) !!}

        </div>
        <br><br>

        <div class="form-group">
            <label>Timings</label>
            <div class="clear"></div>

            {!! Form:: number('openTime',explode('-',$openTime)[0],['placeholder'=>'Open Time','class' => 'form-control time','min'=> '0',
            'style'=>'width:25%;float:left;display:inline']) !!}
            <select class="form-control" name="openTimeVal"
                    style="width:20%;float:left;display:inline;margin-left:6px;">
                @if(explode('-',$openTime)[1]=='AM')
                    <option selected="selected">AM</option>
                    <option>PM</option>
                @else
                    <option selected="selected">PM</option>
                    <option>AM</option>
                @endif
            </select>

            {!! Form:: number('closeTime',explode('-',$closeTime)[0],['placeholder'=>'Close Time','class' => 'form-control time', 'min'=> '0',
               'style'=>'width:20%;float:left;display:inline;margin-left:6px']) !!}
            <select class="form-control" name="closeTimeVal"
                    style="width:20%;float:left;display:inline;margin-left:6px;">
                @if(explode('-',$closeTime)[1]=='AM')
                    <option selected="selected">AM</option>
                    <option>PM</option>
                @else
                    <option selected="selected">PM</option>
                    <option>AM</option>
                @endif
            </select>
        </div>
        <br><br>
        <div class="form-group">
            <label>Payment Methods Available</label>
            <div class="clear"></div>
            @if ($paymentMode->count())
                @foreach($paymentMode as $payment)
                    <?php $value = null ?>
                    @foreach($merchant->payment as $merchantPay)
                        @if($payment->id == $merchantPay->id)
                            <?php $value = "checked" ?>
                            @break
                        @endif
                    @endforeach
                    <input class="icheck" name="payMode[]" type="checkbox"
                           style="float:left;display:inline;margin-left:10px;"
                           value="{{$payment->id}}" {{$value}}>
                    <span style="float:left;display:inline;">{{ ucfirst($payment->paymentName)}}</span>
                @endforeach
            @endif
        </div>
        <br><br>
        <div class="form-group">
            <label>Cuisines</label>
            <div class="clear"></div>
            @if ($cuisines->count())
                @foreach($cuisines as $cuisine)
                    <?php $value = null ?>
                    @foreach($merchant->cuisine as $merchantCuisine)
                        @if($cuisine->id == $merchantCuisine->id)
                            <?php $value = "checked" ?>
                            @break
                        @endif
                    @endforeach
                    <input class="icheck" name="cuisines[]" type="checkbox"
                           style="float:left;display:inline; margin-left:10px;"
                           value="{{$cuisine->id}}" {{$value}}>
                    <span style="float:left;display:inline;">{{ $cuisine->cuisineName }}</span>
                @endforeach
            @endif
        </div>
        <br><br><br>
        <div class="form-group">
            <label>Merchant Average Time</label>
            {!! Form::number('merchantAvgTime', null,array('placeholder' => 'merchant AvgTime',
                                        'class' => 'form-control time','min'=> '0')) !!}
        </div>

        <div class="form-group">
            <label>Current Status</label>
            <select class="form-control" name="merchantCurrentStatus">
                @if($merchant->merchantCurrentStatus=="Active")
                    <option value="Active" selected="selected">Active</option>
                    <option value="Busy">Busy</option>
                @else
                    <option value="Busy" selected="selected">Busy</option>
                    <option value="Active">Active</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>Parking Status</label>
            <select class="form-control" name="merchantParkingStatus">
                @if($merchant->merchantParkingStatus=="True")
                    <option value="True" selected="selected">Yes</option>
                    <option value="False">No</option>
                @else
                    <option value="False" selected="selected">No</option>
                    <option value="True">Yes</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label>Restaurant Age</label>
            <select class="form-control" name="merchantAge">
                @if($merchant->merchantAge=="New")
                    <option value="New" selected="selected">New</option>
                    <option value="Old">Old</option>
                @else
                    <option value="Old" selected="selected">Old</option>
                    <option value="New">New</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label>Attach Users</label>
            <select class="form-control" style="width:50%;" name="merchantOwners[]" multiple>
                @foreach($merchant->owner as $owner)
                    @foreach($users as $user)
                        @if($owner->id == $user->id)
                            <option value="{{$user->id}}" selected="selected">{{$user->email}}</option>
                        @else
                            <option value="{{$user->id}}">{{$user->email}}</option>
                        @endif
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Icon Image</label>
            <input type="file" class="form-control-file" id="image" name="iconImage">
        </div>
        <div class="form-group">
            <label>Annotation Image</label>
            <input type="file" class="form-control-file" id="image" name="annotationImage">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="merchantStatus">
                @if($merchant->merchantStatus=="Active")
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
            <input type="submit" value="Edit merchant"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
    <style>
        .arabic {
            direction: rtl;
        }   
    </style>
    <script type="text/javascript">
    
    $('.time').on('keyup', function() {
       limitText(this, 4)
    });    

    $('.mob').on('keyup', function() {
   limitText(this, 15)
});

function limitText(field, maxChar){
   var ref = $(field),
       val = ref.val();
   if ( val.length >= maxChar ){
       ref.val(function() {
           return val.substr(0, maxChar);      
       });
   }
}
</script>
@endsection