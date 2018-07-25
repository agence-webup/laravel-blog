<?php

namespace Webup\LaravelBlog\Http\Controllers;

use Illuminate\Routing\Controller;

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
