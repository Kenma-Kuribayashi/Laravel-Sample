<?php

namespace App\Services;

use App\Article as EloquentArticle;
use App\Domain\Entity\Article; 


class GetArticle {

  /**
   * 特定の記事を取得する。
   * 
   * @param int $article_id
   * @return Article
   */
  public function get_article(int $article_id): Article {

    $article = EloquentArticle::where('id', $article_id)
      ->with(['tags'])
      ->get()
      ->first();

    return Article::constructByRepository($article->title, $article->body,$article->image_path, $article->user_id, $article->id, $article->tags);
      
  }

}

 ?>
