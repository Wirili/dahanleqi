<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('');
            $table->string('code',50)->unique()->comment('');
            $table->string('type',20)->default('')->comment('');
            $table->string('store_range',100)->default('')->comment('');
            $table->text('value',100)->default('')->comment('');
            $table->integer('sort_order')->default(50)->comment('');
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
        Schema::drop('web_configs');
    }
}
