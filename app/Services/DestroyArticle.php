<?php

namespace App\Services;

use App\Article;
class DestroyArticle {

  public function destroy_article($article_id) {

    $article = Article::find($article_id);
    $article->delete();
      
  }

}


 ?>