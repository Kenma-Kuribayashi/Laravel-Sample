<?php

namespace App\Http\Controllers\Api\Articles;

use App\Http\Controllers\Controller;
use App\Services\GetArticle;
use App\Http\Resources\GetOneArticleResource;

class GetOneArticleController extends Controller
{
    /**
     * 記事の取得
     *
     * @return Response
     */
    public function __invoke(int $articleId, GetArticle $getArticle)
    {
      $article = $getArticle->get_article($articleId);

      return new GetOneArticleResource($article);

    }
}