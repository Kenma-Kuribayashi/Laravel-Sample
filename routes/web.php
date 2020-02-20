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

Route::prefix('articles')->name('articles.')->group(function () {
  Route::get('/', 'ArticlesController@index')->name('index');
  Route::post('/', 'ArticlesController@store')->name('store');
  Route::get('/create', 'ArticlesController@create')->name('create');
  Route::get('/{article}', 'ArticlesController@show')->name('show');
  Route::post('/{article}', 'ArticlesController@update')->middleware('can:update,article')->name('update');
  Route::delete('/{article}', 'ArticlesController@destroy');
  Route::get('/{article}/edit', 'ArticlesController@edit')->name('edit');
});

Auth::routes();
