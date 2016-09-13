<?php

use Illuminate\Database\Seeder;
use App\Models\WechatMenu;

class WechatMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list = [[
            'name' => '大韩乐奇',
            'type' => 'view',
            'url' => 'http://ylr.ch-city.com'
        ], [
            'name' => '活动指南',
            'type' => 'view',
            'url' => 'http://ylr.ch-city.com'
        ], [
            'parent_id' => 2,
            'name' => '正品查询',
            'type' => 'view',
            'url' => 'http://ylr.ch-city.com/index/quality'
        ], [
            'parent_id' => 2,
            'name' => '转盘抽奖',
            'type' => 'view',
            'url' => 'http://ylr.ch-city.com/award/index'
        ]];
        foreach ($list as $item) {
            WechatMenu::create($item);
        }
    }
}
