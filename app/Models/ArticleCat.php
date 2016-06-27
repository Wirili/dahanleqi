<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCat extends Model
{
    //
    protected $primaryKey='cat_id';

    public function child_cat(){
        return $this->hasMany('App\Models\ArticleCat','parent_id','cat_id');
    }
}
