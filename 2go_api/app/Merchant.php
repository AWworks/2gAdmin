<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'merchantCreator');
    }

    public function cuisine()
    {
        return $this->belongsToMany(Cuisine::class, 'merchant_cuisine', 'merchant_id', 'cuisine_id')->select('id', 'cuisineName', 'cuisineNameInArabic');
    }
    public function owner()
    {
        return $this->belongsToMany(User::class, 'merchant_users', 'merchant_id', 'user_id');
    }

    public function payment()
    {
        return $this->belongsToMany(PaymentMode::class, 'merchant_paymode', 'merchant_id', 'payMode_id');
    }
    public function filter_cuisine()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_cuisine', 'cuisine_id', 'merchant_id');
    }
    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'merchantArea');
    }
}
