<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->mediumIncrements('cat_id')->comment('分类编号');
            $table->string('cat_name',100)->comment('分类名称');
            $table->string('keywords',100)->comment('关键字');
            $table->string('cat_desc',255)->comment('分类描述');
            $table->mediumInteger('parent_id')->default(0)->comment('父分类编号');
            $table->tinyInteger('sort_order')->default(50)->comment('排序');
            $table->boolean('is_show')->default(true)->comment('是否显示');
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
        Schema::drop('categories');
    }
}
