<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
  /**
   * 記事を全て取得し、ページネーションで返す
   * @return LengthAwarePaginator
   */
  public function getAllArticlesInNewOrder(): LengthAwarePaginator;

  /**
   * タグごとの記事を取得し、ページネーションで返す
   *
   * @return LengthAwarePaginator
   */
  public function getArticlesByTagInNewOrder(string $tagName): LengthAwarePaginator;

  /**
   * @return LengthAwarePaginator
   */
  public function getAllArticlesInOldOrder(): LengthAwarePaginator;

  /**
   *
   * @return LengthAwarePaginator
   */
  public function getArticlesByTagInOldOrder(string $tagName): LengthAwarePaginator;

  /**
   *
   * @param string $searchWord
   * @return LengthAwarePaginator
   */
  public function getArticlesByBySearchWord($searchWord): LengthAwarePaginator;
}
