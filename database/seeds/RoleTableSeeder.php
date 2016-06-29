<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [[
            'name'=>'admin',
            'display_name'=>'管理员'
        ],[
            'name'=>'article',
            'display_name'=>'文章管理员'
        ]];
        $role_user=[[
            'user_id'=>1,
            'role_id'=>1
        ]];
        $permissions =[[
            'name'=>'article_show',
            'display_name'=>'文章管理'
        ],[
            'name'=>'article_new',
            'parent_id'=>'1',
            'display_name'=>'新增文章'
        ],[
            'name'=>'article_edit',
            'parent_id'=>'1',
            'display_name'=>'修改文章'
        ],[
            'name'=>'article_del',
            'parent_id'=>'1',
            'display_name'=>'删除文章'
        ],[
            'name'=>'role_show',
            'display_name'=>'角色管理'
        ],[
            'name'=>'role_new',
            'parent_id'=>'5',
            'display_name'=>'新增角色'
        ],[
            'name'=>'role_edit',
            'parent_id'=>'5',
            'display_name'=>'修改角色'
        ],[
            'name'=>'role_del',
            'parent_id'=>'5',
            'display_name'=>'删除角色'
        ]];
        $permission_role=[[
            'permission_id'=>1,
            'role_id'=>1
        ],[
            'permission_id'=>2,
            'role_id'=>1
        ],[
            'permission_id'=>3,
            'role_id'=>1
        ],[
            'permission_id'=>4,
            'role_id'=>1
        ],[
            'permission_id'=>5,
            'role_id'=>1
        ],[
            'permission_id'=>6,
            'role_id'=>1
        ],[
            'permission_id'=>7,
            'role_id'=>1
        ],[
            'permission_id'=>8,
            'role_id'=>1
        ]];

        foreach ($roles as $role) {
            Role::create($role);
        }

        foreach ($role_user as $item) {
            DB::table('role_user')->insert($item);
        }

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        foreach ($permission_role as $item) {
            DB::table('permission_role')->insert($item);
        }
    }
}
