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
    public function index(Request $request, $locale)
    {
        app()->setLocale($locale);
        Carbon::setLocale($locale);

        $posts = Post::with("translations")->whereHas('translations', function ($query) use ($locale) {
            $query->where('post_translations.lang', $locale)
                ->where('post_translations.isPublished', true)
                ->where('post_translations.published_at', "<=", Carbon::now());
        })->paginate(config('blog.articleNumber'));

        return view('laravel-blog::web.index', ["posts" => $posts, "locale" => $locale]);
    }

    public function show(Request $request, $locale, $id, $slug)
    {
        app()->setLocale($locale);
        Carbon::setLocale($locale);

        $post = Post::with("translations")->whereHas('translations', function ($query) use ($locale) {
            $query->where('post_translations.lang', $locale)
                ->where('post_translations.isPublished', true)
                ->where('post_translations.published_at', "<=", Carbon::now());
        })->where("id", $id)->first();


        if (!$post) {
            abort(404);
        }

        return view('laravel-blog::web.show', ["post" => $post, "locale" => $locale]);
    }
}
