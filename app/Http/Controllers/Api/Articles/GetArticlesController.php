<?php

namespace App\Http\Controllers\Api\Articles;

use App\Http\Controllers\Controller;
use App\Article;
use App\Services\GetArticles;
use Illuminate\Http\Request;

class GetArticlesController extends Controller
{
    /**
     * 記事の取得
     *
     * @return Response
     */
    public function __invoke(Request $request, GetArticles $getArticles)
    {
        /**
         * @var array
         */
        $conditionsToGet = $request->query();

        //$tagName = $request->route('tag');

        return $getArticles->execute($conditionsToGet);
    }
}