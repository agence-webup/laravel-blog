<?php

Route::group([
  'middleware' => ['web'],
  'namespace' => '\Webup\LaravelBlog\Http\Controllers',
  'prefix' => 'blog',
  'as' => 'blog.',
], function () {
  Route::get('/', 'BlogController@index')->name('index');
  Route::get('/{id}-{slug}', 'BlogController@show')->name('show');
});
