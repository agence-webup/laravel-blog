<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\Post;
use Illuminate\Http\Request;
use Auth;
use Webup\LaravelBlog\Http\Requests\UpdateSetting;
use Webup\LaravelBlog\Entities\Setting;

class SettingController extends BaseController
{
    public function index()
    {
        return view('laravel-blog::admin.setting.index');
    }

    public function update(UpdateSetting $request)
    {
        foreach ($request->validated() as $key => $value) {
            $setting = Setting::firstOrNew(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }

        // event("laravel-blog.user.update", new BlogUserUpdated());

        return redirect()->to($this->redirectAfterUpdate());
    }

    protected function redirectAfterUpdate()
    {
        return route("admin.blog.setting.index");
    }
}
