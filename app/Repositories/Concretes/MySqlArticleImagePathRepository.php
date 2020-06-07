<?php

namespace App\Repositories\Concretes;

use App\Repositories\Interfaces\ArticleImagePathRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class MySqlArticleImagePathRepository implements ArticleImagePathRepositoryInterface
{
  public function __construct()
  {
  }

  public function store(int $article_id, string $image_path): void
  {
    DB::table('articles')->where('id', $article_id)
      ->update(
        [
          'image_path' => $image_path,
          'updated_at' => Carbon::now()
        ]
      );
  }
}