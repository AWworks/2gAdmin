<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'text' => 'array'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','foodCatCreator');
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class,'dish_foodcategory','foodCategory_id', 'dish_id');
    }
}
