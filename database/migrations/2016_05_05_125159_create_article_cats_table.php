<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('article_cats',function(Blueprint $table){
            $table->smallIncrements('cat_id')->comment('分类编号');
            $table->string('cat_name')->comment('分类名称');
            $table->boolean('cat_type')->default(1)->comment('分类类型');
            $table->string('keywords')->default('')->comment('关键字');
            $table->string('cat_desc')->default('')->comment('分类详细描述');
            $table->integer('sort_order')->default(50)->comment('排序');
            $table->boolean('show_in_nav')->default(0)->comment('在导航中显示');
            $table->integer('parent_id')->default(0)->comment('父分类编号');
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
        Schema::drop('article_cats');
    }
}
