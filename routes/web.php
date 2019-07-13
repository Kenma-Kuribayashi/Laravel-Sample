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

Route::get('/welcome', 'WelcomeController@index');
Route::post('welcome', 'WelcomeController@store');

Route::get('contact', 'PagesController@contact')->name('contact');
Route::get('about', 'PagesController@about')->name('about');

Route::post('/upload', 'ArticlesController@upload');
Route::get('/', 'ArticlesController@index')->name('home');
Route::get('/articles/tags/{id}', 'ArticlesController@domestic'); //特定タグのindex idでタグを判別してる
Route::resource('articles', 'ArticlesController');


Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('tags', 'TagsController@index');
Route::get('tags/create', 'TagsController@create');
Route::post('tags', 'TagsController@store');
Route::delete('tags/{id}', 'TagsController@destroy');