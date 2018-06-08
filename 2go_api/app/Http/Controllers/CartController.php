<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Combo;
use App\FoodItem;
use App\Order;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Size;
use App\Area;


class CartController extends Controller
{
    public function store(Request $request)
    {
        $userID = \Auth::id();
        $key = config('app.registerKey');
        if ($request->header('key') == $key) {
            $arrPreviousMerchants = Cart::where('user_id', $userID)->get()->toArray();
            $foodItems = $request->input('foodItems');
            $addOnItems = $request->input('addOnItems');
            $combos = $request->input('combo');
            $override = $request->input('override');
            if(!empty($arrPreviousMerchants)){
                foreach($arrPreviousMerchants as $merchant){
                    $arrPreviousMerchantids[] = $merchant['merchant_id'];
                }
                $uniqueIds = array_unique($arrPreviousMerchantids);
                if(!in_array($request->merchant_id, $uniqueIds)){
                    if(isset($override) && $override == true){
                        \DB::table('carts')->where('user_id', $userID)->whereIn('merchant_id', $uniqueIds)->delete();
                    }else{
                        return response()->json([
                            'code' => '200',
                            'response' => 'Your Previous Merchant\'s Order will be Discarded',
                        ]);
                    }
                }
            }
            if (!is_null($foodItems)) {
               foreach ($foodItems as $item) {
                    if(isset($item['comment'])){
                        $cartObj = Cart::create([
                            'foodItem_id' => $item['foodItem'],
                            'size_id' => $item['size'],
                            'count' => $item['count'],
                            'user_id' => $userID,
                            'merchant_id' => $request->merchant_id,
                            'comment' => $item['comment'],
                        ]);                            
                    }else{
                        $cartObj = Cart::create([
                            'foodItem_id' => $item['foodItem'],
                            'size_id' => $item['size'],
                            'count' => $item['count'],
                            'user_id' => $userID,
                            'merchant_id' => $request->merchant_id,
                        ]);
                    }
                    if(!empty($item['addOnItems'])){

                        foreach($item['addOnItems'] as $addOnItem){
                            if(isset($addOnItem['comment'])){
                                Cart::create([
                                    'addOnItem_id' => $addOnItem['addOnItem'],
                                    //'count' => $addOnItem['count'],
                                    'count' => $item['count'],
                                    'id_ref' => $cartObj->id,
                                    'user_id' => $userID,
                                    'parent_id' => $addOnItem['parent'],
                                    'merchant_id' => $request->merchant_id,
                                    'comment' => $addOnItem['comment'],
                                ]);
                            }else{
                                Cart::create([
                                    'addOnItem_id' => $addOnItem['addOnItem'],
                                    //'count' => $addOnItem['count'],
                                    'count' => $item['count'],
                                    'id_ref' => $cartObj->id,
                                    'user_id' => $userID,
                                    'parent_id' => $addOnItem['parent'],
                                    'merchant_id' => $request->merchant_id,
                                ]);
                            }  
                        } 
                    }
                }
                if (!is_null($combos)) {
                    foreach ($combos as $item) {
                        if(isset($item['comment'])){
                            Cart::create([
                                'combo_id' => $item['combo'],
                                'count' => $item['count'],
                                'user_id' => $userID,
                                'merchant_id' => $request->merchant_id,
                                'comment' => $item['comment'],
                            ]);
                        }else{
                            Cart::create([
                                'combo_id' => $item['combo'],
                                'count' => $item['count'],
                                'user_id' => $userID,
                                'merchant_id' => $request->merchant_id,
                            ]);
                        }
                    }
                }
                $function = new Functions();
                $response = $function->price($userID, null);
                return response()->json([
                    'code' => '200',
                    'response' => $response,
                ]);
            }
            if (!is_null($combos) && is_null($foodItems)) {
                    foreach ($combos as $item) {
                        if(isset($item['comment'])){
                            Cart::create([
                                'combo_id' => $item['combo'],
                                'count' => $item['count'],
                                'user_id' => $userID,
                                'merchant_id' => $request->merchant_id,
                                'comment' => $item['comment'],
                            ]);
                        }else{
                            Cart::create([
                                'combo_id' => $item['combo'],
                                'count' => $item['count'],
                                'user_id' => $userID,
                                'merchant_id' => $request->merchant_id,
                            ]);
                        }
                    }
                }
                $function = new Functions();
                $response = $function->price($userID, null);
                return response()->json([
                    'code' => '200',
                    'response' => $response,
                ]);
        }else{
            return response()->json([
                'code' => '400',
                'message' => 'key invalid'
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'count' => 'required',
        ]);
        $key = config('app.registerKey');
        if ($validator->passes() && $request->header('key') == $key) {
            $cart = Cart::find($id);
            $addOnItems = Cart::where('id_ref', $id)->get();
            if (!is_null($cart)) {
                $v = $request->only('count');
                $cart->update($v);
                if(isset($addOnItems[0]) && !empty($addOnItems[0])){
                    foreach($addOnItems as $addOnItem){
                        $addOnItem->update($v);
                    }
                }
                $user = $request->user('api');
                $function = new Functions();
                $response = $function->price($user->id, null);

                return response()->json([
                    'success' => 'True',
                    'code' => '200',
                    'message' => 'Cart Updated Successfully',
                    'params' => $response,
                ]);
            } else {
                return response()->json([
                    'success' => 'False',
                    'code' => '404',
                    'message' => 'Not found',
                ]);
            }
        }
        return response()->json([
            'success' => 'False',
            'code' => '400',
            'message' => $validator->errors()
        ]);

    }

    public function show($userId)
    {
        if ($userId && is_numeric($userId)) {
            $key = config('app.registerKey');
            $request = Request::capture();
            if ($request->header('key') == $key) {
                $function = new Functions();
                $cartList = $function->price($userId, null);
                if (count($cartList) > 0) {
                    $cartListToShow = new \stdClass();
                    $cartListToShow->cart = new \stdClass();
                    $cartListToShow->combo = new \stdClass();
                    $comboCount = 0;

                    foreach ($cartList['cart'] as $cart) {
                        if (isset($cart['merchant']) && isset($cart['merchant']['merchantArea'])) {
                            $cart['merchant']['merchantAreaInArabic'] = Area::find($cart['merchant']['merchantArea'])->areaInArabic;
                        }
                        if ($cart->foodItem_id === null && $cart->parent_id !== null && $cart->combo_id === null) {//For add on item
                            $foodItemId = $cart->id_ref;

                            if ($foodItemId) {
                                $addOnId = $cart->addOnItem->id;
                                $cartListToShow->cart->$foodItemId->add_on_item->$addOnId = $cart->addOnItem;
                                if ($cart->addOnItem->addOnItemPrice) {
                                    $cartListToShow->cart->$foodItemId->foodItemPriceWithaddOn = $cartListToShow->cart->$foodItemId->foodItemPriceWithaddOn + ($cart->addOnItem->addOnItemPrice * $cart->count);
                                }
                            }
                        } else {
                            if ($cart->foodItem_id !== null && $cart->parent_id === null && $cart->combo_id === null) {//For food item
                                $sizeNameInArabic = Size::find($cart->size_id)->sizeNameInArabic;
                                //@here : $foodItemId is primary key of cart table i.e id.
                                $foodItemId = $cart->id;
                                $cartListToShow->cart->$foodItemId = new \stdClass();
                                $cartListToShow->cart->$foodItemId->id = $cart->id;
                                $cartListToShow->cart->$foodItemId->user_id = $cart->user_id;
                                $cartListToShow->cart->$foodItemId->count = $cart->count;
                                $cartListToShow->cart->$foodItemId->foodItem_id = $cart->foodItem_id;
                                $cartListToShow->cart->$foodItemId->size_id = $cart->size_id;
                                $cartListToShow->cart->$foodItemId->sizeNameInArabic = $sizeNameInArabic;
                                $cartListToShow->cart->$foodItemId->addOnItem_id = $cart->addOnItem_id;
                                $cartListToShow->cart->$foodItemId->merchant_id = $cart->merchant_id;
                                $cartListToShow->cart->$foodItemId->merchant = $cart->merchant;

                                //Setting food items.
                                $cartListToShow->cart->$foodItemId->foodItemName = $cart->foodItem->foodItemName;
                                $cartListToShow->cart->$foodItemId->foodItemDescription = $cart->foodItem->foodItemDescription;
                                $cartListToShow->cart->$foodItemId->foodItemNameInArabic = $cart->foodItem->foodItemNameInArabic;
                                $cartListToShow->cart->$foodItemId->foodItemDescriptionInArabic = $cart->foodItem->foodItemDescriptionInArabic;
                                $cartListToShow->cart->$foodItemId->foodItemStatus = $cart->foodItem->foodItemStatus;
                                $cartListToShow->cart->$foodItemId->foodItemPrice = $cart->foodItem->foodItemPrice;
                                $cartListToShow->cart->$foodItemId->foodItemPriceWithaddOn = 0;
                                $cartListToShow->cart->$foodItemId->foodItemPriceWithaddOn = $cartListToShow->cart->$foodItemId->foodItemPrice ? ($cartListToShow->cart->$foodItemId->foodItemPrice * $cartListToShow->cart->$foodItemId->count) : 0;
                                $cartListToShow->cart->$foodItemId->add_on_item = new \stdClass();

                            } else {
                                if ($cart->foodItem_id === null && $cart->parent_id === null && $cart->combo_id !== null) {//For combo
                                    $cartListToShow->combo->$comboCount = $cart;
                                    $comboCount++;
                                }
                            }
                        }
                    }
                    
                    $cartListToShow->cartPrice = 0;
                    $cartListToShow->foodItemPrice = $cartList['foodItemPrice'];
                    $cartListToShow->addOnItemPrice = $cartList['addOnItemPrice'];
                    $cartListToShow->comboPrice = $cartList['comboPrice'];
                    $cartListToShow->totalAmount = number_format($cartList['totalAmount'], 3);
                    $cartListToShow->discountedAmount = number_format($cartList['discountedAmount'], 3);
                    $cartListToShow->discountFixed = number_format($cartList['discountFixed'], 3);
                    $cartListToShow->discountPercentage = $cartList['discountPercentage'];
                    if($cart->voucher_id != null || $cart->voucher_id != 0)
                    {
                        $cartList1 = $function->price($userId, $cart->voucher_id);
                        $cartListToShow->totalAmount = number_format($cartList1['totalAmount'], 3);
                        $cartListToShow->discountedAmount = number_format($cartList1['discountedAmount'], 3);
                        $cartListToShow->discountFixed = number_format($cartList1['discountFixed'], 3);
                        $cartListToShow->discountPercentage = $cartList1['discountPercentage'];
                    }
                    $cartListToShow->cartDetails = (array)$cartListToShow->cart;
                    $cartListToShow->cartDetails = array_values($cartListToShow->cartDetails);
                    if ($cartListToShow->cartDetails) {
                        foreach ($cartListToShow->cartDetails as &$cartValues) {
                            $cartValues->add_on_item = (array)$cartValues->add_on_item;
                            $cartValues->add_on_item = array_values($cartValues->add_on_item);

                            $cartValues->foodItemPriceWithaddOn = number_format($cartValues->foodItemPriceWithaddOn, 3);
                            $cartListToShow->cartPrice = $cartListToShow->cartPrice + $cartValues->foodItemPriceWithaddOn;
                        }
                    }
                    $cartListToShow->cartPrice = number_format($cartListToShow->cartPrice, 3);
                    unset($cartListToShow->cart);
                    $cartListToShow->combo = array_values((array)$cartListToShow->combo);
                    $cartListToShow->cartDetails = array_merge($cartListToShow->cartDetails, $cartListToShow->combo);
                    unset($cartListToShow->combo);
                    return response()->json([
                        'code' => '200',
                        'response' => $cartListToShow,
                    ]);
                } else {
                    return response()->json([
                        'code' => '200',
                        'response' => array(),
                    ]);
                }

            }
            return response()->json([
                'code' => '400',
                'response' => 'Key Invalid',
            ]);
        }
        return response()->json([
            'code' => '400',
            'response' => 'Invalid user id found',
        ]);
    }

    public function destroy($cartId)
    {
        $key = config('app.registerKey');
        $request = Request::capture();
        if ($request->header('key') == $key) {
            $cartList = null;
            $cart1 = Cart::find($cartId);

            if (!is_null($cart1)) {
                if ($cart1) {
                    $cartList = Cart::where(['user_id' => $cart1->user_id, 'parent_id' => $cart1->foodItem_id])->get();
                    if ($cartList) {
                        foreach ($cartList as $cart) {
                            if ($cart->parent_id && $cart->parent_id == $cart1->foodItem_id && $cart->id_ref == $cartId) {
                                $cart->delete();
                            }
                        }
                    }
                }

                $cart1->delete();

                $function = new Functions();
                $response = $function->price($cart1->user_id, null);

                return response()->json([
                    'code' => '200',
                    'response' => 'Cart Deleted Successfully',
                    'params' => $response,
                ]);
            } else {
                return response()->json([
                    'success' => 'False',
                    'code' => '404',
                    'response' => 'Not found',
                ]);
            }
        }
        return response()->json([
            'success' => 'False',
            'code' => '400',
            'message' => 'Bad Request'
        ]);
    }
}