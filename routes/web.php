<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//利用方法ページ
Route::get('/about', 'PagesController@about')->name('about');
//画像アップロード
Route::post('/upload/{id}', 'ArticlesController@upload');
//指定したタグの記事だけ表示
Route::get('/articles/tags/{tag_id}', 'ArticlesController@domestic');

//閲覧履歴ページ
Route::get('/browsing_history', 'BrowsingHistoryController@index');

Route::get('/', 'ArticlesController@index');

//会員登録認証画面
Route::view('/users/register/activate', 'users.verify')->name('verification.verify');

Route::prefix('articles')->name('articles.')->group(function () {
  Route::get('/', 'ArticlesController@index')->name('index');
  Route::view('/articles-search-result', 'articles.search-result');
  Route::get('/csv_export', 'ArticlesController@csvExport')->name('csvExport');
  Route::get('/create', 'ArticlesController@create')->name('create');
});

Auth::routes();

