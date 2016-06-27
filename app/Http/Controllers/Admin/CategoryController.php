<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cat_list=$this->getCatList(0);
        return view('admin.category.index',['cat_list'=>$cat_list]);
    }

    /**
     * 递归获取文章分类
     * @param int $parent_id
     * @param int $level
     * @param array $list
     * @return array
     */
    private function getCatList($parent_id,$level = 0,&$list=[]){
        $cat=Category::where('parent_id',$parent_id)->orderBy('sort_order')->get();
        foreach ($cat as $item) {
            $itemArr = $item->toArray();
            $itemArr['level']=$level;
            $list[]=$itemArr;
            if ($item->child_cat()->count() > 0) {
                $this->getCatList($item->cat_id,$level+1,$list);
            }
        }
        return $list;
    }
}
