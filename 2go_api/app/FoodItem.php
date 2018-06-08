<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'foodItemCreator');
    }

    public function add_on_item()
    {
        return $this->belongsToMany(AddOnItem::class, 'addonitem_fooditem', 'foodItem_id', 'addOnItem_id');
    }

    public function food_category()
    {
        return $this->belongsToMany(FoodCategory::class, 'foodcategory_fooditem', 'foodItem_id', 'foodCategory_id');
    }

    public function dish()
    {
        return $this->belongsToMany(Dish::class, 'dish_fooditem', 'foodItem_id', 'dish_id');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'size_fooditem', 'foodItem_id', 'size_id')->withPivot('price');
    }

    public function getFooditemDetails($id)
    {
        $getFooditemDetails['foodItem'] = FoodItem::where('id', $id)->get()->toArray();

        $getFooditemDetails['AddOnItem'] = DB::table('addonitem_fooditem')
            ->select('add_on_items.id', 'add_on_items.addOnItemName', 'add_on_items.addOnItemDescription', 'addonitem_fooditem.addOnItem_id')
            ->leftjoin('add_on_items', 'addonitem_fooditem.addOnItem_id', '=', 'add_on_items.id')
            ->where([['addonitem_fooditem.foodItem_id', '=', $id],
                ['add_on_items.addOnItemStatus', '=', 'Active']])
            ->get()
            ->toArray();
        $getFooditemDetails['FoodCategory'] = DB::table('food_categories')
            ->select('food_categories.id', 'food_categories.foodCatName', 'foodcategory_fooditem.foodCategory_id')
            ->leftjoin('foodcategory_fooditem', 'food_categories.id', '=', 'foodcategory_fooditem.foodCategory_id')
            ->where('foodcategory_fooditem.foodItem_id', $id)
            ->get()
            ->toArray();
        $getFooditemDetails['dishes'] = DB::table('dishes')
            ->select('dishes.id', 'dishes.dishName', 'dish_fooditem.dish_id')
            ->leftjoin('dish_fooditem', 'dishes.id', '=', 'dish_fooditem.dish_id')
            ->where('dish_fooditem.foodItem_id', $id)
            ->get()
            ->toArray();
        $getFooditemDetails['sizes'] = DB::table('sizes')
            ->select('sizes.id', 'sizes.sizeName', 'size_fooditem.size_id', 'size_fooditem.price')
            ->leftjoin('size_fooditem', 'sizes.id', '=', 'size_fooditem.size_id')
            ->where('size_fooditem.foodItem_id', $id)
            ->get()
            ->toArray();
        return $getFooditemDetails;
    }
}
