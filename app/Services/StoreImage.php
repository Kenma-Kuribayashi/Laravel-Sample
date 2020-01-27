<?php

namespace App\Services;

use App\Article;
use Exception;

// use Illuminate\Http\Request;

class StoreImage {

  
  public function store_image($request, string $article_id) {

    $request->validate([
      'image' => 'required|file|image|max:50|mimes:jpeg,png'
    ]);

    //更新する記事を特定
    $article = Article::find($article_id);

    try {
      if ($request->file('image')->isValid() === false) {
        throw new Exception();
      }
        //base64 でエンコードする。
        $image = base64_encode(file_get_contents($request->image->getRealPath()));
        $article->update(["image" => $image]);
        $successful_upload = TRUE;
      
    } catch (Exception $e) {
      $successful_upload = FALSE;
    }
     
    return $successful_upload;
      
  }

}

 ?>