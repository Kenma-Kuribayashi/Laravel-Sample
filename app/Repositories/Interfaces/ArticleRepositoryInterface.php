<?php

namespace App\Repositories\Interfaces;

use App\Domain\Entity\Article;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{

  public function findOne(int $articleId): Article;

  public function delete(int $articleId): void;

  public function store(int $userId, string $title, string $body, string $publishedAt, string $extension): Article;

    public function update(int $articleId, string $title, string $body, string $publishedAt, string $imagePath): void;

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
