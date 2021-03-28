<?php

namespace App\Services\Article;

use App\Repositories\Interfaces\ArticleImageRepositoryInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\ArticleTagRepositoryInterface;
use App\Repositories\Interfaces\TransactionManagerInterface;
use http\Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class UpdateArticle {

    public function __construct(
        ArticleImageRepositoryInterface $articleImageRepository,
        TransactionManagerInterface $transactionManagerRepository,
        ArticleRepositoryInterface $articleRepository,
        ArticleTagRepositoryInterface $articleTagRepository
    )
    {
        $this->articleImageRepository = $articleImageRepository;
        $this->transactionManagerRepository = $transactionManagerRepository;
        $this->articleRepository = $articleRepository;
        $this->articleTagRepository = $articleTagRepository;
    }

    /**
     * @param Collection $request
     * @return mixed
     */
    public function execute(Collection $request) {

        $articleId = $request['articleId'];

        try {
            $this->transactionManagerRepository->start();

            $this->articleRepository->update(
                $articleId,
                $request['title'],
                $request['body'],
                $request['publishedAt'],
                $request['image']->name
            );

            $this->articleTagRepository->update($articleId, $request['tagId']);

            $this->transactionManagerRepository->stop();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->transactionManagerRepository->rollBack();
            abort(422);
        }

  }

}

 ?>
