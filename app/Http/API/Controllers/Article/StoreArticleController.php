<?php


namespace App\Http\API\Controllers\Article;


use App\Http\web\Controllers\Controller;
use App\Http\API\Requests\Article\ArticleRequest;
use App\Services\Article\StoreArticle;

class StoreArticleController extends Controller
{
    /**
     * おすすめ記事の取得
     *
     * @return
     */
    public function __invoke(StoreArticle $service, ArticleRequest $request)
    {
        $service->store($request->validated());
    }
}
