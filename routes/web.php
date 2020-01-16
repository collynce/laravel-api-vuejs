<?php
Auth::routes();

Route::resource('posts', 'PostsController');
Route::resource('blog', 'HomeController');
Route::get('api', 'HomeController@api')->name('api');

Route::get('/', 'HomeController@index')->name('home');
Route::get('search', 'PostsController@fetchCategory')->name('search');
