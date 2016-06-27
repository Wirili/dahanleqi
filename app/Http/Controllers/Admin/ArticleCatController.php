<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ArticleCat;

class ArticleCatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 文章类别列表
     * @return mixed
     */
    public function index(){
//        $cat_list=ArticleCat::where('parent_id',0)->get();
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
        $cat = ArticleCat::find($id);
        //不允许选择上级类别为子类别
        $child_cat=array_column($this->getCatList($id),'cat_id');
        $article_cat = ArticleCat::whereNotIn('cat_id',$child_cat)->get();
        return view('admin.articlecat.edit', ['cat' => $cat, 'article_cat' => $article_cat]);
    }

    /**
     * 创建文章类别
     * @return mixed
     */
    public function create()
    {
        $cat = new ArticleCat();
        $cat->sort_order=50;
        $cat->show_in_nav=1;
        $article_cat = ArticleCat::all();
        return view('admin.article.cat_edit', ['cat' => $cat, 'article_cat' => $article_cat]);
    }

    /**
     * 保存文章类别
     * @param Request $request
     * @return mixed
     */
    public function save(Request $request)
    {
        if ($request->has('cat_id')) {
            $cat=ArticleCat::find($request->cat_id);
        } else {
            $cat = new ArticleCat();
        }
        $cat->cat_name  = $request->cat_name;
        $cat->parent_id = $request->parent_id;
        $cat->show_in_nav = $request->show_in_nav;
        $cat->sort_order = $request->sort_order;
        $cat->keywords = $request->keywords;
        $cat->cat_desc = $request->cat_desc;
        $cat->save();
        return $this->sysMsg('文章类别保存成功',\URL::action('Admin\ArticleCatController@index'));
    }


    public function del($id)
    {
        $cat = ArticleCat::find($id);
        if($cat->count()) {
            $cat->delete();
            return $this->sysMsg('文章类别删除成功',\URL::action('Admin\ArticleCatController@index'));
        }else
            return $this->sysMsg('文章类别不存在',\URL::action('Admin\ArticleCatController@index'));
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
            if ($item->child_cat()->count() > 0) {
                $this->getCatList($item->cat_id,$level+1,$list);
            }
        }
        return $list;
    }
}
