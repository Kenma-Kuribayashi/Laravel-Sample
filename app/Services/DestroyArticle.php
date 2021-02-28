<?php

namespace App\Services;

class DestroyArticle {

  /**
   * 特定の記事を削除する。
   * 
   * @param Article $article
   * @return void
   */
  public function destroy_article($article) {
    $article->delete();
      
  }

}


 ?>