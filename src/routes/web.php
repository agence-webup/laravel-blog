<?php

Route::group([
    'middleware' => ['web', 'blog.settings:blog'],
    'namespace' => '\Webup\LaravelBlog\Http\Controllers',
    'prefix' => 'blog',
    'as' => 'blog.',
], function () {

    Route::get('/', function () {
        return redirect()->to(route("blog.indexLocalized", ["locale" => "fr"]));
    })->name('index');

    Route::get('/{locale}', 'BlogController@index')->name('indexLocalized');
    Route::get('/{locale}/{id}-{slug}', 'BlogController@show')->name('show');
});
