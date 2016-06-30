<?php

namespace App\Http\Controllers\admin;

use App\models\GoodsImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Category;
use App\Models\Brand;

use Validator;

class GoodsController extends Controller
{
    //
    protected $rules = [
        'cat_id' => 'required|numeric|min:1',
        'market_price' => 'numeric',
        'shop_price' => 'numeric',
    ];

    protected $messages = [
        'cat_id.required' => '请选择商品分类',
        'cat_id.min' => '请选择商品分类',
        'market_price.numeric' => '市场价格请输入数字',
        'shop_price.numeric' => '商品价格请输入数字',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if(!$this->adminGate('goods_show')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        return view('admin.goods.index');
    }

    public function edit($id)
    {
        if(!$this->adminGate('goods_edit')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $goods = Goods::find($id);
        $goods_cat = Category::all();
        $brands = Brand::all();
        return view('admin.goods.edit', ['goods' => $goods,'goods_cat'=>$goods_cat,'brands'=>$brands]);
    }

    public function create()
    {
        if(!$this->adminGate('goods_new')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $goods = new Goods();
        $goods->sort_order=50;
        $goods->click_count=0;
        $goods_cat = Category::all();
        $brands = Brand::all();
        return view('admin.goods.edit', ['goods' => $goods,'goods_cat'=>$goods_cat,'brands'=>$brands]);
    }

    public function del($id)
    {
        if(!$this->adminGate('goods_del')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $goods = Goods::find($id);
        if($goods) {
            if($goods->images) {
                foreach ($goods->images as $item) {
                   \Storage::disk('images')->delete($item->img_url);
                    \Storage::disk('images')->delete($item->thumb_url);
                    \Storage::disk('images')->delete($item->original_url);
                    $item->delete();
                }
            }
            $goods->delete();
            return $this->sysMsg(trans('goods.del_success'),\URL::action('Admin\GoodsController@index'));
        }else
            return $this->sysMsg(trans('goods.del_fail'),\URL::action('Admin\GoodsController@index'),'error');
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['goods_new','goods_edit'])){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('goods_id')) {
            $goods=Goods::find($request->goods_id);
            if($request->img_id_del) {
                $img_id_del=explode(',', $request->img_id_del);
                foreach ($img_id_del as &$item) {
                    $item=intval($item);
                }
                foreach($goods->images->whereIn('img_id', $img_id_del) as $item){
                    \Storage::disk('images')->delete($item->img_url);
                    \Storage::disk('images')->delete($item->thumb_url);
                    \Storage::disk('images')->delete($item->original_url);
                    $item->delete();
                };
            }
        } else {
            $goods = new Goods();
        }
        $goods->goods_sn = $request->goods_sn;
        $goods->goods_name = $request->goods_name;
        $goods->goods_barcode = $request->input('goods_barcode','');
        $goods->cat_id = $request->cat_id;
        $goods->brand_id = $request->brand_id;
        $goods->market_price = $request->market_price;
        $goods->shop_price = $request->shop_price;
        $goods->keywords = $request->keywords;
        $goods->goods_desc = $request->goods_desc;
        $goods->goods_desc_short = $request->goods_desc_short;
        $goods->img_id = $request->img_id;
        $goods->is_delete = $request->input('is_delete',0);
        $goods->is_on_sale = $request->input('is_on_sale',0);
        $goods->is_best = $request->input('is_best',0);
        $goods->is_new = $request->input('is_new',0);
        $goods->is_hot = $request->input('is_hot',0);
        $goods->sort_order = $request->input('sort_order',50);
        $goods->click_count = $request->input('click_count',0);
        $goods->save();
        //保存图片
        $files=$request->file('input4');
        foreach ($files as $file) {
            if($file) {
                $filename = '/data/images/img/' . $request->goods_id . "_" . date('YmsHis') . rand(10000, 99999) . ".jpg";
                $filename_thumb = '/data/images/thumb/' . $request->goods_id . "_" . date('YmsHis') . rand(10000, 99999) . ".jpg";
                $filename_original = '/data/images/original/' . $request->goods_id . "_" . date('YmsHis') . rand(10000, 99999) . ".jpg";
                \Storage::disk('images')->put($filename, \File::get($file));
                \Storage::disk('images')->put($filename_thumb, \File::get($file));
                \Storage::disk('images')->put($filename_original, \File::get($file));
                $goodsimages = new GoodsImage();
                $goodsimages->goods_id = $goods->goods_id;
                $goodsimages->img_desc = $goods->goods_id;
                $goodsimages->img_url = $filename;
                $goodsimages->thumb_url = $filename_thumb;
                $goodsimages->original_url = $filename_original;
                $goodsimages->save();
            }
        }
        if(!GoodsImage::where('goods_id',$goods->goods_id)->where('img_id',$goods->img_id)->count()){
            $goods->img_id = GoodsImage::where('goods_id',$goods->goods_id)->first()->img_id ?? 0;
            $goods->save();
        }
        return $this->sysMsg(trans('goods.save_success'),\URL::route('admin.goods.index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Goods::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Goods::all()->count();
        $recordsFiltered = Goods::all()->count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }

    public function ajax_img(Request $request)
    {
        $files=$request->file('input4');
        foreach ($files as $file) {
            $filename='/data/images/img/'.$request->goods_id."_".date('YmsHis').rand(10000,99999).".jpg";
            $filename_thumb='/data/images/thumb/'.$request->goods_id."_".date('YmsHis').rand(10000,99999).".jpg";
            $filename_original='/data/images/original/'.$request->goods_id."_".date('YmsHis').rand(10000,99999).".jpg";
            \Storage::disk('images')->put($filename, \File::get($file));
            \Storage::disk('images')->put($filename_thumb, \File::get($file));
            \Storage::disk('images')->put($filename_original, \File::get($file));
            $goodsimages=new GoodsImage();
            $goodsimages->goods_id=$request->goods_id;
            $goodsimages->img_desc=$request->goods_id;
            $goodsimages->img_url=$filename;
            $goodsimages->thumb_url=$filename_thumb;
            $goodsimages->original_url=$filename_original;
            $goodsimages->save();
        }
        return \Response::json(['error11'=>'ok']);
    }
}
