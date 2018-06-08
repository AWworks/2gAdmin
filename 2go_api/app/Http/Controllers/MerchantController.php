<?php

namespace App\Http\Controllers;

use App\Area;
use App\Cuisine;
use App\FoodCategory;
use App\FoodItem;
use App\Merchant;
use App\PaymentMode;
use App\Role;
use App\User;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user('api');

        if (!empty($user)) {
            $favMerchantsCount = isset($user->favourite_merchant) ? count($user->favourite_merchant) : 0;
            $ordersCount = isset($user->user_orders) ? count($user->user_orders) : 0;
            $cartCount = \App\Cart::where('foodItem_id', '<>', 'null')->where('user_id', '=',
                $user->id)->get()->toArray();

            $path = public_path('images/Merchant');
            if (!file_exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            $merchantsList = Merchant::select('id', 'merchantName', 'merchantDescription', 'merchantMobile',
                'merchantEmail', 'merchantAddress', 'merchantArea', 'merchantAvgBill', 'merchantParkingStatus',
                'merchantCoordinates', 'merchantOpenClose',
                'merchantAvgTime', 'merchantCurrentStatus', 'merchantNameInArabic', 'merchantDescriptionInArabic',
                'merchantAddressInArabic', 'merchantAgeInArabic', 'updated_at')
                ->orderBy('updated_at', 'desc')
                ->with('payment', 'cuisine', 'area')
                ->get();
            $merchants = $merchantsList;
            $request = Request::capture();
            if ($request->hasHeader('Content-Type') == 'application/json') {
                if ($merchantsList) {
                    foreach ($merchantsList as $merchant) {
                        $status = 'CLOSE';
                        $merchantStartTime = str_replace('-', '', explode(',', $merchant->merchantOpenClose)[0]);
                        $merchantEndTime = str_replace('-', '', explode(',', $merchant->merchantOpenClose)[1]);

                        $startTime = substr_replace($merchantStartTime, ':',
                            (strlen($merchantStartTime) == '6') ? 2 : 1, 0);
                        $endTime = substr_replace($merchantEndTime, ':', (strlen($merchantEndTime) == '6') ? 2 : 1, 0);
                        $currTime = strtotime(now());

                        if ($currTime > strtotime(date('Y-m-d') . " " . $startTime) && $currTime < strtotime(date('Y-m-d') . " " . $endTime)) {
                            $status = 'OPEN';
                        }
                        if ($merchant->payment) {
                            foreach ($merchant->payment as &$paymentDetail) {
                                unset($paymentDetail->paymentStatus);
                                unset($paymentDetail->paymentCreator);
                                unset($paymentDetail->created_at);
                                unset($paymentDetail->updated_at);
                                unset($paymentDetail->pivot);
                            }
                        }
                        if ($merchant->cuisine) {
                            foreach ($merchant->cuisine as &$cuisineDetail) {
                                unset($cuisineDetail->pivot);
                            }
                        }
                        $merchant['merchantOpenCloseStatus'] = $status;
                    }
                }
                return response()->json([
                    'code' => '200',
                    'favMerchantsCount' => $favMerchantsCount,
                    'ordersCount' => $ordersCount,
                    'myCartCount' => count($cartCount),
                    'response' => $merchantsList,
                ]);
            }
        } else {
            $merchantsList = Merchant::select('id', 'merchantName', 'merchantDescription', 'merchantMobile',
                'merchantEmail', 'merchantAddress', 'merchantArea', 'merchantAvgBill', 'merchantParkingStatus',
                'merchantCoordinates', 'merchantOpenClose',
                'merchantAvgTime', 'merchantCurrentStatus', 'merchantNameInArabic', 'merchantDescriptionInArabic',
                'merchantAddressInArabic', 'merchantAgeInArabic', 'updated_at')
                ->orderBy('updated_at', 'desc')
                ->with('payment', 'cuisine', 'area')
                ->get();
            $merchants = $merchantsList;

            return view('merchant.index', compact('merchants'));
        }
    }

    public function create()
    {
        $paymentMode = PaymentMode::all();
        $cuisines = Cuisine::all();
        $users1 = User::with('role')->get();
        foreach ($users1 as $user) {
            foreach ($user->role as $role) {
                if ($role->id != 1) {
                    $users[] = $user;
                }
            }
        }
        $areas = Area::all();

        return view('merchant.create', compact('cuisines', 'paymentMode', 'users', 'areas'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'merchantName' => 'required|string|max:255',
            'merchantDescription' => 'required|string|max:255',
            'merchantNameInArabic' => 'string|max:255',
            'merchantDescriptionInArabic' => 'string|max:255',
            'merchantMobile' => 'required|numeric',
            'merchantEmail' => 'required|email',
            'merchantAddress' => 'required|string|max:255',
            'merchantAddressInArabic' => 'string|max:255',
            'merchantArea' => 'required',
            'merchantAvgBill' => 'required|string|max:255',
            'merchantParkingStatus' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'openTime' => 'required|numeric',
            'closeTime' => 'required|numeric',
            'openTimeVal' => 'required|in:AM,PM',
            'closeTimeVal' => 'required|in:AM,PM',
            'payMode' => 'required',
            'cuisines' => 'required',
            'merchantOwners' => 'required',
            'merchantAvgTime' => 'required|numeric',
            'currentStatus' => 'required|in:Active,Busy',
            'merchantAge' => 'required|in:New,Old',
            'iconImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'annotationImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'merchantStatus' => 'required|in:Active,InActive',
        ]);

        // image_store
        $iconImage = $request->file('iconImage');
        $annotationImage = $request->file('annotationImage');
        $merchantName = $request->input('merchantName');
        $iconPath = public_path('images/Merchant/' . $merchantName . '.png');
        $annotationPath = public_path('images/Merchant/' . 'Annotation-' . $merchantName . '.png');

        Image::make($iconImage)->orientate()->encode('png')->save($iconPath);
        Image::make($annotationImage)->orientate()->encode('png')->save($annotationPath);

        $openTime = implode('-', [$request->input('openTime'), $request->input('openTimeVal')]);
        $closeTime = implode('-', [$request->input('closeTime'), $request->input('closeTimeVal')]);
        $merchantOpenClose = implode(',', [$openTime, $closeTime]);

        $latLong = implode(',', [$request->input('latitude'), $request->input('longitude')]);

        if (file_exists($iconPath) && file_exists($annotationPath)) {
            Merchant::create([
                'merchantName' => $merchantName,
                'merchantDescription' => request('merchantDescription'),
                'merchantNameInArabic' => request('merchantNameInArabic'),
                'merchantDescriptionInArabic' => request('merchantDescriptionInArabic'),
                'merchantMobile' => request('merchantMobile'),
                'merchantEmail' => request('merchantEmail'),
                'merchantAddress' => request('merchantAddress'),
                'merchantAddressInArabic' => request('merchantAddressInArabic'),
                'merchantArea' => request('merchantArea'),
                'merchantCoordinates' => $latLong,
                'merchantOpenClose' => $merchantOpenClose,
                'merchantAvgTime' => request('merchantAvgTime'),
                'merchantCurrentStatus' => request('currentStatus'),
                'merchantAge' => request('merchantAge'),
                'merchantAvgBill' => request('merchantAvgBill'),
                'merchantParkingStatus' => request('merchantParkingStatus'),
                'merchantStatus' => request('merchantStatus'),
                'merchantCreator' => \Auth::id(),
            ]);
            flash('Merchant Successfully Added')->success();
        }
        // Making-relations
        $merchant = Merchant::orderBy('created_at', 'desc')->first();
        $pay = $request->input('payMode');
        $cuisines = $request->input('cuisines');
        $owners = $request->input('merchantOwners');
        $merchant->payment()->sync($pay);
        $merchant->cuisine()->sync($cuisines);
        $merchant->owner()->sync($owners);

        return redirect(route('merchant.index'));
    }

    public function show($id, Request $request)
    {
        $merchant = Merchant::where('id', $id)->with('payment')->first();
        $user = $request->user('api');
        $is_favourite = false;
        if (!is_null($merchant)) {
            $owners = $merchant->owner;
            $items = null;
            $ids = null;
            foreach ($owners as $owner) {
                $ids[] = $owner->id;
            }
            $request = Request::capture();
            if ($request->hasHeader('Content-Type') == 'application/json') { 
                $arrFavouriteObj = $user->favourite_merchant->toArray();
                if(isset($arrFavouriteObj) && !empty($arrFavouriteObj)){
                    foreach($arrFavouriteObj as $merchant){
                        $arrfavMerchants[] = $merchant['id'];
                    }
                    if(in_array($id, $arrfavMerchants)){
                        $is_favourite = true;
                    }
                }
                $merchantList = Merchant::select('id', 'merchantName', 'merchantDescription', 'merchantMobile',
                    'merchantEmail', 'merchantAddress', 'merchantArea', 'merchantAvgBill', 'merchantParkingStatus', 'merchantCoordinates', 'merchantOpenClose',
                    'merchantAvgTime', 'merchantCurrentStatus', 'merchantNameInArabic', 'merchantDescriptionInArabic',
                    'merchantAddressInArabic', 'merchantAgeInArabic')->where('id', $id)->with('payment', 'area')->first();
                $merchantList->is_favourite = $is_favourite;
                if ($merchantList->payment) {
                    $paymentList = array();
                    foreach ($merchantList->payment as $payment) {
                        unset($payment->paymentStatus);
                        unset($payment->paymentCreator);
                        unset($payment->created_at);
                        unset($payment->updated_at);
                        unset($payment->pivot);
                        $paymentList[] = $payment;
                    }
                    $merchantList->payment = $paymentList;
                }

                $foodCategories = FoodCategory::whereIn('foodCatCreator', $ids)->where('foodCatStatus',
                    'Active')->get();
                if ($foodCategories) {
                    $foodCategoryList = array();
                    foreach ($foodCategories as $foodCategory) {
                        unset($foodCategory->foodCatStatus);
                        unset($foodCategory->foodCatCreator);
                        unset($foodCategory->created_at);
                        unset($foodCategory->updated_at);
                        $foodCategoryList[] = $foodCategory;
                    }
                    $merchantList->foodCategories = $foodCategoryList;
                }

                $foodItems = FoodItem::where('foodItemStatus', 'Active')->whereIn('foodItemCreator', $ids)->with('add_on_item', 'food_category', 'dish',
                    'size')->get();

                if ($foodItems) {
                    foreach ($foodItems as &$foodItem) {
                        unset($foodItem->foodItemStatus);
                        unset($foodItem->foodItemCreator);
                        unset($foodItem->created_at);
                        unset($foodItem->updated_at);

                        if ($foodItem->add_on_item) {
                            foreach ($foodItem->add_on_item as &$addOnItem) {
                                unset($addOnItem->addOnItemStatus);
                                unset($addOnItem->addOnItemCreator);
                                unset($addOnItem->created_at);
                                unset($addOnItem->updated_at);
                                unset($addOnItem->pivot);
                                if ($addOnItem->addOnItemPrice != null) {
                                    $addOnItem->addOnItemPrice = number_format($addOnItem->addOnItemPrice, 3);
                                }
                            }
                        }

                        if ($foodItem->food_category) {
                            foreach ($foodItem->food_category as &$food) {
                                unset($food->foodCatStatus);
                                unset($food->foodCatCreator);
                                unset($food->created_at);
                                unset($food->updated_at);
                                unset($food->pivot);
                            }
                        }

                        if ($foodItem->dish) {
                            foreach ($foodItem->dish as &$dish) {
                                unset($dish->dishStatus);
                                unset($dish->dishCreator);
                                unset($dish->created_at);
                                unset($dish->updated_at);
                                unset($dish->pivot);
                            }
                        }

                        if ($foodItem->size) {
                            foreach ($foodItem->size as &$size) {
                                unset($size->sizeStatus);
                                unset($size->sizeCreator);
                                unset($size->created_at);
                                unset($size->updated_at);
                                if ($size->pivot) {
                                    $price = $size->pivot->price;
                                    $size->price = number_format($price, 3);
                                }
                                unset($size->pivot);
                            }
                        }
                    }
                    $merchantList->foodItems = $foodItems;
                }

                return response()->json([
                    'code' => '200',
                    'response' => $merchantList,
                ]);
            }
        } else {
            return response()->json([
                'code' => '200',
                'response' => 'No data found.',
            ]);
        }
    }

    public function edit($id)
    {
        $merchant = Merchant::where('id', $id)->with('owner')->first();
        $paymentMode = PaymentMode::all();
        $cuisines = Cuisine::all();
        $users1 = User::with('role')->get();
        foreach ($users1 as $user) {
            foreach ($user->role as $role) {
                if ($role->id != 1) {
                    $users[] = $user;
                }
            }
        }
        $areas = Area::all();
        $openTime = explode(',', $merchant->merchantOpenClose)[0];
        $closeTime = explode(',', $merchant->merchantOpenClose)[1];

        return view('merchant.edit', compact('merchant', 'paymentMode', 'cuisines', 'users', 'areas', 'openTime',
            'closeTime'));
    }

    public function update(Request $request, $merchant)
    {
        $this->validate(request(), [
            'merchantName' => 'required|string|max:255',
            'merchantDescription' => 'required|string|max:255',
            'merchantMobile' => 'required|numeric',
            'merchantEmail' => 'required|email',
            'merchantAddress' => 'required|string|max:255',
            'merchantArea' => 'required',
            'merchantAvgBill' => 'required|string|max:255',
            'merchantParkingStatus' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'openTime' => 'required|numeric',
            'closeTime' => 'required|numeric',
            'openTimeVal' => 'required|in:AM,PM',
            'closeTimeVal' => 'required|in:AM,PM',
            'payMode' => 'required',
            'cuisines' => 'required',
            'merchantOwners' => 'required',
            'merchantAvgTime' => 'required|numeric',
            'merchantCurrentStatus' => 'required|in:Active,Busy',
            'merchantAge' => 'required|in:New,Old',
            'merchantStatus' => 'required|in:Active,InActive',
        ]);

        $merchant = Merchant::find($merchant);
        // image_store
        $iconImage = $request->file('iconImage');
        $annotationImage = $request->file('annotationImage');
        $nameChange = $request->input('merchantName') != $merchant->merchantName;

        $iconOldPath = public_path('images/Merchant/' . $merchant->merchantName . '.png');
        $annotationOldPath = public_path('images/Merchant/' . 'Annotation-' . $merchant->merchantName . '.png');
        $iconNewPath = public_path('images/Merchant/' . $request->input('merchantName') . '.png');
        $annotationNewPath = public_path('images/Merchant/' . 'Annotation-' . $request->input('merchantName') . '.png');

        $openTime = implode('-', [$request->input('openTime'), $request->input('openTimeVal')]);
        $closeTime = implode('-', [$request->input('closeTime'), $request->input('closeTimeVal')]);
        $merchant->merchantOpenClose = implode(',', [$openTime, $closeTime]);

        $merchant->merchantCoordinates = implode(',', [$request->input('latitude'), $request->input('longitude')]);
        //file not changed
        if (is_null($iconImage) && is_null($annotationImage)) {
            $result1 = true;
            $result2 = true;
            if ($nameChange) {
                $result1 = File::move($iconOldPath, $iconNewPath);
                $result2 = File::move($annotationOldPath, $annotationNewPath);
            }
            if ($result1 == true && $result2 == true) {
                $v = $request->except([
                    'iconImage',
                    'annotationImage',
                    'latitude',
                    'longitude',
                    'openTime',
                    'closeTime',
                    'payMode',
                    'cuisines',
                    'openTimeVal',
                    'closeTimeVal',
                    'merchantOwners',
                ]);
                $merchant->update($v);
                flash('Merchant Successfully Updated')->success();

            }
            //icon file changed
        } elseif (!is_null($iconImage) && is_null($annotationImage)) {
            File::delete($iconOldPath);
            Image::make($iconImage)->orientate()->encode('png')->save($iconNewPath);

            $result = true;
            if ($nameChange) {
                $result = File::move($annotationOldPath, $annotationNewPath);
            }
            if ($result == true && file_exists($iconNewPath)) {
                $v = $request->except([
                    'iconImage',
                    'annotationImage',
                    'latitude',
                    'longitude',
                    'openTime',
                    'closeTime',
                    'payMode',
                    'cuisines',
                    'openTimeVal',
                    'closeTimeVal',
                    'merchantOwners',
                ]);
                $merchant->update($v);
                flash('Merchant Successfully Updated')->success();
            }
        } elseif (is_null($iconImage) && !is_null($annotationImage)) {
            File::delete($annotationOldPath);
            Image::make($annotationImage)->orientate()->encode('png')->save($annotationNewPath);

            $result = true;
            if ($nameChange) {
                $result = File::move($iconOldPath, $iconNewPath);
            }
            if ($result == true && file_exists($annotationNewPath)) {
                $v = $request->except([
                    'iconImage',
                    'annotationImage',
                    'latitude',
                    'longitude',
                    'openTime',
                    'closeTime',
                    'payMode',
                    'cuisines',
                    'openTimeVal',
                    'closeTimeVal',
                    'merchantOwners',
                ]);
                $merchant->update($v);
                flash('Merchant Successfully Updated')->success();
            }
        } elseif (!is_null($iconImage) && !is_null($annotationImage)) {
            File::delete($iconOldPath);
            Image::make($iconImage)->orientate()->encode('png')->save($iconNewPath);
            File::delete($annotationOldPath);
            Image::make($annotationImage)->orientate()->encode('png')->save($annotationNewPath);

            if (file_exists($iconNewPath) && file_exists($annotationNewPath)) {
                $v = $request->except([
                    'iconImage',
                    'annotationImage',
                    'latitude',
                    'longitude',
                    'openTime',
                    'closeTime',
                    'payMode',
                    'cuisines',
                    'openTimeVal',
                    'closeTimeVal',
                    'merchantOwners',
                ]);
                $merchant->update($v);
                flash('Merchant Successfully Updated')->success();
            }
        }

        // Making-relations
        $pay = $request->input('payMode');
        $cuisines = $request->input('cuisines');
        $merchantOwners = $request->input('merchantOwners');
        $merchant->payment()->sync($pay);
        $merchant->owner()->sync($merchantOwners);
        $merchant->cuisine()->sync($cuisines);

        return redirect(route('merchant.index'));
    }

    public function destroy($id)
    {
        $merchant = Merchant::find($id);

        $iconPath = public_path('images/Merchant/' . $merchant->merchantName . '.png');
        $annotationPath = public_path('images/Merchant/' . 'Annotation-' . $merchant->merchantName . '.png');

        if (file_exists($iconPath) && file_exists($annotationPath)) {
            $result = File::delete([$iconPath, $annotationPath]);
        }

        //if ($result) {//@todo : Need to handle.
        $merchant->delete();
        flash('Merchant Successfully Deleted')->error();
        //}
        return redirect(route('merchant.index'));
    }

    public function filterMerchant(Request $request)
    {
        $request = Request::capture();
        $key = config('app.registerKey');
        if ($request->header('key') == $key) {
            $area = $request->input('area');
            $avgTime = $request->input('avgTime');
            $age = $request->input('age');
            $cuisines = $request->input('cuisine');
            $payModes = $request->input('payModes');
            $merchant_cuisine = [];
            $merchant_area = [];
            $merchant_age = [];
            $merchant_avgTime = [];
            $merchant_payMode = [];
            $merchs = [];
            if (!is_null($area) && !is_null($avgTime) && !is_null($age) && !is_null($cuisines) && !is_null($payModes)) {
                if ($area != '*') {
                    $merchant_area = Merchant::where('merchantArea', $area)->get();
                } elseif ($area == '*') {
                    $merchant_area = Merchant::all();
                }
                if ($avgTime != '*') {
                    if (!$merchant_area->isEmpty()) {
                        $merchant_avgTime = $merchant_area->where('merchantAvgTime', '<=', explode(',', $avgTime));
                    } else {
                        $merchant_avgTime = Merchant::where('id', 0)->with('cuisine')->get();
                    }
                } elseif ($avgTime == '*') {
                    $merchant_avgTime = $merchant_area;
                }
                if ($age != '*') {
                    if (!$merchant_avgTime->isEmpty()) {
                        $merchant_age = $merchant_avgTime->where('merchantAge', $age);
                    } else {
                        $merchant_age = Merchant::where('id', 0)->with('cuisine')->get();
                    }
                } elseif ($age == '*') {
                    $merchant_age = $merchant_avgTime;
                }
                if ($payModes[0] != '*') {
                    if (!$merchant_age->isEmpty()) {
                        foreach ($merchant_age as $merchant) {
                            foreach ($payModes as $payMode) {
                                foreach ($merchant->payment as $MPay) {
                                    $result = null;
                                    if ($MPay->pivot->payMode_id == $payMode) {
                                        $result = $merchant;
                                        break;
                                    }
                                }
                                $merchs[] = $result;
                            }
                        }
                        if (!is_null($merchs)) {
                            $merchantId = array();
                            foreach ($merchs as $merch) {
                                if (!is_null($merch)) {
                                    $merchantId[] = $merch->id;
                                }
                            }
                            $merchant_payMode = Merchant::select('id', 'merchantName', 'merchantDescription',
                                'merchantMobile',
                                'merchantEmail', 'merchantAddress', 'merchantArea', 'merchantCoordinates',
                                'merchantOpenClose',
                                'merchantAvgTime', 'merchantCurrentStatus', 'merchantNameInArabic',
                                'merchantDescriptionInArabic', 'merchantAddressInArabic',
                                'merchantAgeInArabic')->whereIn('id',
                                $merchantId)->with('payment', 'cuisine', 'area')->get();
                            }
                        }
                    } elseif ($payModes[0] == '*') {
                        $merchant_payMode = $merchant_age;
                    }

                    if ($cuisines[0] != '*') {
                        $merchs = null;
                        if ($merchant_payMode) {
                            foreach ($merchant_payMode as $merchant) {
                                foreach ($merchant->cuisine as $Mcuisine) {
                                    if (in_array($Mcuisine->id, $cuisines)) {
                                        $merchs[] = $merchant;
                                    }
                                }
                            }
                            if (!is_null($merchs)) {
                                $merchantId = array();
                                foreach ($merchs as $merch) {
                                    if (!is_null($merch)) {
                                        $merchantId[] = $merch->id;
                                    }
                                }
                                $merchant_cuisine = Merchant::select('id', 'merchantName', 'merchantDescription',
                                    'merchantMobile',
                                    'merchantEmail', 'merchantAddress', 'merchantArea', 'merchantCoordinates',
                                    'merchantOpenClose',
                                    'merchantAvgTime', 'merchantCurrentStatus', 'merchantNameInArabic',
                                    'merchantDescriptionInArabic', 'merchantAddressInArabic',
                                    'merchantAgeInArabic')->whereIn('id', $merchantId)->with('payment', 'cuisine', 'area')->get();
                            }
                        }
                    } elseif ($cuisines[0] == '*') {
                        $merchant_cuisine = $merchant_payMode;
                    }
                }

                if ($merchant_cuisine) {
                    foreach ($merchant_cuisine as &$merchant) {
                        $status = 'CLOSE';
                        $merchantStartTime = str_replace('-', '', explode(',', $merchant->merchantOpenClose)[0]);
                        $merchantEndTime = str_replace('-', '', explode(',', $merchant->merchantOpenClose)[1]);

                        $startTime = substr_replace($merchantStartTime, ':', (strlen($merchantStartTime) == '6') ? 2 : 1, 0);
                        $endTime = substr_replace($merchantEndTime, ':', (strlen($merchantEndTime) == '6') ? 2 : 1, 0);
                        $currTime = strtotime(now());

                        if ($currTime > strtotime(date('Y-m-d') . " " . $startTime) && $currTime < strtotime(date('Y-m-d') . " " . $endTime)) {
                            $status = 'OPEN';
                        }
                        if ($merchant->payment) {
                            foreach ($merchant->payment as &$payment) {
                                if (strtolower($payment->paymentStatus) == 'active') {
                                    unset($payment->paymentStatus);
                                    unset($payment->paymentCreator);
                                    unset($payment->created_at);
                                    unset($payment->updated_at);
                                    unset($payment->pivot);
                                } else {
                                    continue;
                                }
                            }
                        }
                        if ($merchant->cuisine) {
                            foreach ($merchant->cuisine as &$cuisineDetail) {
                                unset($cuisineDetail->pivot);
                            }
                        }
                        $merchant['merchantOpenCloseStatus'] = $status;
                    }
                }

                return response()->json([
                    'code' => '200',
                    'response' => $merchant_cuisine,
                ]);
            }
            return response()->json([
                'code' => '400',
                'response' => 'Bad Request',
            ]);
        }
    }
