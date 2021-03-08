<?php

namespace App\Repositories\Interfaces;


use Illuminate\Http\UploadedFile;

interface ArticleImageRepositoryInterface
{
  public function upload(UploadedFile $image, string $path): void;
}
