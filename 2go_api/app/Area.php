<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';

    public function governorate()
    {
        return $this->hasOne(Governorate::class, 'id', 'governorate_id')->select('id', 'governorate');
    }
}
