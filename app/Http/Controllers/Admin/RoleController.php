<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Validator;

class RoleController extends Controller
{
    //
    protected $rules = [
        'name' => 'required',
        'display_name' => 'required',
    ];

    protected $messages = [
        'name.required' => '请输入角色代码',
        'display_name.required' => '请输入角色名',
    ];
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.role.index');
    }

    public function edit($id)
    {
        if(!$this->adminGate('role_edit')){
            return $this->sysMsg('没有权限');
        }
        $role = Role::find($id);
        $permission = Permission::where('parent_id',0)->get();
        $perms=[];
        foreach ($role->perms as $perm) {
            $perms[$perm->id]=1;
        }
        return view('admin.role.edit', ['role' => $role,'permission'=>$permission,'perms'=>$perms]);
    }

    public function create()
    {
        if(!$this->adminGate('role_new')){
            return $this->sysMsg('没有权限');
        }
        $role = new Role();
        $permission = Permission::where('parent_id',0)->get();
        $perms=[];
        return view('admin.role.edit', ['role' => $role,'permission'=>$permission,'perms'=>$perms]);
    }

    public function del($id)
    {
        if(!$this->adminGate('role_del')){
            return $this->sysMsg('没有权限');
        }
        $role = Role::find($id);
        if($role) {
            if($role->users->isEmpty()){
                $role->delete();
                return $this->sysMsg('角色删除成功',\URL::action('Admin\RoleController@index'));
            }else{
                return $this->sysMsg('角色删除失败，请确保角色没有被管理员使用后再尝试删除！',\URL::action('Admin\RoleController@index'));
            }
        }else
            return $this->sysMsg('角色不存在',\URL::action('Admin\RoleController@index'));
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['role_edit','role_new'])){
            return $this->sysMsg('没有权限');
        }
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('id')) {
            $role=Role::find($request->id);
        } else {
            $role = new Role();
        }
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        if($role->save()){
            $data=$request->data;
            $role->savePermissions($data);
        }
        return $this->sysMsg('角色保存成功',\URL::action('Admin\RoleController@index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Role::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Role::all()->count();
        $recordsFiltered = Role::all()->count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
