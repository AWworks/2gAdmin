<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class ApiUser extends Authenticatable
{
    use Notifiable, EntrustUserTrait, HasApiTokens;

    protected $guarded = ['id'];

    /*protected $hidden = [
        'password', 'remember_token',
    ];*/

    public function OauthAccessToken()
    {
        return $this->hasMany('\App\OauthAccessToken');
    }

    public function favourite_foodItem()
    {
        return $this->belongsToMany(FoodItem::class, 'favourite_fooditem', 'user_id', 'foodItem_id');
    }

    public function favourite_merchant()
    {
        return $this->belongsToMany(Merchant::class, 'favourite_merchant', 'user_id', 'merchant_id');
    }

    public function user_orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }    
}
