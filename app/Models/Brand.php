<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $primaryKey="brand_id";

    public function goods(){
        return $this->hasMany('App\Models\Goods','brand_id','brand_id');
    }
}
