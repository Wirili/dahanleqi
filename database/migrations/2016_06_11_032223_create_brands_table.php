<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('brand_id')->comment('品牌编号');
            $table->string('brand_name',60)->comment('品牌名称');
            $table->string('brand_letter',60)->default('')->comment('品牌许可');
            $table->string('brand_logo',80)->default('')->comment('品牌logo');
            $table->text('brand_desc')->default('')->comment('品牌详细描述');
            $table->string('site_url',255)->default('')->comment('官方网站');
            $table->integer('sort_order')->default(50)->comment('排序');
            $table->boolean('is_show')->default(1)->comment('是否显示');
            $table->boolean('is_delete')->default(0)->comment('是否删除');
            $table->boolean('audit_status')->default(1)->comment('审核状态');
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
        Schema::drop('brands');
    }
}
