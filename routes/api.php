<?php

use App\Http\API\Controllers\Auth\LoginController;
use App\Http\API\Controllers\Auth\LogoutController;
use App\Http\API\Controllers\User\SendVerificationEmailController;
use App\Http\API\Controllers\User\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\API\Controllers\Article\DeleteOneArticleController;
use App\Http\API\Controllers\Article\GetArticlesController;
use App\Http\API\Controllers\Article\GetOneArticleController;
use App\Http\API\Controllers\Article\GetRecommendedArticlesController;
use App\Http\API\Controllers\Article\StoreArticleController;
use App\Http\API\Controllers\Article\UpdateArticleController;
use App\Http\API\Controllers\Tag\GetTagsController;
use App\Http\API\Controllers\User\RegisterUserController;

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

//Auth関連
Route::prefix('/auth')->group(function () {
    //ログイン
    Route::post('/login', LoginController::class);
    //ログアウト
    Route::delete('/logout', LogoutController::class);
});

//User関連
Route::prefix('/users')->group(function () {
    //会員登録
    Route::post('/', RegisterUserController::class);
    //メール認証
    Route::post('/verifications', VerificationController::class);
    //会員登録認証メール送信
    Route::post('/{id}/emails/verifications', SendVerificationEmailController::class)->middleware('auth');
});

Route::get('tags', GetTagsController::class);

Route::get('get/articles', GetArticlesController::class);

Route::get('get/article/{articleId}', GetOneArticleController::class);
Route::get('/recommend_article/{articleId}', GetRecommendedArticlesController::class);


//article関連
Route::prefix('/articles')->group(function () {
    Route::post('', StoreArticleController::class)->middleware('auth');
    Route::put('/{article}', UpdateArticleController::class)->middleware(['can:update,article', 'auth']);
    Route::delete('/{article}', DeleteOneArticleController::class)->middleware(['can:delete,article', 'auth']);
});
