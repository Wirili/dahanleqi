<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialites', function (Blueprint $table) {
            $table->increments('socialite_id');
            $table->integer('user_id');
            $table->string('socialite',50)->default('Wechat')->comment('');
            $table->string('openid',50)->comment('');
            $table->string('nickname',100)->comment('');
            $table->boolean('sex')->nullable()->comment('');
            $table->string('city',50)->nullable()->comment('');
            $table->string('country',50)->nullable()->comment('');
            $table->string('province',50)->nullable()->comment('');
            $table->string('language',50)->nullable()->comment('');
            $table->string('headimgurl',255)->nullable()->comment('');
            $table->boolean('subscribe')->default(0)->comment('');
            $table->timestamp('subscribe_time')->nullable()->comment('');
            $table->string('unionid',50)->nullable()->comment('');
            $table->string('remark',50)->nullable()->comment('');
            $table->integer('groupid')->default(0)->comment('');
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
        Schema::drop('socialites');
    }
}
