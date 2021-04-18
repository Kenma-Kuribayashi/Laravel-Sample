<?php


namespace App\Http\API\Controllers\Article;


use App\Eloquent\Article;
use App\Http\web\Controllers\Controller;
use App\Http\API\Requests\Article\ArticleRequest;
use App\Services\Article\UpdateArticle;

class UpdateArticleController extends Controller
{
    /**
     * おすすめ記事の取得
     *
     * @param UpdateArticle $updateArticle
     * @param ArticleRequest $request
     * @param Article $article
     * @return void
     */
    public function __invoke(UpdateArticle $updateArticle, ArticleRequest $request, Article $article)
    {
        $updateArticle->execute($request->convert());
    }
}
