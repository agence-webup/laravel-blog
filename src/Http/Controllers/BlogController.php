<?php

namespace Webup\LaravelBlog\Http\Controllers;

use Illuminate\Routing\Controller;
use Webup\LaravelBlog\Events\User\Login as BlogUserLogin;
use Webup\LaravelBlog\Events\User\Logout as BlogUserLogout;
use Webup\LaravelBlog\Entities\User;
use Webup\LaravelBlog\Entities\Post;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::leftJoin('post_translations', 'posts.id', 'post_translations.post_id')
            ->where('post_translations.locale', app()->getLocale())
            ->where('post_translations.isPublished', true)
            ->where('post_translations.published_at', Carbon::now())
            ->get();

        return view('laravel-blog::web.index');
    }

    public function show(Request $request, $id, $slug)
    {
        Post::findOrFail($id);
        return view('laravel-blog::web.show', compact("post"));
    }
}
