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

//閲覧履歴ページ
Route::get('/browsing_history', 'BrowsingHistoryController@index');

Route::get('/', 'ArticlesController@index');

Route::prefix('articles')->name('articles.')->group(function () {
//  Route::get('/', 'ArticlesController@index')->name('index');
  Route::get('/csv_export', 'ArticlesController@csvExport')->name('csvExport');
  Route::post('/', 'ArticlesController@store')->name('store');
  Route::get('/create', 'ArticlesController@create')->name('create');
  Route::get('/{article}/edit', 'ArticlesController@edit')->middleware('can:showEdit,article')->name('edit');
  //Route::get('/{article}/{user_id?}', 'ArticlesController@show')->name('show');
  Route::post('/{article}', 'ArticlesController@update')->middleware('can:update,article')->name('update');
  Route::delete('/{article}', 'ArticlesController@destroy')->middleware('can:delete,article');
});

Auth::routes();

Route::get('/{any}', function () {
  return view('articles.index');
})->where('any', '.*');
