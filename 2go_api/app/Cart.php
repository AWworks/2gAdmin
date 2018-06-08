<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(ApiUser::class, 'id', 'user_id');
    }

    public function foodItem()
    {
        return $this->hasOne(FoodItem::class, 'id', 'foodItem_id')->select('id', 'foodItemName', 'foodItemDescription', 'foodItemStatus', 'foodItemNameInArabic', 'foodItemDescriptionInArabic');
    }

    public function addOnItem()
    {
        return $this->hasOne(AddOnItem::class, 'id', 'addOnItem_id')->select('id', 'addOnItemName', 'addOnItemDescription', 'addOnItemPrice', 'addOnItemStatus', 'addOnItemNameInArabic', 'addOnItemDescriptionInArabic');
    }

    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    public function combo()
    {
        return $this->hasOne(Combo::class, 'id', 'combo_id')->select('id', 'comboName', 'comboDescription', 'comboPrice', 'comboStatus','comboNameInArabic', 'comboDescriptionInArabic');
    }

    public function foodSizePrice()
    {
        return $this->belongsToMany(Size::class, 'size_fooditem', 'foodItem_id', 'size_id')->withPivot('price');
    }
    public function merchant()
   {
       return $this->hasOne(Merchant::class, 'id', 'merchant_id');
   }

}
