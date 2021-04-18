<?php

namespace App\Services\Article;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\ArticleTagRepositoryInterface;
use App\Repositories\Interfaces\TransactionManagerInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class DestroyArticleService {

  private $articleRepository;
  private $articleTagRepository;
  private $transactionManagerRepository;

  public function __construct(
    TransactionManagerInterface $transactionManagerRepository,
    ArticleRepositoryInterface $articleRepository,
    ArticleTagRepositoryInterface $articleTagRepository
  )
  {
    $this->transactionManagerRepository = $transactionManagerRepository;
    $this->articleRepository = $articleRepository;
    $this->articleTagRepository = $articleTagRepository;
  }

  /**
   * 特定の記事を削除する。
   *
   * @param int $articleId
   * @return void
   */
  public function execute(int $articleId): void
  {
    try {
      $this->transactionManagerRepository->start();

      $this->articleTagRepository->delete($articleId);
      $this->articleRepository->delete($articleId);

      $this->transactionManagerRepository->stop();
    } catch (Exception $e) {
      Log::error($e->getMessage());
      $this->transactionManagerRepository->rollBack();
      abort(422);
    }
  }

}
