<?php

namespace App\Services;

use App\Article;


class GetArticle {

  public function get_article(int $article_id): Article {

    return Article::where('id', $article_id)
      ->with(['tags'])
      ->get()
      ->first();
      
  }

}

 ?>
