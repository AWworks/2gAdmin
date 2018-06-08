<?php

namespace App\Http\Controllers;


use App\Cart;
use App\FoodItem;
use App\Merchant;
use App\Voucher;
use Carbon\Carbon;

class Functions
{
    public function ownerId()
    {
        $userId = \Auth::id();
        $merchants = Merchant::with('owner')->get();
        $ids = [];
        $owners=null;
        foreach ($merchants as $merchant) {
            foreach ($merchant->owner as $owner) {
                if ($owner->id == $userId) {
                    $owners = $merchant->owner;

                }
            }
        }
        if (!is_null($owners)) {
            foreach ($owners as $owner) {
                $ids[] = $owner->id;
            }
        }
        return $ids;
    }

    public function price($user, $voucherId)
    {
        $cart = Cart::select('id','user_id','count',
            'foodItem_id','size_id','addOnItem_id','merchant_id','parent_id','combo_id', 'id_ref','voucher_id')
        ->where('user_id', $user)->with('foodItem', 'combo', 'addOnItem','merchant')->get();


        if (!$cart->isEmpty() && count($cart) > 0) {
            $items = null;
            $cart_foodItems = null;
            $cart_addOnItems = null;
            $cart_combo = null;
            $price = null;
            $foodItemPrice = null;
            $addOnItemPrice = null;
            $comboPrice = null;
            $discountedAmount = 0;
            $discountFixed = 0;
            $discountPercentage = 0;
            foreach ($cart as &$single) {
                $data = \DB::table('size_fooditem')->where(['foodItem_id'=>$single['foodItem_id'], 'size_id'=>$single['size_id']])->get(['price']);
                if(count($data)){
                    $single['foodItem']->foodItemPrice = $data[0]->price;
                }

                if (!is_null($single->foodItem_id)) {
                    $cart_foodItems[] = $single;
                } elseif (!is_null($single->addOnItem_id)) {
                    $cart_addOnItems[] = $single;
                } elseif (!is_null($single->combo_id)) {
                    $cart_combo[] = $single;
                }
            }

            if (!is_null($cart_foodItems)) {
                foreach ($cart_foodItems as $cart_foodItem) {
                    $foodItem = FoodItem::find($cart_foodItem->foodItem_id);
                    foreach ($foodItem->size as $size) {
                        if ($size->id == $cart_foodItem->size_id) {
                            $price = $size->pivot->price;
                            break;
                        }
                    }
                    $foodItemPrice[] = $price * $cart_foodItem->count;
                }
            }
            if (!is_null($cart_addOnItems)) {
                foreach ($cart_addOnItems as $addOnItem) {
                    $price = $addOnItem->addOnItem->addOnItemPrice;
                    $addOnItemPrice[] = $price * $addOnItem->count;
                }
            }
            if (!is_null($cart_combo)) {
                foreach ($cart_combo as $combo) {
                    $price = $combo->combo->comboPrice;
                    $comboPrice[] = $price * $combo->count;
                }
            }

            if (!is_null($foodItemPrice)) {
                $foodItemPrice = array_sum($foodItemPrice);
            }
            if (!is_null($addOnItemPrice)) {
                $addOnItemPrice = array_sum($addOnItemPrice);
            }
            if (!is_null($comboPrice)) {
                $comboPrice = array_sum($comboPrice);
            }
            $totalAmount = $foodItemPrice + $addOnItemPrice + $comboPrice;

            $voucher = Voucher::where('id', $voucherId)->first();

            if (!is_null($voucher) && $voucher->voucherStatus == 'Active' && strtotime($voucher->voucherExpiry) > strtotime(Carbon::now())
                &&  $voucher->voucherCount < $voucher->voucherTimes
            ) {
                $voucher->voucherCount = $voucher->voucherCount + 1;
                $voucher->save();
                if ($voucher->voucherType == 'Fixed') {
                    $discountedAmount = $totalAmount - $voucher->voucherAmount;
                    $discountFixed = $voucher->voucherAmount;
                } elseif ($voucher->voucherType == 'Percentage') {
                    $amount = ($totalAmount / 100) * $voucher->voucherAmount;
                    $discountedAmount = $totalAmount - $amount;
                    $discountPercentage = $voucher->voucherAmount . '%';
                }
            }

            $response = ['foodItemPrice' => $foodItemPrice,
                'addOnItemPrice' => $addOnItemPrice,
                'comboPrice' => $comboPrice,
                'totalAmount' => $totalAmount,
                'discountedAmount' => $discountedAmount,
                'discountFixed' => $discountFixed,
                'discountPercentage' => $discountPercentage,
                'cart' => $cart
            ];
            return $response;
        } else {
            return $response = null;
        }
    }

}