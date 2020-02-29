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

//利用方法ページ
Route::get('/about', 'PagesController@about')->name('about');
//画像アップロード
Route::post('/upload/{id}', 'ArticlesController@upload');
//指定したタグの記事だけ表示
Route::get('/articles/tags/{tag_id}', 'ArticlesController@domestic');
Route::get('/', 'ArticlesController@index');

Route::prefix('articles')->name('articles.')->group(function () {
  Route::get('/', 'ArticlesController@index')->name('index');
  Route::post('/', 'ArticlesController@store')->name('store');
  Route::get('/create', 'ArticlesController@create')->name('create');
  Route::get('/{article}', 'ArticlesController@show')->name('show');
  Route::post('/{article}', 'ArticlesController@update')->middleware('can:update,article')->name('update');
  Route::delete('/{article}', 'ArticlesController@destroy')->middleware('can:delete,article');
  Route::get('/{article}/edit', 'ArticlesController@edit')->middleware('can:showEdit,article')->name('edit');
});

Auth::routes();
