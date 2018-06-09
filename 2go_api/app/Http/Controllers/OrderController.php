<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Combo;
use App\FoodItem;
use App\ApiUser;
use App\OauthAccessToken;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Area;

class OrderController extends Controller
{
    public function index()
    {
        $request = Request::capture();

        if ($request->hasHeader('api') == 'true') {
            $function          = new Functions();
            $combo_id          = array();
            $orders            = null;
            $foodItemOrderList = array();
            $comboOrderList    = array();
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');

            $foodItems = FoodItem::whereIn('foodItemCreator', $function->ownerId())->get();

            if (is_object($foodItems) && count($foodItems) > 0) {
                $foodItem_id = array();
                foreach ($foodItems as $foodItem) {
                    $foodItem_id[] = $foodItem->id;
                }

                $foodItem_order = Order::whereIn('foodItem_id', $foodItem_id)->get();
                if ($foodItem_order) {
                    foreach ($foodItem_order as $foodItem) {
                        $foodItemOrderList[] = Order::where('order_id', $foodItem->order_id)->with('merchant')->first();
                    }
                }
            }

            $combos = Combo::whereIn('comboCreator', $function->ownerId())->get();
            if (is_object($combos) && count($combos) > 0) {
                foreach ($combos as $combo) {
                    $combo_id[] = $combo->id;
                }

                $combo_order = Order::whereIn('combo_id', $combo_id)->get();
                $ids         = null;
                if ($combo_order) {
                    foreach ($combo_order as $order) {
                        $ids[] = $order->order_id;
                    }
                    $comboOrderList = Order::whereIn('order_id', $ids)->get();
                    if(!empty($fromDate) &&  !empty($toDate)) {
                        $comboOrderList = Order::whereIn('order_id', $ids)->whereBetween('orderTime',[$fromDate, $toDate])->orderBy('orderTime', 'DESC')->get();
                    }
                }
            }

            return response()->json([
                'code'     => '200',
                'response' => array('foodItemOrders' => $foodItemOrderList, 'comboOrders' => $comboOrderList),
            ]);

        } else {
            $function    = new Functions();
            $foodItem_id = null;
            $combo_id    = null;
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');

            $foodItems   = FoodItem::whereIn('foodItemCreator', $function->ownerId())->get();
            foreach ($foodItems as $foodItem) {
                $foodItem_id[] = $foodItem->id;
            }
            $combos = Combo::whereIn('comboCreator', $function->ownerId())->get();
            foreach ($combos as $combo) {
                $combo_id[] = $combo->id;
            }
            $orders = array();
            $ids    = null;

            $foodItem_order = Order::whereIn('foodItem_id', $foodItem_id)->get();
            if (!$foodItem_order->isEmpty()) {
                foreach ($foodItem_order as $order) {
                    $ids[] = $order->order_id;
                }
                $orders = Order::whereIn('order_id', $ids)->get();
            }
            
            $users = Order::where('user_id', user_Id )->get();
            foreach ($users as $usr)
            {
               echo 'aw '.$usr->user_id;
            }
            if ($combo_id) {
                $combo_order = Order::whereIn('combo_id', $combo_id)->get();
                if (!$combo_order->isEmpty()) {
                    foreach ($combo_order as $order) {
                        $ids[] = $order->order_id;
                    }
                    $orders = Order::whereIn('order_id', $ids)->get();
                   
                   
                    
                       // Filters for orderstatus :AW
                    if(!empty($fromDate) &&  !empty($toDate)){
                        $orders = Order::whereIn('order_id', $ids)->whereBetween('orderTime',[$fromDate, $toDate])->orderBy('orderTime', 'DESC')->get();
                    }else{
                        // $orders = Order::whereIn('order_id', $ids)->get();
                        $orders = Order::whereIn('order_id', $ids)->get(); //->wheredate('orderTime' ,Carbon::today())
                    }
                }
            }

            return view('order.index', compact('orders'));
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $key = config('app.registerKey');
        if ($request->header('key') == $key) {

            $user           = $request->user('api');
            $cart           = Cart::where('user_id', $user->id)->with('foodItem', 'combo', 'addOnItem')->get();
            $function       = new Functions();
            $totalPrice     = $function->price($user->id, $request->input('voucher'));
            $discount       = 0;
            $pickupTime     = Carbon::now()->addMinutes(60);
            if($totalPrice['discountFixed'] > 0){
                $discount       = number_format($totalPrice['discountFixed'], 3);    
            }else if($totalPrice['discountPercentage'] > 0){
                $discount       = $totalPrice['discountPercentage'];
            }
            $paymentModeId  = $request->input('paymentModeId');
            $orderLaterTime = $request->input('orderLaterTime');
            if (!$cart->isEmpty()) {
                foreach ($cart as $single) {
                    $order_id = Carbon::now()->timestamp;
                    if (!is_null($single->foodItem_id)) {
                        $foodItemPrice = 0;
                        $foodItem      = FoodItem::find($single->foodItem_id);
                        foreach ($foodItem->size as $size) {
                            if ($size->id == $single->size_id) {
                                $foodItemPrice = $size->pivot->price;
                                break;
                            }
                        }
                        Order::create([
                            'order_id'         => $order_id,
                            'transaction_id'   => 'default',
                            'user_id'          => $user->id,
                            'foodItem_id'      => $single->foodItem_id,
                            'size_id'          => $single->size_id,
                            'count'            => $single->count,
                            'price'            => $foodItemPrice,
                            'totalPrice'       => $totalPrice['totalAmount'],
                            'voucher_id'       => $request->input('voucher'),
                            'paymentmode_id'   => $request->input('paymentModeId'),
                            'discount'         => $discount,
                            'discountedAmount' => $totalPrice['discountedAmount'],
                            'status'           => 'Accepted',
                            'orderTime'        => Carbon::now(),
                            'pickupTime'       => $pickupTime,
                            'orderLater'       => $orderLaterTime,
                            'merchant_id'      => $single->merchant_id,
                        ]);
                    } elseif (!is_null($single->addOnItem_id)) {
                        Order::create([
                            'order_id'         => $order_id,
                            'transaction_id'   => 'default',
                            'user_id'          => $user->id,
                            'addOnItem_id'     => $single->addOnItem_id,
                            'parent_id'        => $single->parent_id,
                            'count'            => $single->count,
                            'price'            => $single->addOnItem->addOnItemPrice,
                            'totalPrice'       => $totalPrice['totalAmount'],
                            'voucher_id'       => $request->input('voucher'),
                            'paymentmode_id'   => $request->input('paymentModeId'),
                            'discount'         => $totalPrice['discount'],
                            'discountedAmount' => $totalPrice['discountedAmount'],
                            'status'           => 'Accepted',
                            'orderTime'        => Carbon::now(),
                            'pickupTime'       => $pickupTime,
                            'orderLater'       => $orderLaterTime,
                            'merchant_id'      => $single->merchant_id,
                        ]);
                    } elseif (!is_null($single->combo_id)) {
                        Order::create([
                            'order_id'         => $order_id,
                            'transaction_id'   => 'default',
                            'user_id'          => $user->id,
                            'combo_id'         => $single->combo_id,
                            'count'            => $single->count,
                            'price'            => $single->combo->comboPrice,
                            'totalPrice'       => $totalPrice['totalAmount'],
                            'voucher_id'       => $request->input('voucher'),
                            'paymentmode_id'   => $request->input('paymentModeId'),
                            'discount'         => $totalPrice['discount'],
                            'discountedAmount' => $totalPrice['discountedAmount'],
                            'status'           => 'Accepted',
                            'orderTime'        => Carbon::now(),
                            'pickupTime'       => $pickupTime,
                            'orderLater'       => $orderLaterTime,
                            'merchant_id'      => $single->merchant_id,
                        ]);

                    }
                    if ($user->is_guest == '1') { // Delete data from oath and api_user table
                        OauthAccessToken::where('user_id', $user->id)->delete();
                        ApiUser::where('id', $user->id)->delete();
                    }
                    $cartItems = Cart::where('user_id', $user->id)->get();
                    foreach ($cartItems as $item) {
                        $item->delete();
                    }

                }
                return response()->json([
                    // 'success' => 'True',
                    'code'     => '200',
                    'response' => 'Order Accepted',
                    'order_id' => $order_id,
                ]);
            }
            return response()->json([
                'success'  => 'False',
                'code'     => '400',
                'response' => 'Cart Empty',
            ]);
        }
        return response()->json([
            'success' => 'False',
            'code'    => '400',
            'message' => 'key invalid',
        ]);
    }

    public function show($userId)
    {
        $key     = config('app.registerKey');
        $request = Request::capture();
        if ($request->header('key') == $key) {

            $ordersList = Order::select('id', 'order_id', 'transaction_id', 'user_id', 'foodItem_id', 'size_id',
                'addOnItem_id', 'parent_id', 'combo_id', 'count', 'price', 'totalPrice', 'voucher_id', 'discount',
                'discountedAmount', 'Status', 'orderTime', 'pickupTime', 'merchant_id')->where('user_id', $userId)->with('user',
                'foodItem', 'addOnItem', 'combo', 'foodSizePrice', 'merchant')->orderBy('merchant_id')->get();
            foreach ($ordersList as $order) {
                $order->price      = number_format($order->price, 3);
                $order->totalPrice = number_format($order->totalPrice, 3);
            }
            $merchantList = array();
            if ($ordersList) {
                foreach ($ordersList as $order) {
                    if ($order['merchant']) {

                        if (!in_array($order->merchant->id, array_keys($merchantList))) {
                            $merchant                        = new \stdClass();
                            $merchant->id                    = $order->merchant->id;
                            $merchant->merchantName          = $order->merchant->merchantName;
                            $merchant->merchantDescription   = $order->merchant->merchantDescription;
                            $merchant->merchantMobile        = $order->merchant->merchantMobile;
                            $merchant->merchantEmail         = $order->merchant->merchantEmail;
                            $merchant->merchantAddress       = $order->merchant->merchantAddress;
                            $merchant->merchantArea          = $order->merchant->merchantArea;
                            $merchant->merchantCoordinates   = $order->merchant->merchantCoordinates;
                            $merchant->merchantOpenClose     = $order->merchant->merchantOpenClose;
                            $merchant->merchantAvgTime       = $order->merchant->merchantAvgTime;
                            $merchant->merchantCurrentStatus = $order->merchant->merchantCurrentStatus;
                            $merchant->merchantAge           = $order->merchant->merchantAge;
                            $merchant->merchantAvgBill       = $order->merchant->merchantAvgBill;
                            $merchant->merchantParkingStatus = $order->merchant->merchantParkingStatus;
                            $merchant->merchantStatus        = $order->merchant->merchantStatus;
                            $merchant->merchantCreator       = $order->merchant->merchantCreator;
                            $merchant->merchantNameInArabic  = $order->merchant->merchantNameInArabic;
                            $merchant->merchantDescriptionInArabic  = $order->merchant->merchantDescriptionInArabic;
                            $merchant->merchantAddressInArabic = $order->merchant->merchantAddressInArabic;
                            $merchant->merchantAgeInArabic = $order->merchant->merchantAgeInArabic;
                            $merchant->merchantAreaInArabic = Area::find($merchant->merchantArea)->areaInArabic;


                            $merchantList[$merchant->id] = $merchant;
                        }

                        if (in_array($order->merchant->id, array_keys($merchantList))) {
                            unset($order->merchant);
                            $merchantList[$merchant->id]->order[$order->id] = $order;
                        }
                        if ($order['addOnItem']) {
                            $order['addOnItem']['addOnItemPrice'] = number_format($order['addOnItem']['addOnItemPrice'], 3);
                        }
                        if ($order['combo']) {
                            $order['combo']['comboPrice'] = number_format($order['combo']['comboPrice'], 3);
                        }
                    } else {
                        continue;
                    }
                }
            }

            $merchantList = array_values($merchantList);
            foreach ($merchantList as &$merchant) {
                $merchant->order = array_values($merchant->order);
            }

            return response()->json([
                'code'     => '200',
                'response' => array_values($merchantList),
            ]);
        }
        return response()->json([
            'code'     => '200',
            'response' => 'Key Invalid',
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $order_id)
    {
        if ($request->input('status') == 'Confirmed') {
            $order = Order::where('order_id', $order_id)->update(['Status' => 'Confirmed']);
            flash('Order Successfully Confirmed')->success();
        } elseif ($request->input('status') == 'Declined') {
            $order = Order::where('order_id', $order_id)->update(['Status' => 'Declined']);
            flash('Order Successfully Declined')->success();
        } elseif ($request->input('status') == 'Ready') {
            $order = Order::where('order_id', $order_id)->update(['Status' => 'Ready']);
            flash('Order is Ready for Delivery')->success();
        } elseif ($request->input('status') == 'Delivered') {
            $order = Order::where('order_id', $order_id)->update(['Status' => 'Delivered']);
            flash('Order Successfully Delivered')->success();
        }

        return redirect(route('order.index'));
    }

    public function destroy($cuisine)
    {
        $cuisine = Cuisine::find($cuisine);
        $cuisine->delete();
        flash('Cuisine Successfully Deleted')->error();

        return redirect(route('cuisine.index'));
    }
}
