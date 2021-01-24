<?php

namespace App\Services;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\ArticleTagRepositoryInterface;

class DestroyArticleService {

  private $articleRepository;
  private $articleTagRepository;

  public function __construct(
    ArticleRepositoryInterface $articleRepository,
    ArticleTagRepositoryInterface $articleTagRepository
  ) 
  {
    $this->articleRepository = $articleRepository;
    $this->articleTagRepository = $articleTagRepository;
  }

  /**
   * 特定の記事を削除する。
   * 
   * @param int $articleId
   * @return void
   */
  public function execute(int $articleId) 
  {
    $this->articleTagRepository->delete($articleId);

    $this->articleRepository->delete($articleId);  
  }

}


 ?>