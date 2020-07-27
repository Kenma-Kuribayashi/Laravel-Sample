<?php
namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
  /**
   * 記事を全て取得し、ページネーションで返す
   * @return LengthAwarePaginator
   */  
  public function getAllArticles(): LengthAwarePaginator;

  /**
   * タグごとの記事を取得し、ページネーションで返す
   *
   * @return LengthAwarePaginator
   */
  public function getArticlesByTag(string $tagName): LengthAwarePaginator;
}