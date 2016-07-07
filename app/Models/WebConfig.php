<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    //
    public function children()
    {
        return $this->hasMany('App\Models\WebConfig','parent_id','id');
    }
}
