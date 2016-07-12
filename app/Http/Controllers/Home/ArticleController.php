<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Article;

class ArticleController extends Controller
{
    //
    public function index($id)
    {
        $article=Article::find($id);
        return view('default.article',['article'=>$article]);
    }
}
