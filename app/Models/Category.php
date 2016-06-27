<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey='cat_id';

    public function child_cat(){
        return $this->hasMany('App\Models\Category','parent_id','cat_id');
    }
}
