<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\Post;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::get();

        return view('laravel-blog::admin.post.index', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        return view('laravel-blog::admin.post.create', compact('post'));
    }
}
