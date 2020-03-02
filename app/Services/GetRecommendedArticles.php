<?php

namespace App\Services;

use App\Article;


class GetRecommendedArticles {

  public function get($article) {

    //記事のタグがない時
    if ($article->tags->count() === 0) {
      return Article::latest('published_at')
      ->latest('created_at') 
      ->published() 
      ->limit(3)
      ->get();

      //記事にタグがついていた時
    } else {
      
      //同じタグの件数を数える
      $article_counts = Article::join('article_tag', 'article_tag.article_id', 'articles.id')
      ->where("tag_id", $article->tags[0]->id)
      ->count();

      //おすすめ記事最大3件取得
      $recommended_articles = Article::join('article_tag', 'article_tag.article_id', 'articles.id')
      ->where("tag_id", $article->tags[0]->id)
      ->select('articles.*')
      ->where('articles.id', '<>', $article->id)
      ->latest('published_at')
      ->latest('created_at')
      ->published()
      ->limit(3)
      ->get();

      //2件の場合
      if ($article_counts == 3) {
        //最新の記事1件取得
        $recomend_articles = Article::latest('published_at')
        ->latest('created_at') 
        ->published() 
        ->limit(1)
        ->get();

        //1件の場合
      } elseif ($article_counts == 2) {
        //最新の記事2件取得
        $recomend_articles = Article::latest('published_at')
        ->latest('created_at') 
        ->published() 
        ->limit(2)
        ->get();

      } elseif ($article_counts == 1) {
        //最新の記事3件取得
        Article::latest('published_at')
        ->latest('created_at') 
        ->published() 
        ->limit(3)
        ->get();
      }
    }

    return [$recommended_articles, $recomend_articles];

  }

}


 ?>