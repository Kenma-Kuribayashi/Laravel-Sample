<?php

namespace App\Http\API\Controllers\Article;

use App\Http\web\Controllers\Controller;
use App\Services\Article\GetArticle;
use App\Http\API\Resources\GetOneArticleResource;
use Illuminate\Support\Facades\Auth;

class GetOneArticleController extends Controller
{
    /**
     * 記事の取得
     *
     * @return GetOneArticleResource
     */
    public function __invoke(int $articleId, GetArticle $getArticle): GetOneArticleResource
    {
        $userId = Auth::id();
        $article = $getArticle->get_article($articleId, $userId);

        return new GetOneArticleResource($article);

    }
}
