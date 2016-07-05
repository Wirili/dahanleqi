<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index($id)
    {
        dd(phpinfo());
        $cat=Category::find($id);
        if($cat){
            $goods=$cat->goods()->orderBy('goods_id','desc')->paginate(12);
        }
        return view('default.category',['cat'=>$cat,'goods'=>$goods]);
    }

    public function qrcode()
    {
        $lists=DB::table('qrcode')->get();
        foreach ($lists as $list) {
            $filename='/data/qrcode_img/'.$list->qrcode.'-'.$list->password.'.png';
            if(!\Storage::disk('images')->exists($filename))
                \Storage::disk('images')->put($filename, \QrCode::format('png')->size(400)->generate('http://weixin.qq.com/r/9ENocGfEDjpxrSMT9xbm-'.$list->qrcode));
        }
        dd($lists);
        return '成功';
    }

    public function xqrcode()
    {
        $lists=DB::table('qrcode')->select('xqrcode')->distinct()->get();
        foreach ($lists as $list) {
            $filename='/data/xqrcode_img/'.$list->xqrcode.'.png';
            if(!\Storage::disk('images')->exists($filename))
                \Storage::disk('images')->put($filename, \QrCode::format('png')->size(400)->generate('http://weixin.qq.com/r/9ENocGfEDjpxrSMT9xbm-'.$list->xqrcode));
        }
        dd($lists);
        return '成功';
    }
}
