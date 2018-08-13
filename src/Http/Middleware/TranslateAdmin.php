<?php

namespace Webup\LaravelBlog\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TranslateAdmin
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
        if ($guard == "blog" && Auth::guard($guard)->user() && Auth::guard($guard)->user()->lang) {
            // laravel
            app()->setLocale(Auth::guard($guard)->user()->lang);
            // carbon
            \Carbon\Carbon::setLocale(Auth::guard($guard)->user()->lang);
        }

        return $next($request);
    }
}
