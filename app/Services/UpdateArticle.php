<?php

namespace App\Services;

use App\Article;
class UpdateArticle {
  
  public function update_article(array $params, ?array $tags, Article $article) {

    $article->update($params);
    //引数で渡されたidの物だけになるように、追加と削除を行っている。attachだと元のタグにどんどん追加されてしまう。
    $article->tags()->sync($tags);

    return $article;
      
  }

}

 ?>