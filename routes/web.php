<?php


Route::get('/', 'PostController@index');
Route::post('/posts', 'PostController@store')->middleware('auth');
Route::delete('/posts/{post}', 'PostController@destroy')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
