<?php

namespace App\Http\API\Controllers\Article;

use App\Http\web\Controllers\Controller;
use App\Services\Article\DestroyArticleService;
use App\Eloquent\Article;

class DeleteOneArticleController extends Controller
{
    private $destroyArticleService;

    public function __construct(
        DestroyArticleService $destroyArticleService)
    {
        $this->destroyArticleService = $destroyArticleService;
    }

    /**
     *
     * @param Article $article
     * @return void
     */
    public function __invoke(Article $article): void
    {
        $this->destroyArticleService->execute($article->id);
    }
}
