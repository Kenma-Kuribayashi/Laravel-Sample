<?php

namespace App\Services;

use App\Article;


class GetArticle {

  /**
   * 特定の記事を取得する。
   * 
   * @var Collection
   * @param int $article_id
   * @return Collection
   */
  public function get_article(int $article_id): Article {

    return Article::where('id', $article_id)
      ->with(['tags'])
      ->get()
      ->first();
      
  }

}

 ?>
