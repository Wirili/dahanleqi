<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    //
    protected $rules = [
        'cat_name' => 'required',
    ];

    protected $messages = [
        'cat_name.required' => '请输入商品类别名称',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 商品类别列表
     * @return mixed
     */
    public function index()
    {
        if(!$this->adminGate('goods_cat_show')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat_list=$this->getCatList(0);
        return view('admin.category.index',['cat_list'=>$cat_list]);
    }


    /**
     * 编辑商品类别
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        if(!$this->adminGate('goods_cat_edit')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat = Category::find($id);
        //不允许选择上级类别为子类别
        $children=array_merge(array_column($this->getCatList($id),'cat_id'),[$id]);
        $goods_cat = Category::whereNotIn('cat_id',$children)->get();
        return view('admin.category.edit', ['cat' => $cat, 'goods_cat' => $goods_cat]);
    }

    /**
     * 创建商品类别
     * @return mixed
     */
    public function create()
    {
        if(!$this->adminGate('goods_cat_new')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat = new Category([
            'sort_order'=>50,
            'is_show'=>1
        ]);
        $goods_cat = Category::all();
        return view('admin.category.edit', ['cat' => $cat, 'goods_cat' => $goods_cat]);
    }

    /**
     * 保存商品类别
     * @param Request $request
     * @return mixed
     */
    public function save(Request $request)
    {
        if(!$this->adminGate(['goods_cat_new','goods_cat_edit'])){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('cat_id')) {
            $cat=Category::find($request->cat_id);
        } else {
            $cat = new Category();
        }
        $cat->cat_name  = $request->cat_name;
        $cat->parent_id = $request->parent_id;
        $cat->is_show = $request->input('is_show',0);
        $cat->sort_order = $request->input('sort_order',0);
        $cat->keywords = $request->keywords;
        $cat->cat_desc = $request->cat_desc;
        $cat->save();
        return $this->sysMsg(trans('category.save_success'),\URL::action('Admin\CategoryController@index'));
    }


    public function del($id)
    {
        if(!$this->adminGate('goods_cat_del')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat = Category::find($id);
        if($cat&&$cat->goods->isEmpty()&&$cat->children->isEmpty()) {
            $cat->delete();
            return $this->sysMsg(trans('category.del_success'), \URL::action('Admin\CategoryController@index'));
        }else
            return $this->sysMsg(trans('category.del_fail'), \URL::action('Admin\CategoryController@index'),'error');

    }

    /**
     * 递归获取商品分类
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
            if (!$item->children->isEmpty()) {
                $this->getCatList($item->cat_id,$level+1,$list);
            }
        }
        return $list;
    }
}
