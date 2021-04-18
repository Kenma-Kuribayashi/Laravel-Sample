<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('tags', 'Api\TagsController@index');

    Route::get('get/articles', 'Api\Articles\GetArticlesController');

    Route::get('get/article/{articleId}', 'Api\Articles\GetOneArticleController');

    Route::get('/recommend_article/{articleId}', 'Api\GetRecommendedArticlesController');

    //ログイン
    Route::post('/login', 'Api\Articles\StoreArticleController');

    //パスワードリセットでEメール送る
    // Route::get('/recommend_article/{articleId}', 'Api\GetRecommendedArticlesController');



//article関連
Route::prefix('/articles')->group(function () {
    Route::post('', 'Api\Articles\StoreArticleController')->middleware('auth');
    Route::put('/{article}', 'Api\Articles\UpdateArticleController')->middleware(['can:update,article', 'auth']);
    Route::delete('/{article}', 'Api\Articles\DeleteOneArticleController')->middleware(['can:delete,article', 'auth']);
});
