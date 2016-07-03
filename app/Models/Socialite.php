<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    //
    protected $primaryKey='socialite_id';

    public function user(){
        return $this->belongsTo('App/Models/User','user_id','user_id');
    }
}
