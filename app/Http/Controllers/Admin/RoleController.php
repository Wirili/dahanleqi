<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\Controller;
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
        if(!$this->adminGate('role_show')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        return view('admin.role.index');
    }

    public function edit($id)
    {
        if(!$this->adminGate('role_edit')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
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
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $role = new Role();
        $permission = Permission::where('parent_id',0)->get();
        $perms=[];
        return view('admin.role.edit', ['role' => $role,'permission'=>$permission,'perms'=>$perms]);
    }

    public function del($id)
    {
        if(!$this->adminGate('role_del')){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
        }
        $role = Role::find($id);
        if($role&&$role->users->isEmpty()) {
                $role->delete();
                return $this->sysMsg(trans('role.del_success'),\URL::action('Admin\RoleController@index'));
        }else
            return $this->sysMsg(trans('role.del_fail'),\URL::action('Admin\RoleController@index'),'error');
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['role_edit','role_new'])){
            return $this->sysMsg(trans('sys.no_permission'),'','error');
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
        return $this->sysMsg(trans('role.save_success'),\URL::action('Admin\RoleController@index'));
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
