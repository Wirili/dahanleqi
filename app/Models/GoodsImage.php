<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GoodsImage extends Model
{
    //
    protected $primaryKey='img_id';

    public static function getImage($url)
    {
        if(!\Storage::disk('images')->exists($url))
            $url='\data\no_picture.gif';
        return $url;
    }
}
