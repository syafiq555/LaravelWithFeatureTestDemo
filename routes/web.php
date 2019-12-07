<?php


Route::group([
  'prefix' => 'posts',
  'as' => 'post.',
  'middleware' => ['auth']
], function() {
  Route::get('/', 'PostController@index');
  Route::post('/', 'PostController@store');
  Route::delete('/{post}', 'PostController@destroy');
  Route::put('/{post}', 'PostController@update');
});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
