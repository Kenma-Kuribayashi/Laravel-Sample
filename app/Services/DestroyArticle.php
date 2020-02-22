<?php

namespace App\Services;

use App\Article;
class DestroyArticle {

  public function destroy_article($article) {
    $article->delete();
      
  }

}


 ?>