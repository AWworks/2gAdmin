<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\ApiUser;
use App\FoodItem;

class AjaxController extends Controller {

   public function getOrderDetails(){

   		$order_id = $_POST['id'];
   		$foodName = '';

   		$orderDetails = Order::select('id', 'order_id', 'transaction_id', 'user_id', 'foodItem_id', 'size_id',
                'addOnItem_id', 'parent_id', 'combo_id', 'count', 'price', 'totalPrice', 'voucher_id', 'discount',
                'discountedAmount', 'Status', 'orderTime', 'merchant_id', 'paymentmode_id')->where('order_id', $order_id)->with('merchant','foodItem:id,foodItemName,foodItemNameInArabic')->get();

   		$customerDetails = ApiUser::select('firstName', 'lastName', 'email', 'mobile', 'vehicleNumber', 'vehicleColor')->where('id', $orderDetails[0]['user_id'])->get();

   		$foodDetails = FoodItem::select('foodItemName')->where('id', $orderDetails[0]['foodItem_id'])->get();

   		//printr($orderDetails);
		$msg = '<dl class="row">
                    <dt class="col-sm-3">Order Id</dt>
                    <dd class="col-sm-9">'.$order_id.'</dd>

                    <dt class="col-sm-3">Order Time</dt>
                    <dd class="col-sm-9">'.$orderDetails[0]['orderTime'].'</dd>

                    <dt class="col-sm-3">Order Status</dt>
                    <dd class="col-sm-9">'.$orderDetails[0]['Status'].'</dd>
                </dl>
                <h4>Food Details</h4>
                <dl class="row">
                    <dt class="col-sm-3">Food Item</dt>
                    <dd class="col-sm-9">'.$foodDetails[0]['foodItemName'].'</dd>

                    <dt class="col-sm-3">Food Quantity</dt>
                    <dd class="col-sm-9">'.$orderDetails[0]['count'].'</dd>

                    <dt class="col-sm-3">Order Total</dt>
                    <dd class="col-sm-9">KWD '.$orderDetails[0]['totalPrice'].'</dd>
                </dl>
                <h4>Customer Details</h4>
                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">'.$customerDetails[0]['firstName'].' '.$customerDetails[0]['lastName'].'</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">'.$customerDetails[0]['email'].'</dd>

                    <dt class="col-sm-3">Mobile</dt>
                    <dd class="col-sm-9">'.$customerDetails[0]['mobile'].'</dd>

                    <dt class="col-sm-3">Vehicle Number</dt>
                    <dd class="col-sm-9">'.$customerDetails[0]['vehicleNumber'].'</dd>

                    <dt class="col-sm-3">Vehicle Color</dt>
                    <dd class="col-sm-9">'.$customerDetails[0]['vehicleColor'].'</dd>
                </dl>';


		return response()->json(array('msg'=> $msg), 200);

   }

}