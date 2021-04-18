<?php


namespace App\Http\API\Controllers\Article;


use App\Eloquent\Article;
use App\Http\web\Controllers\Controller;
use App\Http\API\Requests\Article\UpdateArticleRequest;
use App\Services\Article\UpdateArticle;

class UpdateArticleController extends Controller
{
    /**
     * おすすめ記事の取得
     *
     * @param UpdateArticle $updateArticle
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return void
     */
    public function __invoke(UpdateArticle $updateArticle, UpdateArticleRequest $request, Article $article)
    {
        $updateArticle->execute($request->convert());
    }
}
