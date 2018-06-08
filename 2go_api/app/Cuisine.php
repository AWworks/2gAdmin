<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','cuisineCreator');
    }
}
