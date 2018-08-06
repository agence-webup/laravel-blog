<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\Post;
use Illuminate\Http\Request;
use Auth;

class SettingController extends BaseController
{
    public function index()
    {
        return view('laravel-blog::admin.setting.index');
    }
}
