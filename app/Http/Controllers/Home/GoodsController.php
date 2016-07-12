<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Goods;

class GoodsController extends Controller
{
    //
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index($id)
    {
        $goods=Goods::with('images')->find($id);
        return view('default.goods',['goods'=>$goods]);
    }
}
