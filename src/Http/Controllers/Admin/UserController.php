<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Webup\LaravelBlog\Mail\BlogAdminUserCreated;
use Webup\LaravelBlog\Events\User\Register as BlogUserRegistered;
use Webup\LaravelBlog\Events\User\Update as BlogUserUpdated;
use Webup\LaravelBlog\Events\User\Delete as BlogUserDeleted;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    public function index()
    {
        $this->authorize('list', User::class);

        $users = User::get();

        return view('laravel-blog::admin.user.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User();
        return view('laravel-blog::admin.user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $data = $this->validate($request, [
            "name" => "required|string",
            "email" => [
                "required",
                "string",
                "email",
                "unique:" . (new User())->getConnectionName() . "." . (new User())->getTable() . ",email",
            ],
            "lang" => "required",
            "picture" => "",
            "biography" => "nullable|string",
            "isAdmin" => "",
        ]);

        $data["isAdmin"] = (array_get($data, "isAdmin", "") == "on") ? true : false;

        $user = new User($data);
        $password = str_random(10);
        $user->password = Hash::make($password);
        $user->save();

        if (config()->get('blog.mails.enable', false) && config()->get('blog.mails.users.register', false)) {
            Mail::to($user->email)->send(new BlogAdminUserCreated($user, $password));
        }

        event("laravel-blog.user.register", new BlogUserRegistered($user, $password));

        return redirect()->to($this->redirectAfterStore($user));
    }

    protected function redirectAfterStore(User $user)
    {
        return route("admin.blog.user.index");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        return view('laravel-blog::admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = $this->validate($request, [
            "name" => "required|string",
            "email" => [
                "required",
                "string",
                "email",
                "unique:" . (new User())->getConnectionName() . "." . (new User())->getTable() . ",email," . $user->id,
            ],
            "lang" => "required",
            "picture" => "",
            "biography" => "nullable|string",
            "isAdmin" => "",
        ]);

        $data["isAdmin"] = (array_get($data, "isAdmin", "") == "on") ? true : false;

        $user->update($data);

        event("laravel-blog.user.update", new BlogUserUpdated($user));

        return redirect()->to($this->redirectAfterUpdate($user));
    }

    protected function redirectAfterUpdate(User $user)
    {
        return route("admin.blog.user.index");
    }


    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        event("laravel-blog.user.delete", new BlogUserDeleted($user));

        $user->delete();

        return redirect()->to($this->redirectAfterDelete($user));
    }

    protected function redirectAfterDelete(User $user)
    {
        return route("admin.blog.user.index");
    }
}
