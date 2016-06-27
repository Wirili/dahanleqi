<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleTableSeeder extends Seeder
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
        for($i=1;$i<=105;$i++) {
            $list[] =[
                'article_id' => $i,
                'cat_id' => 1,
                'title' => '帮助',
                'contents' => 'adf',
                'author' => 'admin',
                'author_email' => 'admin@qq.com',
                'keywords' => '帮助',
                'file_url' => '',
                'link' => ''
            ];
        }
        foreach ($list as $item) {
            Article::create($item);
        }
    }
}
