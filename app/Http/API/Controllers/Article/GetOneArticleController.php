<?php

namespace App\Http\API\Controllers\Article;

use App\Http\web\Controllers\Controller;
use App\Services\Article\GetArticle;
use App\Http\API\Resources\GetOneArticleResource;

class GetOneArticleController extends Controller
{
    /**
     * 記事の取得
     *
     * @return GetOneArticleResource
     */
    public function __invoke(int $articleId, GetArticle $getArticle): GetOneArticleResource
    {
      $article = $getArticle->get_article($articleId);

      return new GetOneArticleResource($article);

    }
}
