<?php

use Illuminate\Support\Facades\Route;
use App\Http\API\Controllers\Article\DeleteOneArticleController;
use App\Http\API\Controllers\Article\GetArticlesController;
use App\Http\API\Controllers\Article\GetOneArticleController;
use App\Http\API\Controllers\Article\GetRecommendedArticlesController;
use App\Http\API\Controllers\Article\StoreArticleController;
use App\Http\API\Controllers\Article\UpdateArticleController;
use App\Http\API\Controllers\Tag\GetTagsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::get('tags', GetTagsController::class);

    Route::get('get/articles', GetArticlesController::class);

    Route::get('get/article/{articleId}', GetOneArticleController::class);

    Route::get('/recommend_article/{articleId}', GetRecommendedArticlesController::class);

    //ログイン
    //Route::post('/login', 'Api\Articles\StoreArticleController');

    //パスワードリセットでEメール送る
    // Route::get('/recommend_article/{articleId}', 'Api\GetRecommendedArticlesController');



//article関連
Route::prefix('/articles')->group(function () {
    Route::post('', StoreArticleController::class)->middleware('auth');
    Route::put('/{article}', UpdateArticleController::class)->middleware(['can:update,article', 'auth']);
    Route::delete('/{article}', DeleteOneArticleController::class)->middleware(['can:delete,article', 'auth']);
});
