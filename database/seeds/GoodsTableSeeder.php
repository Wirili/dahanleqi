<?php

use Illuminate\Database\Seeder;
use App\Models\Goods;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $lists=[];
        for($i=1;$i<=100;$i++) {
            $lists[] =[
                'cat_id'=>1,
                'goods_sn'=>'sj'.$i,
                'goods_name'=>'商品'.$i,
                'shop_price'=>1.3,
            ];
        }
        foreach ($lists as $list) {
            Goods::create($list);
        }
    }
}
