<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddOnItem extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','addOnItemCreator');
    }
    public function category()
    {
        return $this->belongsToMany(AddOnCategory::class,'addoncat_addonitem','addOnItem_id', 'addOnCat_id');
    }


}
