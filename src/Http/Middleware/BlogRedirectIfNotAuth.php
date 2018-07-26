<?php

namespace Webup\LaravelBlog\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BlogRedirectIfNotAuth
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if ($guard == 'blog') {
                    return redirect()->guest(route('admin.blog.login'));
                }
            }
        }
        return $next($request);
    }
}
