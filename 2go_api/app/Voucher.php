<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'voucherCreator');
    }
    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id', 'voucherMerchant');
    }
}
