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

            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/store', 'UserController@store')->name('store');

            Route::get('/edit/{id}', 'UserController@edit')->name('edit');
            Route::post('/update/{id}', 'UserController@update')->name('update');
        });


        Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
            Route::get('', 'PostController@index')->name('index');

            Route::get('/create', 'PostController@create')->name('create');
            Route::post('/store', 'PostController@store')->name('store');
        });



        Route::post('image', 'ImageController@upload')->name('image.upload');
    });
});
