<?php

use Illuminate\Http\Request;

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


Route::get('/test', function (Request $request) {
    return ['message' => 'success!!'];
});

Route::group(['middleware' => ['api']], function () {
    Route::get('tags', 'Api\TagsController@index');

    Route::get('get/articles', 'Api\Articles\GetArticlesController');

    Route::get('get/article/{articleId}', 'Api\Articles\GetOneArticleController');

    Route::get('recommend_article/{articleId}', 'Api\GetRecommendedArticlesController');
    Route::delete('/articles/{article}', 'Api\Articles\DeleteOneArticleController')->middleware('can:delete,article');
});