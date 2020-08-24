<?php

namespace App\Http\Controllers\Api\Articles;

use App\Http\Controllers\Controller;
use App\Services\DestroyArticle;
use App\Article;

class DeleteOneArticleController extends Controller
{
    /**
     * 記事の取得
     *
     * @return Response
     */
    public function __invoke(DestroyArticle $destroy_article, Article $article)
    {
      $destroy_article->destroy_article($article);

      return response('success');
    }
}