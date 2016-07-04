<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_menus', function (Blueprint $table) {
            $table->increments('menus_id');
            $table->integer('parent_id')->default(0);
            $table->string('name',20)->comment('');
            $table->string('type',20)->default('view')->comment('');
            $table->string('key',50)->nullable()->comment('');
            $table->string('url',255)->nullable()->comment('');
            $table->integer('sort_order')->default(50)->comment('');
            $table->boolean('is_show')->default(true)->comment('');
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
        Schema::drop('wechat_menus');
    }
}
