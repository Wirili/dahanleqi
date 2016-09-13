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
            'type'=>'text',
            'value'=>'大韩乐奇'
        ],[
            'parent_id'=>1,
            'code'=>'web_title',
            'type'=>'text',
            'value'=>'大韩乐奇'
        ],[
            'parent_id'=>1,
            'code'=>'web_desc',
            'type'=>'text',
            'value'=>'大韩乐奇'
        ],[
            'parent_id'=>1,
            'code'=>'web_keys',
            'type'=>'text',
            'value'=>'大韩乐奇'
        ],[
            'parent_id'=>1,
            'code'=>'web_address',
            'type'=>'text'
        ],[
            'parent_id'=>1,
            'code'=>'web_icp',
            'type'=>'text',
            'value'=>'粤ICP备15067622号-1'
        ]];
        foreach ($lists as $list) {
            WebConfig::create($list);
        }
    }
}
