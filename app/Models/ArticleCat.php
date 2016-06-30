<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCat extends Model
{
    //
    protected $primaryKey='cat_id';
    protected $fillable=['sort_order','show_in_nav'];

    public function children(){
        return $this->hasMany('App\Models\ArticleCat','parent_id','cat_id');
    }

    public function articles(){
        return $this->hasMany('App\Models\Article','cat_id','cat_id');
    }
}
