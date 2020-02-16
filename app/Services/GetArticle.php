<?php

namespace App\Services;

use App\Article;


class GetArticle {

  public function get_article(int $article_id) {

    return Article::find($article_id);
      
  }

}

 ?>
