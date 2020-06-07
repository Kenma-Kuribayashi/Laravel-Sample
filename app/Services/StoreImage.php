<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\ArticleImagePathRepositoryInterface;

class StoreImage {

  private $articleImagePathRepositoryInterface;

  public function __construct(ArticleImagePathRepositoryInterface $articleImagePathRepositoryInterface)
  {
    $this->articleImagePathRepositoryInterface = $articleImagePathRepositoryInterface;
  }

  
  public function store_image($request, int $article_id) {

    $request->validate([
      'image' => 'required|file|image|max:500|mimes:jpeg,png'
    ]);

    $image = $request->file('image');
    $extension = $image->extension();
    $image_path = "article_" . $article_id . "." . $extension;

    //画像のパスを保存する
    $this->articleImagePathRepositoryInterface->store($article_id, $image_path);

    // バケットの`myprefix`フォルダへアップロード
    $path = Storage::disk('s3')->putFileAs('myprefix', $image, $image_path, 'public');
      
  }

}

 ?>