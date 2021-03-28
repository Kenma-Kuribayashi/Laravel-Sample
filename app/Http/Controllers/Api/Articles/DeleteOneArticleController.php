<?php

namespace App\Http\Controllers\Api\Articles;

use App\Http\Controllers\Controller;
use App\Services\DestroyArticleService;
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
