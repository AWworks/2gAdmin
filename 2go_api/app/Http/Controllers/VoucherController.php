<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Voucher;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class VoucherController extends Controller
{
    public function index()
    {
        $function = new Functions();
        $vouchers = Voucher::whereIn('voucherCreator', $function->ownerId())->with('user', 'merchant')->get();

        //$vouchers = Voucher::where('')->with('user', 'merchant')->get();
        $request = Request::capture();
        if ($request->hasHeader('Content-Type') == 'application/json') {
            return response()->json([
                // 'success' => 'True',
                'code' => '200',
                // 'message' => 'Access Granted',
                // 'params' => $vouchers,
                'response' => 'Not Found.'
            ]);
        }
        return view('voucher.index', compact('vouchers'));
    }

    public function create()
    {
        $merchants = Merchant::all();
        return view('voucher.create', compact('merchants'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'voucherName' => 'required|string|max:255|unique:vouchers,voucherName',
            'voucherType' => 'required|string|max:255',
            'voucherAmount' => 'required|numeric',
            'voucherExpiry' => 'required|string|max:255',
            'voucherMerchant' => 'required',
            'voucherTimes' => 'required|numeric',
            'voucherStatus' => 'required|in:Active,InActive',
        ]);

        $count = 0;

        //Voucher::create(Input::all());
        Voucher::create([
            'voucherName' => request('voucherName'),
            'voucherType' => request('voucherType'),
            'voucherAmount' => request('voucherAmount'),
            'voucherExpiry' => request('voucherExpiry'),
            'voucherMerchant' => request('voucherMerchant'),
            'voucherTimes' => request('voucherTimes'),
            'voucherCount' => $count,
            'voucherStatus' => request('voucherStatus'),
            'voucherCreator' => \Auth::id(),
        ]);
        flash('Voucher Successfully Created')->success();

        return redirect(route('voucher.index'));
    }

    public function show($id)
    {
        $vouchers = Voucher::where('voucherMerchant', $id)->with('merchant')->get();

        foreach ($vouchers as $voucher) {
            $voucher->voucherAmount = number_format($voucher->voucherAmount, 3);
        }
        if (count($vouchers) > 0) {
            return response()->json([
                'code' => '200',
                'response' => $vouchers,
            ]);
        } else {
            return response()->json([
                'code' => '200',
                'response' => 'No data found.',
            ]);
        }
    }

    public function edit($voucher)
    {
        $voucher = Voucher::find($voucher);
        $merchants = Merchant::all();
        return view('voucher.edit', compact('voucher', 'merchants'));
    }

    public function update(Request $request, $voucher)
    {
        $this->validate(request(), [
            'voucherName' => 'required|string|max:255',
            'voucherType' => 'required|string|max:255',
            'voucherAmount' => 'required|numeric',
            'voucherExpiry' => 'required|string|max:255',
            'voucherMerchant' => 'required',
            'voucherTimes' => 'required|numeric',
            'voucherStatus' => 'required|in:Active,InActive',
        ]);
        $count = 1;

        $voucher = Voucher::find($voucher);
        $v = $request->except(['voucherCount', 'voucherCreator']);
        try {
            $voucher->update($v);
            $voucher->fill(['voucherCount' => $count, 'voucherCreator' => \Auth::id()])->save();
            flash('Voucher Successfully Updated')->success();
        } catch (\Exception $ex) {
            if ($ex->getCode() == 23000) {
                flash('Voucher with Same Name already Exists')->error();
            }
        }


        return redirect(route('voucher.index'));
    }

    public function destroy($voucher)
    {
        $voucher = Voucher::find($voucher);
        $voucher->delete();
        flash('Voucher Successfully Deleted')->error();

        return redirect(route('voucher.index'));
    }

    public function voucherAmount($voucher_id)
    {
        $key = config('app.registerKey');
        $request = Request::capture();

        if ($request->header('key') == $key) {
            $userId = Auth::id();
            $function = new Functions();
            $cartList = $function->price($userId, $voucher_id);

            if(!empty($cartList)){
                $cartListToShow = new \stdClass();
                $cartListToShow->cart = new \stdClass();

                foreach ($cartList['cart'] as $cart) {
                    if ($cart->foodItem_id === null) {
                        $foodItemId = $cart->parent_id;
                        $addOnId = $cart->addOnItem->id;

                        if ($cart->addOnItem->addOnItemPrice) {
                            $cart->addOnItem->addOnItemPrice = number_format($cart->addOnItem->addOnItemPrice, 3);
                        }
                        $cartListToShow->cart->$foodItemId->add_on_item->$addOnId = $cart->addOnItem;

                        if ($cart->addOnItem->addOnItemPrice) {
                            $cartListToShow->cart->$foodItemId->foodItemPriceWithaddOn = $cartListToShow->cart->$foodItemId->foodItemPriceWithaddOn + ($cart->addOnItem->addOnItemPrice * $cart->count);
                        }
                    } else {
                        $foodItemId = $cart->foodItem_id;
                        $cartListToShow->cart->$foodItemId = new \stdClass();
                        $cartListToShow->cart->$foodItemId->id = $cart->id;
                        $cartListToShow->cart->$foodItemId->user_id = $cart->user_id;
                        $cartListToShow->cart->$foodItemId->count = $cart->count;
                        $cartListToShow->cart->$foodItemId->foodItem_id = $cart->foodItem_id;
                        $cartListToShow->cart->$foodItemId->size_id = $cart->size_id;
                        $cartListToShow->cart->$foodItemId->addOnItem_id = $cart->addOnItem_id;
                        $cartListToShow->cart->$foodItemId->merchant_id = $cart->merchant_id;
                        $cartListToShow->cart->$foodItemId->combo_id = $cart->combo_id;
                        $cartListToShow->cart->$foodItemId->combo = $cart->combo;
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
                    }
                }
                $cartListToShow->cartPrice = 0;
                $cartListToShow->comboPrice = $cart->comboPrice;
                $cartListToShow->totalAmount = number_format($cartList['totalAmount'], 3);
                $cartListToShow->discountedAmount = number_format($cartList['discountedAmount'], 3);
                $cartListToShow->discountFixed = number_format($cartList['discountFixed'], 3);
                $cartListToShow->discountPercentage = $cartList['discountPercentage'];
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
                $cartUpdate = Cart::where('user_id', $userId)
                ->update(['voucher_id' => $voucher_id]);
                return response()->json([
                    'code' => '200',
                    'response' => $cartListToShow,
                ]);
            }else{
                return response()->json([
                    'success' => 'False',
                    'code' => '200',
                    'message' => 'Provided voucher is not valid',
                ]);
            }
        }

        return response()->json([
            'success' => 'False',
            'code' => '200',
            'message' => 'Key Invalid',
        ]);
    }
}
