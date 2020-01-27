<?php

use Illuminate\Support\Facades\Auth;

namespace App\Services;

class StoreArticle {
  public function store(array $params, array $tags) {
    //Auth::user()のような形で Auth ファサードを使うとログイン中のユーザーの情報を取得できる。articlesメソッドはArticleモデルとTagモデルが多対多の構造をつくる。
    $article = Auth::user()->articles()->create($params);  //ArticleRequestのrulesに基づいて送られてきた値をチェックする。
    $article->tags()->attach($tags); //attach多対対のとき
  }
}


 ?>
