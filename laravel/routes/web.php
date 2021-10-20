<?php

Auth::routes();
Route::get('/', 'PostController@index')->name('posts.index');
Route::resource('/posts', 'PostController')->except(['index', 'show'])->middleware('auth');
Route::resource('/posts', 'PostController')->only(['show']);
