<?php

namespace App\Http\Controllers\Admin\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\WechatMenu;
use App\Http\Controllers\Admin\Controller;
use Validator;

class MenuController extends Controller
{
    //
    protected $rules = [
        'name' => 'required',
        'key'  =>'required_if:type,click',
        'url'  =>'required_if:type,view',
    ];

    protected $messages = [
        'name.required' => '请输入菜单标题',
        'key.required_if'=>'类型为click时，key必须填写',
        'url.required_if'=>'类型为view时，网页链接必须填写',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
//        if(!$this->adminGate('wechat_manger')){
//            return $this->sysMsg(trans('sys.no_permission'),'','error');
//        }
        return view('admin.wechat.menu.index');
    }

    public function edit($id)
    {
//        if(!$this->adminGate('menu_edit')){
//            return $this->sysMsg(trans('sys.no_permission'),'','error');
//        }
        $menu = WechatMenu::find($id);
        //不允许选择上级类别为子类别
        $children=array_merge(array_column($this->getCatList($id),'menus_id'),[$id]);
        $menu_cat = WechatMenu::whereNotIn('menus_id',$children)->get();
        return view('admin.wechat.menu.edit', ['menu' => $menu,'menu_cat'=>$menu_cat]);
    }

    public function create()
    {
//        if(!$this->adminGate('menu_new')){
//            return $this->sysMsg(trans('sys.no_permission'),'','error');
//        }
        $menu = new WechatMenu();
        $menu_cat = WechatMenu::all();
        return view('admin.wechat.menu.edit', ['menu' => $menu,'menu_cat'=>$menu_cat]);
    }

    public function del($id)
    {
        if(!$this->adminGate('Menu_del')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $menu = WechatMenu::find($id);
        if($menu) {
            $menu->delete();
            return $this->sysMsg(trans('wechat_menu.del_success'),\URL::route('admin.wechat.menu.index'));
        }else
            return $this->sysMsg(trans('wechat_menu.del_fail'),\URL::route('admin.wechat.menu.index'),'error');
    }

    public function save(Request $request)
    {
//        if(!$this->adminGate(['Menu_edit','Menu_new'])){
//            return $this->sysMsg(trans('sys.no_permission'),'','error');
//        }
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('menus_id')) {
            $menu=WechatMenu::find($request->menus_id);
        } else {
            $menu = new WechatMenu();
        }
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->is_show = $request->input('is_show',0);
        $menu->type = $request->type;
        $menu->key = $request->key;
        $menu->url = $request->url;
        $menu->sort_order = $request->sort_order;
        $menu->save();
        return $this->sysMsg(trans('wechat_menu.save_success'),\URL::route('admin.wechat.menu.index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = WechatMenu::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = WechatMenu::count();
        $recordsFiltered = WechatMenu::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }

    public function upload()
    {
        $button=[];
        $menus=WechatMenu::where('is_show',1)->where('parent_id',0)->get();
        if($menus) {
            foreach ($menus as $menu) {
                $sub_button = null;
                if (!$menu->children->isEmpty()) {
                    foreach ($menu->children as $child) {
                        $sub_button[] = [
                            'name' => $child->name,
                            'type' => $child->type,
                            'url' => $child->url,
                            'key' => $child->key
                        ];
                    }
                }
                if ($sub_button)
                    $button[] = [
                        'name' => $menu->name,
                        'type' => $menu->type,
                        'url' => $menu->url,
                        'key' => $menu->key,
                        'sub_button' => $sub_button
                    ];
                else
                    $button[] = [
                        'name' => $menu->name,
                        'type' => $menu->type,
                        'url' => $menu->url,
                        'key' => $menu->key
                    ];
            }
            \Wechat::menu()->add($button);
        }else{
            \Wechat::menu()->destroy();
        }
        return $this->sysMsg('上传成功',\URL::route('admin.wechat.menu.index'));

    }

    /**
     * 递归获取文章分类
     * @param int $parent_id
     * @param int $level
     * @param array $list
     * @return array
     */
    private function getCatList($parent_id,$level = 0,&$list=[]){
        $cat=WechatMenu::where('parent_id',$parent_id)->orderBy('sort_order')->get();
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
