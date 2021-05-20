<?php

namespace App\Services\Article;

use App\Domain\Entity\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\ViewCountRepositoryInterface;


class GetArticle {

  private $articleRepository;
    /**
     * @var ViewCountRepositoryInterface
     */
    private $viewCountRepository;

  public function __construct(ArticleRepositoryInterface $articleRepository, ViewCountRepositoryInterface $viewCountRepository)
  {
      $this->articleRepository = $articleRepository;
      $this->viewCountRepository = $viewCountRepository;
  }

    /**
     * @param int $articleId
     * @param int|null $userId
     * @return Article
     */
  public function get_article(int $articleId, ?int $userId): Article {

     $article = $this->articleRepository->findOne($articleId);

      if($userId) {
          $this->viewCountRepository->incrementViewCount($article->getId(), $userId, $article->getTitle());
      }

      return $article;

  }

}

 ?>
