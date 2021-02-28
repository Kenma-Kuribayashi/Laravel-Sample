<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GetRecommendedArticles;

class GetRecommendedArticlesController extends Controller
{
    /**
     * おすすめ記事の取得
     *
     * @return Response
     */
    public function __invoke(int $articleId, GetRecommendedArticles $get_recommended_articles)
    {

        $recommended_articles = $get_recommended_articles->get($articleId);

        return $recommended_articles;

    }
}