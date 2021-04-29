<?php

namespace App\Http\API\Controllers\Article;

use App\Http\web\Controllers\Controller;
use App\Services\Article\GetArticles;
use App\Services\Article\GetArticlesBySearchWord;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GetArticlesController extends Controller
{
    /**
     * 記事の取得
     *
     * @return Response
     */
    public function __invoke(Request $request, GetArticles $getArticles, GetArticlesBySearchWord $getArticlesBySearchWord)
    {
        /**
         * @var array
         */
        $conditionsToGet = $request->query();

        //キーワード検索の場合別のサービスクラス呼ぶ
        $searchWord = Arr::get($request->query(), 'searchword');

        if ($searchWord !== null) {
            return $getArticlesBySearchWord->execute($searchWord);
        }

        return $getArticles->execute($conditionsToGet);
    }
}
