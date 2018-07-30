<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::get();

        return view('laravel-blog::admin.user.index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        return view('laravel-blog::admin.user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
          "name" => "required|string",
          "email" => "required|string|email",
          "picture" => "required|string",
          "biography" => "nullable|string",
          "isAdmin" => "",
        ]);


        $user = new User($data);
        $user->password();
        $user->save();
    }
}
