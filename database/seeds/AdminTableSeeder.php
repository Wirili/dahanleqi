<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
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
        ]];
        foreach ($list as $item) {
            Admin::create($item);
        }
    }
}
