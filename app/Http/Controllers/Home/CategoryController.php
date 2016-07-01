<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index($id)
    {
        $cat=Category::find($id);
        if($cat){
            $goods=$cat->goods()->orderBy('goods_id','desc')->paginate(12);
        }
        return view('default.category',['cat'=>$cat,'goods'=>$goods]);
    }
}
