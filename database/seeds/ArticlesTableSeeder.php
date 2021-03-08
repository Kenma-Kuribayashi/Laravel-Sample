<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Article;

class ArticlesTableSeeder extends Seeder
{
    //ArticleTagのファクトリーで初期データ生成しているため使用していない
    public function run()
    {
        factory(Article::class, 20)->create();
    }
}

