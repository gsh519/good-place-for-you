<?php

Auth::routes();
Route::get('/', 'PostController@index')->name('posts.index');
Route::resource('/posts', 'PostController')->except(['index', 'show'])->middleware('auth');
Route::resource('/posts', 'PostController')->only(['show']);
Route::prefix('posts')->name('posts.')->group(function () {
  Route::put('/{post}/like', 'PostController@like')->name('like')->middleware('auth');
  Route::delete('/{post}/like', 'PostController@unlike')->name('unlike')->middleware('auth');
});
Route::get('/tags/{tag_name}', 'TagController@show')->name('tags.show');
