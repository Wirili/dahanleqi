<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCat;
use Validator,Redirect;

class ArticleController extends Controller
{
    //
    protected $rules = [
    'title' => 'required',
    'cat_id' => 'required|numeric|min:1',
    'contents' => 'required',
    ];

    protected $messages = [
    'title.required' => '请输入文章标题',
    'cat_id.required' => '请选择文章类型',
    'cat_id.min' => '请选择文章类型',
    'contents.required' => '请输入文章内容',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if(!$this->adminGate('article_show')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        return view('admin.article.index');
    }

    public function edit($id)
    {
        if(!$this->adminGate('article_edit')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $article = Article::find($id);
        $article_cat = ArticleCat::all();
        return view('admin.article.edit', ['article' => $article, 'article_cat' => $article_cat]);
    }

    public function create()
    {
        if(!$this->adminGate('article_new')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $article = new Article([
            'is_open' => 1
        ]);
        $article_cat = ArticleCat::all();
        return view('admin.article.edit', ['article' => $article, 'article_cat' => $article_cat]);
    }

    public function del($id)
    {
        if(!$this->adminGate('article_del')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $article = Article::find($id);
        if($article) {
            $article->delete();
            return $this->sysMsg(trans('article.del_success'),\URL::action('Admin\ArticleController@index'));
        }else
            return $this->sysMsg(trans('article.del_fail'),\URL::action('Admin\ArticleController@index'),'error');
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['article_edit','article_new'])){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('article_id')) {
            $artcile=Article::find($request->article_id);
        } else {
            $artcile = new Article();
        }
        $artcile->title = $request->title;
        $artcile->cat_id = $request->cat_id;
        $artcile->contents = $request->input('contents','');
        $artcile->author = $request->author;
        $artcile->author_email = $request->author_email;
        $artcile->keywords = $request->keywords;
        $artcile->is_open = $request->input('is_open',0);
        $artcile->file_url = $request->file_url;
        $artcile->link = $request->link;
        $artcile->description = $request->description;
        $artcile->save();
        return $this->sysMsg(trans('article.save_success'),\URL::action('Admin\ArticleController@index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Article::with('article_cat')->orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Article::all()->count();
        $recordsFiltered = Article::all()->count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
