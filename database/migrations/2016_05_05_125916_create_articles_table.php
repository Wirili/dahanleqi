<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('articles',function(Blueprint $table){
            $table->increments('article_id')->comment('文章Id');
            $table->smallInteger('cat_id')->comment('类别Id');
            $table->string('title')->comment('文章标题');
            $table->longText('contents')->comment('文章内容');
            $table->string('author',30)->comment('作者');
            $table->string('author_email',60)->comment('作者email');
            $table->string('keywords')->comment('关键字');
            $table->boolean('article_type')->default(2)->comment('');
            $table->boolean('is_open')->default(1)->comment('是否显示;1显示;0不显示');
            $table->string('file_url')->comment('上传文件或者外部文件的url');
            $table->boolean('open_type')->default(0)->comment('0,正常; 当该字段为1或2时,会在文章最后添加一个链接’相关下载’,连接地址等于file_url的值;但程序在此处有Bug');
            $table->string('link')->comment('该文章标题所引用的连接,如果该项有值将不能显示文章内容,即该表中content的值');
            $table->string('description')->nullable()->comment('描述');
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
        Schema::drop('articles');
    }
}
