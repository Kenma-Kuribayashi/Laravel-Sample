<?php

namespace App\Repositories\Interfaces;


interface ArticleTagRepositoryInterface
{
  public function delete(int $articleId): void;

}
