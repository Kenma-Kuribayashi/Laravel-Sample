<?php

namespace App\Services;

use App\Article;


class GetArticles {

  public function get() {
    return Article::latest('published_at')
      ->latest('created_at') //公開日が新しく、作成日が新しい
      ->published() //今より前の投稿(未来のpublished_atは表示されない)
      ->paginate(10);

      
  }

}


 ?>
