<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey='cat_id';
    protected $fillable=['sort_order','is_show'];

    public function children(){
        return $this->hasMany('App\Models\Category','parent_id','cat_id');
    }

    public function goods(){
        return $this->hasMany('App\Models\Goods','cat_id','cat_id');
    }
}
