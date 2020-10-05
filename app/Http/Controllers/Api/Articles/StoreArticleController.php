<?php


namespace App\Http\Controllers\Api\Articles;


use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Services\StoreArticle;

class StoreArticleController extends Controller
{
    /**
     * おすすめ記事の取得
     *
     * @return
     */
    public function __invoke(StoreArticle $service, ArticleRequest $request)
    {
        $service->store($request->validated(), $request->input('tags'), $request->file('image'));

        return response("", 200);

    }
}
