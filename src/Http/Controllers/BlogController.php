<?php

namespace Webup\LaravelBlog\Http\Controllers;

use Illuminate\Routing\Controller;
use Webup\LaravelBlog\Entities\Post;
use Webup\LaravelBlog\Entities\PostTranslation;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $locale = app()->getLocale() ?? config("blog.default_locale");

        $postTranslations = PostTranslation::with("post")
            ->where('lang', $locale)
            ->where('isPublished', true)
            ->where('published_at', "<=", Carbon::now())
            ->orderBy('published_at', "DESC")
            ->paginate(config('blog.articleNumber'));

        return view('laravel-blog::web.index', ["postTranslations" => $postTranslations, "locale" => $locale]);
    }

    public function show(Request $request, $id, $slug)
    {
        $locale = app()->getLocale() ?? config("blog.default_locale");

        $post = Post::with("translations")->whereHas('translations', function ($query) use ($locale) {
            $query->where('post_translations.lang', $locale)
                ->where('post_translations.isPublished', true)
                ->where('post_translations.published_at', "<=", Carbon::now());
        })->where("id", $id)->first();

        $postTranslation = $post->translated($locale);

        if (!$postTranslation) {
            abort(404);
        }

        return view('laravel-blog::web.show', ["postTranslation" =>  $postTranslation, "locale" => $locale]);
    }
}
