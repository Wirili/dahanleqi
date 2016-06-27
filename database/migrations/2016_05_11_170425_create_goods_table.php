<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('goods',function(Blueprint $table){
            $table->increments('goods_id')->comment('编号');
            $table->string('goods_sn',60)->comment('商品货号');
            $table->string('goods_name',120)->comment('商品名称');
            $table->string('goods_barcode',120)->nullable()->comment('商品条码');
            $table->smallInteger('cat_id')->default(0)->comment('商品分类id');
            $table->smallInteger('brand_id')->default(0)->comment('品牌Id');
            $table->decimal('market_price',10,2)->default(0)->comment('市场价格');
            $table->decimal('shop_price',10,2)->default(0)->comment('商品价格');
            $table->string('keywords',255)->nullable()->comment('关键字');
            $table->text('goods_desc')->nullable()->comment('详细描述');
            $table->text('goods_desc_short')->nullable()->comment('简单描述');
            $table->integer('img_id')->comment('封面图');
            $table->boolean('is_delete')->default(0)->comment('是否删除');
            $table->boolean('is_on_sale')->default(1)->comment('是否上架');
            $table->boolean('is_best')->default(0)->comment('是否精品');
            $table->boolean('is_new')->default(0)->comment('是否新品');
            $table->boolean('is_hot')->default(0)->comment('是否热销');
            $table->smallInteger('sort_order')->default(100)->comment('排序');
            $table->integer('click_count')->default(0)->comment('点击次数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('goods');
    }
}
