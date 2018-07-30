<?php


Route::group([
  'middleware' => ['web'],
  'namespace' => '\Webup\LaravelBlog\Http\Controllers\Admin',
  'prefix' => 'blog/admin',
  'as' => 'admin.blog.',
], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['blog.auth:blog']], function () {
        Route::get('', function () {
            return redirect()->route("admin.blog.login");
        })->name("index");
        Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
            Route::get('', 'UserController@index')->name('index');
        });
    });
});
