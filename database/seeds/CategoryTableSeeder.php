<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $lists=[[
            'cat_name'=>'超能阿布',
            'cat_desc'=>'',
            'keywords'=>'',
            'show_in_nav'=>true
        ],[
            'cat_name'=>'芦荟系列',
            'cat_desc'=>'',
            'keywords'=>'',
            'show_in_nav'=>true
        ],[
            'cat_name'=>'韩专系列',
            'cat_desc'=>'',
            'keywords'=>'',
            'show_in_nav'=>true
        ]];
        foreach ($lists as $list) {
            Category::create($list);
        }
    }
}
