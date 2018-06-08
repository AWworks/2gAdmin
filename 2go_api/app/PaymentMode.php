<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    protected $guarded = ['id'];
    protected $table = 'paymentmodes';

    public function user()
    {
        return $this->hasOne(User::class,'id','paymentCreator');
    }
}
