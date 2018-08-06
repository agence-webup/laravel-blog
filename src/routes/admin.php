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

            Route::get('/edit/{id}', 'UserController@edit')->name('edit')->where(['id' => '[0-9]+']);
            Route::put('/update/{id}', 'UserController@update')->name('update')->where(['id' => '[0-9]+']);

            Route::delete('/delete/{id}', 'UserController@delete')->name('delete')->where(['id' => '[0-9]+']);
        });


        Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
            Route::get('', 'PostController@index')->name('index');

            Route::get('/create', 'PostController@create')->name('create');
            Route::get('/edit/{id}', 'PostController@edit')->name('edit')->where(['id' => '[0-9]+']);
            Route::post('/update/{id}', 'PostController@update')->name('update')->where(['id' => '[0-9]+']);
        });

        Route::group(['prefix' => 'settings', 'as' => 'setting.'], function () {
            Route::get('', 'SettingController@index')->name('index');
        });




        Route::post('image', 'ImageController@upload')->name('image.upload');
    });
});
