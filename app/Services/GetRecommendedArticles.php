<?php

namespace App\Services;

use App\Eloquent\Article;
use Illuminate\Support\Collection;


class GetRecommendedArticles
{

  /**
   * 同じタグの記事3件を最新順で取得する。
   * 3件未満の場合やタグがなかった場合は記事3件を最新順で取得する。
   * 
   * @var Collection
   * @param int $article_id
   * @return Collection
   */
  public function get(int $article_id)
  {

    $article = Article::where('id', $article_id)
      ->with(['tags'])
      ->get()
      ->first();

    //記事にタグがない時
    if ($article->tags->count() === 0) {
      return Article::where('id', '<>', $article->id)
        ->latest('published_at')
        ->latest('created_at')
        ->orderBy('id', 'desc')
        ->published()
        ->limit(3)
        ->get();
    }

    //同じタグの件数を数える(記事詳細に表示される記事も含まれる)
    $article_counts = Article::join('article_tag', 'article_tag.article_id', 'articles.id')
      ->where("tag_id", $article->tags[0]->id)
      ->count();

    //同じタグの記事がない時
    if ($article_counts === 1) {
      return Article::where('id', '<>', $article->id)
        ->latest('published_at')
        ->latest('created_at')
        ->orderBy('id', 'desc')
        ->published()
        ->limit(3)
        ->get();
    }

    /**
     * 同じタグの記事最大3件取得
     * @var Collection
     */
    $recommended_articles = Article::join('article_tag', 'article_tag.article_id', 'articles.id')
      ->where("tag_id", $article->tags[0]->id)
      ->select('articles.*')
      ->where('articles.id', '<>', $article->id)
      ->latest('published_at')
      ->latest('created_at')
      ->orderBy('id', 'desc')
      ->published()
      ->limit(3)
      ->get();

      //同じタグの記事と最新の記事が被らないように
      $recommended_article_ids = $recommended_articles->pluck('id');

    //同じタグの記事が自身の記事を含めて4記事より少ない場合
    if ($article_counts < 4) {
    /**
     * 最新記事を最大3件取得
     * @var Collection
     */
      $latest_articles = Article::where('id', '<>', $article_id)
      ->whereNotIn('id', $recommended_article_ids)
      ->latest('published_at')
      ->latest('created_at')
      ->orderBy('id', 'desc')
      ->published()
      ->limit(4 - $article_counts)
      ->get();

      return $recommended_articles->merge($latest_articles);
    }

    return $recommended_articles;    

  }
}
