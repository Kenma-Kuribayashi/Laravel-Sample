<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\ArticleImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class S3ArticleImageRepository implements ArticleImageRepositoryInterface
{

  public function upload(UploadedFile $image, string $path): void
  {
    //バケットの`myprefix`フォルダへアップロード
    Storage::disk('s3')->putFileAs('myprefix', $image, $path, 'public');
  }
}
