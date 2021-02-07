<?php

namespace Tests\Feature\Articles\Mocks;

use App\Repositories\Interfaces\ArticleImageRepositoryInterface;
use Illuminate\Http\UploadedFile;

class MockArticleImageRepository implements ArticleImageRepositoryInterface
{

  public function upload(UploadedFile $image, string $path): void
  {

  }
}


?>