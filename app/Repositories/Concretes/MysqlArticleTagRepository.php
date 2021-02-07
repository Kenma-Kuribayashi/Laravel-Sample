<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\ArticleTagRepositoryInterface;
use App\Eloquent\ArticleTag;


class MySqlArticleTagRepository implements ArticleTagRepositoryInterface
{

  public function store(int $articleId, int $tagId): void
  {
    ArticleTag::create(['article_id' => $articleId, 'tag_id' => $tagId]);
  }

  public function delete(int $articleId): void
  {
    ArticleTag::where('article_id', $articleId)->delete();
  }
}
