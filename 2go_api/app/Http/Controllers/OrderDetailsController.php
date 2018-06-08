<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\PaymentMode;
use App\Combo;
use App\Area;


class OrderDetailsController extends Controller
{
    public function show($order_id)
    {
        $finalOrderAmount =0;

    	$orderDetails = Order::select('id', 'order_id', 'transaction_id', 'user_id', 'foodItem_id', 'size_id',
                'addOnItem_id', 'parent_id', 'combo_id', 'count', 'price', 'totalPrice', 'voucher_id', 'discount',
                'discountedAmount', 'Status', 'orderTime', 'merchant_id', 'paymentmode_id')->where('order_id', $order_id)->with('merchant','foodItem:id,foodItemName,foodItemNameInArabic')->get();
        if (isset($orderDetails[0]['merchant']) && isset($orderDetails[0]['merchant']['merchantAreaInArabic'])) {
            $orderDetails[0]['merchant']['merchantAreaInArabic'] = Area::find($orderDetails[0]['merchant']['merchantArea'])->areaInArabic;
        }
        foreach ($orderDetails as $key => $value) {
            $finalOrderAmount = $finalOrderAmount + $value->totalPrice;
            if($value['foodItem']['foodItemName'] != null) {
                $foodItemNames[] = $value['foodItem']['foodItemName'];
                $foodItemNamesInArabic[] = $value['foodItem']['foodItemNameInArabic'];
            }
            if($value->combo_id != null){
                $comboName = Combo::where('id', $value->combo_id)->get();
                $foodItemNames[] = $comboName[0]['comboName'];
                $foodItemNamesInArabic[] = $comboName[0]['comboNameInArabic'];
            }
            if($value->price != null){
                $value->price = number_format($value->price, 3);
            }
        }

        $orderDetails[0]['orderAmount'] = number_format($finalOrderAmount, 3);
        $orderDetails[0]['food_items_name'] = array_values($foodItemNames);
        $orderDetails[0]['food_items_name_in_arabic'] = array_values($foodItemNamesInArabic);
        unset($orderDetails[0]['foodItem']);
        unset($orderDetails[0]->totalPrice);
        $cartPaymentTypeId = '1';
        $paymentModeId = empty($orderDetails[0]['paymentmode_id']) ? $cartPaymentTypeId :  $orderDetails[0]['paymentmode_id'];
    	if (is_object($orderDetails) && count($orderDetails) > 0) {
    		$payment_type = PaymentMode::where('id', $paymentModeId)->pluck('paymentName');
    		$orderDetails[0]['paymentType'] = $payment_type[0];
			return response()->json([
		            'code' => '200',
		            'response' => $orderDetails[0],
		        ]);
		}else {
            return response()->json([
                'code' => '200',
                'response' => 'No data found.',
            ]);
		}
	}

}
