<?php

use Illuminate\Database\Seeder;
use App\Models\ArticleCat;

class ArticleCatTableSeeder extends Seeder
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
            'cat_id'=>1,
            'cat_name'=>'帮助分类',
            'keywords'=>'帮助words',
            'cat_desc'=>'帮助desc'
        ],[
            'cat_id'=>2,
            'cat_name'=>'帮助分类1',
            'keywords'=>'帮助words',
            'cat_desc'=>'帮助desc',
            'parent_id'=>1
        ],[
            'cat_id'=>3,
            'cat_name'=>'帮助分类2',
            'keywords'=>'帮助words',
            'cat_desc'=>'帮助desc',
            'parent_id'=>2
        ],[
            'cat_id'=>4,
            'cat_name'=>'分类',
            'keywords'=>'帮助words',
            'cat_desc'=>'帮助desc',
            'parent_id'=>0
        ],[
            'cat_id'=>5,
            'cat_name'=>'分类1',
            'keywords'=>'帮助words',
            'cat_desc'=>'帮助desc',
            'parent_id'=>4
        ],[
            'cat_id'=>6,
            'cat_name'=>'分类2',
            'keywords'=>'帮助words',
            'cat_desc'=>'帮助desc',
            'parent_id'=>4
        ]];
        foreach ($list as $item){
            ArticleCat::create($item);
        }
    }
}
