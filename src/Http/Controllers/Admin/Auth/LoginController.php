<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin\Auth;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth as AuthFacade;
use Webup\LaravelBlog\Events\User\Login as BlogUserLogin;
use Webup\LaravelBlog\Events\User\Logout as BlogUserLogout;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('admin.blog.user.index');
        $this->middleware('blog.guest:blog')->except('logout');
    }

    protected function guard()
    {
        return AuthFacade::guard("blog");
    }

    public function showLoginForm()
    {
        return view('laravel-blog::admin.auth.login');
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        event("laravel-blog.user.login", new BlogUserLogin($user));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        event("laravel-blog.user.logout", new BlogUserLogout($this->guard()->user()));

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('blog.index');
    }
}
