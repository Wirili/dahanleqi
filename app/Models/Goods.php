<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $primaryKey = 'goods_id';
    public function category(){
        return $this->belongsTo('App\Models\Category','cat_id','cat_id');
    }
    public function images(){
        return $this->hasMany('App\Models\GoodsImage','goods_id','goods_id');
    }
    public function covers(){
        return $this->belongsTo('App\Models\GoodsImage','img_id','img_id');
    }
}
