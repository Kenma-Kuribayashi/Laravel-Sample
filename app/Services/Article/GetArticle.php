<?php

namespace App\Services\Article;

use App\Domain\Entity\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;


class GetArticle {

  private $articleRepository;

  public function __construct(ArticleRepositoryInterface $articleRepository)
  {
    $this->articleRepository = $articleRepository;
  }

  /**
   * @param int $articleId
   * @return Article
   */
  public function get_article(int $articleId): Article {

    return $this->articleRepository->findOne($articleId);

  }

}

 ?>
