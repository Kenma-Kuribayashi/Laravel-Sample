<?php

namespace App\Services;

class UpdateArticle {
  
  public function update_article(array $params, ?array $tags, $article) {

    $article->update($params);
    //引数で渡されたidの物だけになるように、追加と削除を行っている。attachだと元のタグにどんどん追加されてしまう。
    $article->tags()->sync($tags);
      
  }

}

 ?>