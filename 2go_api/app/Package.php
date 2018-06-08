<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','packageCreator');
    }
}
