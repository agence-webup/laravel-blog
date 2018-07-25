<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('laravel-blog::admin.user.index');
    }
}
