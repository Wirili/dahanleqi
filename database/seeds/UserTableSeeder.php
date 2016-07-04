<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list=[[
            'name'=>'admin',
            'email'=>'admin@qq.com',
            'password'=>\Hash::make('123456')
        ],[
            'name'=>'霖',
            'email'=>'SJ1234567@qq.com',
            'password'=>\Hash::make('123456')
        ]];
        foreach ($list as $item) {
            User::create($item);
        }
    }
}
