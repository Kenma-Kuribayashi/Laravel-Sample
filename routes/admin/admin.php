<?php

//管理者ページ
Route::get('/admin', 'AdminTopController@index')->name('adminTop.index');
Route::get('/admin/{article_id}/register', 'AdminTopController@register');