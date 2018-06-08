<?php

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::auth();

Route::group(['middleware' => ['auth' /*,'role:Merchant'*/]], function () {

    Route::resource('admin', 'AdminController');
    Route::resource('foodCategory', 'FoodCategoryController');
    Route::resource('foodItem', 'FoodItemController');
    Route::resource('size', 'SizeController');
    Route::resource('addOnCat', 'AddOnCategoryController');
    Route::resource('addOnItem', 'AddOnItemController');
    Route::resource('combo', 'ComboController');
    Route::resource('order', 'OrderController');

    Route::group(['middleware' => ['role:Admin']], function () {

        Route::resource('users', 'Admin\UserController', ['except' => ['index']]);
        Route::resource('dish', 'DishController');
        Route::resource('cuisine', 'CuisineController');
        Route::resource('package', 'PackageController');
        Route::resource('restaurant', 'RestaurantsController');
        Route::resource('merchant', 'MerchantController');
        Route::resource('paymentMode', 'PaymentModeController');
        Route::resource('voucher', 'VoucherController');
        Route::resource('faq', 'FaqController');
        Route::resource('policy', 'PolicyController');

    });
});

Route::get('/foodItem/edit/{id}', [
    //'middleware' => ['auth', ''],
    'uses' => 'FoodItemController@edit',
]);

Route::post('/foodItem/edit/{id}', [
    //'middleware' => ['auth', ''],
    'uses' => 'FoodItemController@updateFoodItem',
]);

Route::get('ajax',function(){
   return view('message');
});
Route::post('getOrderDetail','AjaxController@getOrderDetails');
