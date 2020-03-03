<?php

namespace App\Services;

use App\Article;
use Illuminate\Support\Collection;


class GetRecommendedArticles
{

  /**
   * @var Collection
   */
  public function get($article)
  {

    //記事にタグがない時
    if ($article->tags->count() === 0) {
      return Article::latest('published_at')
        ->latest('created_at')
        ->published()
        ->limit(3)
        ->get();
    }

    //同じタグの件数を数える(記事詳細に表示される記事も含まれる)
    $article_counts = Article::join('article_tag', 'article_tag.article_id', 'articles.id')
      ->where("tag_id", $article->tags[0]->id)
      ->count();

    //同じタグの記事最大3件取得
    /**
     * @var Collection
     */
    $recommended_articles = Article::join('article_tag', 'article_tag.article_id', 'articles.id')
      ->where("tag_id", $article->tags[0]->id)
      ->select('articles.*')
      ->where('articles.id', '<>', $article->id)
      ->latest('published_at')
      ->latest('created_at')
      ->published()
      ->limit(3)
      ->get();

    //同じタグの記事が自身の記事を含めて4記事より少ない場合
    if ($article_counts < 4) {
      //最新記事を最大3件取得
      $latest_articles = Article::latest('published_at')
      ->latest('created_at')
      ->published()
      ->limit(4 - $article_counts)
      ->get();

      return $recommended_articles->merge($latest_articles);
    }

    return $recommended_articles;    

  }
}
