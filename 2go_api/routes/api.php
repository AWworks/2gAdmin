<?php

Route::post('login', 'ApiUserController@login');
Route::post('register', 'ApiUserController@register');
Route::post('guestRegister', 'ApiUserController@guestRegister');
Route::post('otpVerify', 'ApiUserController@otpVerify');
Route::post('otpResend', 'ApiUserController@otpResend');
Route::resource('merchant', 'MerchantController');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('details', 'ApiUserController@details');
    Route::post('logout', 'ApiUserController@logout');
    Route::post('updateUser', 'ApiUserController@updateUser');
    Route::post('updateProfileImage', 'ApiUserController@updateProfileImage');
    Route::post('updatePassword', 'ApiUserController@updatePassword');
    Route::resource('cart', 'CartController');
    Route::post('favouriteAttach', 'FavouriteController@attach');
    Route::post('favouriteDetach', 'FavouriteController@detach');
    Route::get('favouriteShow', 'FavouriteController@favouriteShow');
    Route::resource('order', 'OrderController');
    Route::get('voucherAmount/{voucher_id}', 'VoucherController@voucherAmount');
    Route::get('orderDetails/{id}', 'OrderDetailsController@show');

    //Route::group(['middleware' => 'scope:guest'], function () {

        Route::resource('cuisine', 'CuisineController');
        Route::resource('merchant', 'MerchantController');
        Route::post('filterMerchant', 'MerchantController@filterMerchant');
        Route::resource('combo', 'ComboController');
        Route::resource('voucher', 'VoucherController');
        Route::resource('size', 'SizeController');
        Route::get('area','AreaController@show');
        Route::resource('orderLater', 'OrderLaterController');
        Route::resource('orderNow', 'OrderNowController');
        Route::resource('merchantAvailability', 'MerchantAvailabilityController');

    //});
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
