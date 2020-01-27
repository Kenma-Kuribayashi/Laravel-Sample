<?php

namespace App\Services;

use App\Article;


class GetArticlesByTag {

  public function get_articles_by_tag() {
   $articles = Article::latest('published_at')->latest('created_at')
      ->published()
      ->paginate(10);

      return $articles;
  }

}

 ?>