<?php

namespace App\Http\API\Controllers\Article;

use App\Http\web\Controllers\Controller;
use App\Services\Article\GetRecommendedArticles;

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
