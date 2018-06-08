<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function favouriteShow(Request $request)
    {
        $key = config('app.registerKey');
        if ($request->header('key') == $key) {
            $user         = $request->user('api');
            $favMerchants = $user->favourite_merchant;
            $getFavMerchantsResponse = [];
            foreach ($favMerchants as $key => $value) {
               $users = \DB::table('favourite_merchant')
               ->join('api_users', 'favourite_merchant.user_id', '=', 'api_users.id')
               ->select('favourite_merchant.*')->where('api_users.id','=',$user->id)
               ->get();
               $getFavMerchantsResponse[] = $value->select('id', 'merchantName', 'merchantDescription', 'merchantDescription', 'merchantMobile', 'merchantEmail', 'merchantAddress', 'merchantArea', 'merchantCoordinates', 'merchantOpenClose', 'merchantAvgTime', 'merchantCurrentStatus', 'merchantAge', 'merchantParkingStatus',
                   'merchantNameInArabic','merchantDescriptionInArabic','merchantAddressInArabic', 'merchantAgeInArabic')
               ->where('id','=',$users[$key]->merchant_id)->first();
           }
           return response()->json([
            'code'    => '200',
            'response'  => $getFavMerchantsResponse,
        ]);
       }
       return response()->json([
        'code'    => '400',
        'response' => 'Bad Request',
    ]);
   }

   public function attach(Request $request)
   {
    $key      = config('app.registerKey');
    $merchant = $request->input('merchant');
    $foodItem = $request->input('foodItem');
    if ($request->header('key') == $key) {
        $user   = $request->user('api');
        $items  = null;
        $items2 = null;
        if (!is_null($foodItem)) {
            $user->favourite_foodItem()->syncWithoutDetaching($foodItem);
            $items = $user->favourite_footItem;
        } elseif (!is_null($merchant)) {
            $user->favourite_merchant()->syncWithoutDetaching($merchant);
            $items = $user->favourite_merchant;
        }
        return response()->json([
            'response' => 'Favourite Added Successfully',
        ]);
    }
    return response()->json([
        'code'    => '400',
        'response' => 'Bad Request',
    ]);
}

public function detach(Request $request)
{
    $key      = config('app.registerKey');
    $foodItem = $request->input('foodItem');
    $merchant = $request->input('merchant');
    if ($request->header('key') == $key) {
        $user  = $request->user('api');
        $items = null;
        if (!is_null($foodItem)) {
            $user->favourite_foodItem()->detach($foodItem);
            $items = $user->favourite_foodItem;
        } elseif (!is_null($merchant)) {
            $user->favourite_merchant()->detach($merchant);
            $items = $user->favourite_merchant;
        }
        return response()->json([
            'response' => 'Favourite Deleted Successfully',
        ]);
    }
    return response()->json([
        'code'    => '400',
        'response' => 'Bad Request',
    ]);
}

}
