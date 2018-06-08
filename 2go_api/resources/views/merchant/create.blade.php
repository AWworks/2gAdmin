@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('merchant.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form id="forms" method="POST" action="{{route('merchant.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>Merchant Name</label>
                <input class="form-control" type="text"
                       name="merchantName" required autofocus/>
            </div>
            <div class="form-group">
                <label>Merchant Name In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="merchantNameInArabic"/>
            </div>
            <div class="form-group">
                <label>Merchant Description</label>
                <input class="form-control" type="text"
                       name="merchantDescription" required/>
            </div>
            <div class="form-group">
                <label>Merchant Description In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="merchantDescriptionInArabic"/>
            </div>
            <div class="form-group">
                <label>Merchant Mobile</label>
                <input class="form-control mob" type="number" min="0" 
                       name="merchantMobile" required/>
            </div>
            <div class="form-group">
                <label>Merchant Email</label>
                <input class="form-control" type="email"
                       name="merchantEmail" required/>
            </div>
            <div class="form-group">
                <label>Merchant Address</label>
                <input class="form-control" type="text"
                       name="merchantAddress" required/>
            </div>
            <div class="form-group">
                <label>Merchant Address In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="merchantAddressInArabic"/>
            </div>
            <div class="form-group">
                <label>Merchant Area</label>
                <select class="form-control" name="merchantArea">
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->area}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Merchant Avg Bill</label>
                <input class="form-control" type="text"
                       name="merchantAvgBill" required/>
            </div>

            <div class="form-group">
                <label>Co-ordinates</label>
                <div class="clear"></div>

                <input class="form-control" type="text" placeholder="Latitude" maxlength="50" 
                       name="latitude" style="width:30%;float:left;display:inline;"/>

                <input class="form-control" type="text" placeholder="Longitude" maxlength="50" 
                       name="longitude" style="width:30%;float:left;display:inline;margin-left:10px;"/>
            </div>
            <br><br>
            <div class="form-group">
                <label>Timings</label>
                <div class="clear"></div>

                <input class="form-control time" type="number" placeholder="Open Time" min="0" name="openTime" style="width:25%;float:left;display:inline;"/>
                <select class="form-control" name="openTimeVal"
                        style="width:20%;float:left;display:inline;margin-left:6px;">
                    <option>AM</option>
                    <option>PM</option>
                </select>

                <input class="form-control time" type="number" placeholder="Close Time" min="0" name="closeTime" style="width:25%;float:left;display:inline;margin-left:6px;"/>
                <select class="form-control" name="closeTimeVal"
                        style="width:20%;float:left;display:inline;margin-left:6px;">
                    <option>AM</option>
                    <option>PM</option>
                </select>

            </div>
            <br><br>
            <div class="form-group">
                <label>Payment Methods Available</label>
                <div class="clear"></div>
                @if ($paymentMode->count())
                    @foreach($paymentMode as $payment)
                        <input class="icheck" name="payMode[]" type="checkbox"
                               style="float:left;display:inline;margin-left:10px;"
                               value="{{ $payment->id }}">&nbsp;&nbsp;
                        <span style="float:left;display:inline;">{{ ucfirst($payment->paymentName)}}</span>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <label>Cuisines</label>
                <div class="clear"></div>
                @if ($cuisines->count())

                    @foreach($cuisines as $cuisine)

                        <input class="icheck" name="cuisines[]" type="checkbox"
                               value="{{ $cuisine->id }}" style="float:left;display:inline; margin-left:10px;">
                        &nbsp;&nbsp;<span style="float:left;display:inline;">{{ $cuisine->cuisineName }}</span>
                    @endforeach

                @endif
            </div>

            <div class="form-group">
                <label>Merchant Average Time</label>
                <input class="form-control time" type="number" min="0"
                       name="merchantAvgTime" required/>
            </div>
            <div class="form-group">
                <label>Current Status</label>
                <select class="form-control" name="currentStatus">
                    <option value="Active">Active</option>
                    <option value="Busy">Busy</option>
                </select>
            </div>
            <div class="form-group">
                <label>Parking Status</label>
                <select class="form-control" name="merchantParkingStatus">
                    <option value="True">Yes</option>
                    <option value="False">No</option>
                </select>
            </div>


            <div class="form-group">
                <label>Restaurant Age</label>
                <select class="form-control" name="merchantAge">
                    <option value="New">New</option>
                    <option value="Old">Old</option>
                </select>
            </div>
            <div class="form-group">
                <label>Attach Users</label>
                <select class="form-control" style="width:50%;" name="merchantOwners[]" multiple>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Icon Image</label>
                <input type="file" class="form-control-file" id="image" name="iconImage" required>
            </div>
            <div class="form-group">
                <label>Annotation Image</label>
                <input type="file" class="form-control-file" id="image" name="annotationImage" required>
            </div>


            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="merchantStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add merchant"
                       class="btn btn-success">
            </div>
        </form>
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