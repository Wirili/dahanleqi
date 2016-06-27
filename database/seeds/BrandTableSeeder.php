<?php

use Illuminate\Database\Seeder;
use App\Models\Brand as Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list=[];
        for($i=1;$i<=10;$i++) {
            $list[] =[
                'brand_id' => $i,
                'brand_name' => '品牌'.$i,
            ];
        }
        foreach ($list as $item) {
            Brand::create($item);
        }
    }
}
