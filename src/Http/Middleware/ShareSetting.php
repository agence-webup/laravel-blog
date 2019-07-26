<?php

namespace Webup\LaravelBlog\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Webup\LaravelBlog\Entities\Setting;

class ShareSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //Get all Settings
        $settings = Setting::allFormatted();

        config()->set("blog.blogName", $settings->get("blogName") ?? config("blog.default.blogName"));
        config()->set("blog.articleNumber", $settings->get("articleNumber") ?? config("blog.default.articleNumber"));
        return $next($request);
    }
}
