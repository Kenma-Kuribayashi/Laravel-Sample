<?php

namespace App\Services;

class DestroyArticle {

  public function destroy_article($article) {
    $article->delete();
      
  }

}


 ?>