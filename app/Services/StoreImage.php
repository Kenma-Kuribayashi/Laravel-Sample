<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\ArticleImagePathRepositoryInterface;
use App\Repositories\Interfaces\TransactionManagerInterface;
use Exception;

class StoreImage {

  private $articleImagePathRepository;
  private $transactionManagerRepository;

  public function __construct(
    ArticleImagePathRepositoryInterface $articleImagePathRepository,
    TransactionManagerInterface $transactionManagerRepository
    )
  {
    $this->articleImagePathRepository = $articleImagePathRepository;
    $this->transactionManagerRepository = $transactionManagerRepository;
  }


  public function store_image($request, int $article_id) {

    $request->validate([
      'image' => 'required|file|image|max:500|mimes:jpeg,png'
    ]);

    $image = $request->file('image');
    $extension = $image->extension();
    $image_path = "article_" . $article_id . "." . $extension;

    try {
      $this->transactionManagerRepository->start();

      //画像のパスを保存する
      $this->articleImagePathRepository->store($article_id, $image_path);

      // バケットの`myprefix`フォルダへアップロード
      Storage::disk('s3')->putFileAs('myprefix', $image, $image_path, 'public');

      $this->transactionManagerRepository->stop();
    } catch(Exception $e) {
      $this->transactionManagerRepository->rollBack();
      abort(422);
    }
  }

}

 ?>
