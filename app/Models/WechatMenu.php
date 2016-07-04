<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class WechatMenu extends Model
{
    //
    protected $primaryKey='menus_id';
    public function children(){
        return $this->hasMany('App\Models\WechatMenu','parent_id','menus_id');
    }
}
