<?php

namespace App\Http\Controllers\Api\Articles;

use App\Http\Controllers\Controller;
use App\Article;
use App\Services\GetArticles;

class GetArticlesController extends Controller
{
    /**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(GetArticles $getArticles)
    {
        // $articles = Article::latest('published_at')
        // ->latest('created_at')
        // ->published()
        // ->get();

        // return $articles;

        return $getArticles->get();
    }
}