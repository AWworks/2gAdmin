<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','sizeCreator');
    }
}
