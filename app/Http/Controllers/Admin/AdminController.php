<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,Redirect;

class AdminController extends Controller
{
    //
    protected $rules = [
    'name' => 'required',
    'email' => 'required',
    'password' => 'same:password_confirm',
    ];

    protected $messages = [
    'name.required' => '请输入管理员名称',
    'email.required' => '请输入电子邮件',
    'password.same' => '两次密码不相同',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.admin.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::all();
        $admin_roles=[];
        foreach ($admin->roles as $role) {
            $admin_roles[$role->id]=1;
        }

        $permission = Permission::where('parent_id',0)->get();
        $perms=[];
        foreach ($admin->roles as $role) {
            foreach ($role->perms as $perm) {
                $perms[$perm->id]=1;
            }
        }
        return view('admin.admin.edit', ['admin' => $admin,'roles'=>$roles,'admin_roles'=>$admin_roles,'permission'=>$permission,'perms'=>$perms]);
    }

    public function create()
    {
        $admin = new Admin();
        $roles = Role::all();
        $admin_roles=[];
        foreach ($admin->roles as $role) {
            $admin_roles[$role->id]=1;
        }

        $permission = Permission::where('parent_id',0)->get();
        $perms=[];
        return view('admin.admin.edit', ['admin' => $admin,'roles'=>$roles,'admin_roles'=>$admin_roles,'permission'=>$permission,'perms'=>$perms]);
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return $this->sysMsg('',null,'error')->withErrors($validator);
        }
        if ($request->has('user_id')) {
            $admin=Admin::find($request->user_id);
        } else {
            $admin = new Admin();
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->has(['password','password_confirm'])){
            $admin->password=\Hash::make($request->password);
        }
        if($admin->save()){
            $data=$request->data;
            $admin->detachRoles();
            $admin->attachRoles($data);
        }
        return $this->sysMsg('管理员保存成功',\URL::action('Admin\AdminController@index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Admin::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Admin::all()->count();
        $recordsFiltered = Admin::all()->count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
