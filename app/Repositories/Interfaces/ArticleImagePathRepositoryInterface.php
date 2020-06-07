<?php
namespace App\Repositories\Interfaces;


interface ArticleImagePathRepositoryInterface
{
  /**
   * Undocumented function
   *
   * @param int $article_id
   * @param string $image_path
   * @return void
   */  
  public function store(int $article_id, string $image_path): void;
}