<?php

use Illuminate\Database\Seeder;
use App\Models\WebConfig;

class WebConfigTableSeeder extends Seeder
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
            'code'=>'info',
            'type'=>'group'
        ],[
            'code'=>'basic',
            'type'=>'group'
        ],[
            'parent_id'=>1,
            'code'=>'web_name',
            'type'=>'text'
        ],[
            'parent_id'=>1,
            'code'=>'web_title',
            'type'=>'text'
        ],[
            'parent_id'=>1,
            'code'=>'web_desc',
            'type'=>'text'
        ],[
            'parent_id'=>1,
            'code'=>'web_keys',
            'type'=>'text'
        ],[
            'parent_id'=>1,
            'code'=>'web_address',
            'type'=>'text'
        ],[
            'parent_id'=>1,
            'code'=>'web_icp',
            'type'=>'text'
        ]];
        foreach ($lists as $list) {
            WebConfig::create($list);
        }
    }
}
