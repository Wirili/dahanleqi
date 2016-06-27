<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_images', function (Blueprint $table) {
            $table->increments('img_id')->comment('编号');
            $table->integer('goods_id')->comment('商品id');
            $table->string('img_desc',255)->nullable()->comment('图片描述');
            $table->string('img_url',255)->nullable()->comment('大图');
            $table->string('thumb_url',255)->nullable()->comment('小图');
            $table->string('original_url',255)->nullable()->comment('原始图');
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
        Schema::drop('goods_images');
    }
}
