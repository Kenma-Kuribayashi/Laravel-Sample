<?php

namespace App\Services;

use App\Article;
use Illuminate\Http\Request;

class StoreImage {

  
  public function store_image($request, string $article_id) {

    //更新する記事を特定できないので、idから記事を特定
    $article = Article::find($article_id);  

    if ($request->file('image')->isValid([])) { //問題なくアップロードできたのかを確認
      $image = base64_encode(file_get_contents($request->image->getRealPath())); //base64 でエンコードする。
      $article->update(["image" => $image]);
      $successful_upload = TRUE;
    } else {
      $successful_upload = FALSE;
      
    }

    return $successful_upload;
      
  }

}

 ?>