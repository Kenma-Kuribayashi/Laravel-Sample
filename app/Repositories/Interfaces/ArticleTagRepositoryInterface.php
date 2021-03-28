<?php

namespace App\Repositories\Interfaces;


interface ArticleTagRepositoryInterface
{
  public function delete(int $articleId): void;

  public function store(int $articleId, int $tagId): void;

  public function update(int $articleId, int $tagId): void;
}
