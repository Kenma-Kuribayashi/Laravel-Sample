<?php

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

Route::get('/about', 'PagesController@about')->name('about'); //利用方法ページ

Route::post('/upload/{id}', 'ArticlesController@upload'); //画像アップロード
Route::get('/articles/tags/{tag_name}', 'ArticlesController@domestic'); //特定タグのindex idでタグを判別してる
Route::get('/', 'ArticlesController@index');
Route::resource('articles', 'ArticlesController');

Auth::routes();
