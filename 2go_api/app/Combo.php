<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','comboCreator');
    }
    public function foodItem()
    {
        return $this->belongsToMany(FoodItem::class, 'combo_fooditem', 'combo_id', 'foodItem_id');
    }
}
