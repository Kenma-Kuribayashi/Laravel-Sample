<?php

//管理者ページ
Route::get('/admin', 'AdminTopController@index')->name('adminTop.index');
Route::put('/users/{user_id}', 'AdminTopController@register')->name('register');