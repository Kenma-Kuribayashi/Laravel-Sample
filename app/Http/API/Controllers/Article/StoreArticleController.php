<?php


namespace App\Http\API\Controllers\Article;


use App\Http\web\Controllers\Controller;
use App\Http\API\Requests\Article\StoreArticleRequest;
use App\Services\Article\StoreArticle;

class StoreArticleController extends Controller
{
    /**
     * おすすめ記事の取得
     *
     * @param StoreArticle $service
     * @param StoreArticleRequest $request
     * @return void
     */
    public function __invoke(StoreArticle $service, StoreArticleRequest $request)
    {
        $service->store($request->validated());
    }
}
