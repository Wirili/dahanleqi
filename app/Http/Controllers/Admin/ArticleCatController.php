<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\Controller;
use App\Models\ArticleCat;
use Validator;

class ArticleCatController extends Controller
{
    //
    protected $rules = [
        'cat_name' => 'required',
    ];

    protected $messages = [
        'cat_name.required' => '请输入文章类别名称',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 文章类别列表
     * @return mixed
     */
    public function index(){
        if(!$this->adminGate('article_cat_show')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat_list=$this->getCatList(0);
        return view('admin.articlecat.index',['cat_list'=>$cat_list]);
    }

    /**
     * 编辑文章类别
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        if(!$this->adminGate('article_cat_edit')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat = ArticleCat::find($id);
        //不允许选择上级类别为子类别
        $children=array_merge(array_column($this->getCatList($id),'cat_id'),[$id]);
        $article_cat = ArticleCat::whereNotIn('cat_id',$children)->get();
        return view('admin.articlecat.edit', ['cat' => $cat, 'article_cat' => $article_cat]);
    }

    /**
     * 创建文章类别
     * @return mixed
     */
    public function create()
    {
        if(!$this->adminGate('article_cat_new')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat = new ArticleCat([
            'sort_order'=>50,
            'show_in_nav'=>1
        ]);
        $article_cat = ArticleCat::all();
        return view('admin.articlecat.edit', ['cat' => $cat, 'article_cat' => $article_cat]);
    }

    /**
     * 保存文章类别
     * @param Request $request
     * @return mixed
     */
    public function save(Request $request)
    {
        if(!$this->adminGate(['article_cat_new','article_cat_edit'])){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('cat_id')) {
            $cat=ArticleCat::find($request->cat_id);
        } else {
            $cat = new ArticleCat();
        }
        $cat->cat_name  = $request->cat_name;
        $cat->parent_id = $request->parent_id;
        $cat->show_in_nav = $request->input('show_in_nav',0);
        $cat->sort_order = $request->input('sort_order',0);
        $cat->keywords = $request->keywords;
        $cat->cat_desc = $request->cat_desc;
        $cat->save();
        return $this->sysMsg(trans('article.cat.save_success'),\URL::route('admin.article_cat.index'));
    }


    public function del($id)
    {
        if(!$this->adminGate('article_cat_del')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $cat = ArticleCat::find($id);
        if($cat&&$cat->articles->isEmpty()&&$cat->children->isEmpty()) {
            $cat->delete();
            return $this->sysMsg(trans('article.cat.del_success'), \URL::route('admin.article_cat.index'));
        }else
            return $this->sysMsg(trans('article.cat.del_fail'), \URL::route('admin.article_cat.index'),'error');

    }

    /**
     * 递归获取文章分类
     * @param int $parent_id
     * @param int $level
     * @param array $list
     * @return array
     */
    private function getCatList($parent_id,$level = 0,&$list=[]){
        $cat=ArticleCat::where('parent_id',$parent_id)->orderBy('sort_order')->get();
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
