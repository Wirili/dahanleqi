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
            'cat_id'=>1,
            'cat_name'=>'日用百货',
            'cat_desc'=>'',
            'keywords'=>''
        ],[
            'cat_id'=>2,
            'cat_name'=>'洗护用品',
            'cat_desc'=>'',
            'keywords'=>''
        ]];
        foreach ($lists as $list) {
            Category::create($list);
        }
    }
}
