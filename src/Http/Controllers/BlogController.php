<?php

namespace Webup\LaravelBlog\Http\Controllers;

use Illuminate\Routing\Controller;
use Webup\LaravelBlog\Events\User\Login as BlogUserLogin;
use Webup\LaravelBlog\Events\User\Logout as BlogUserLogout;
use Webup\LaravelBlog\Entities\User;

class BlogController extends Controller
{
    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('laravel-blog::web.index');
    }
}
