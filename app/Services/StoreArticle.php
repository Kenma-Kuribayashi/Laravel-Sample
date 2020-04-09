<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Article;


class StoreArticle {
  public function store(array $params, ?array $tags) {
    //Auth::user()のような形で Auth ファサードを使うとログイン中のユーザーの情報を取得できる。articlesメソッドはArticleモデルとTagモデルが多対多の構造をつくる。
    /**
     * ArticleRequestのrulesに基づいて送られてきた値をチェックする。
     * 
     * @var App\Article
     */
    $article = Auth::user()->articles()->create($params);

    $article->tags()->attach($tags); //attach多対対のとき
  }
}


?>
