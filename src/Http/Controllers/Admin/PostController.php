<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\Post;
use Illuminate\Http\Request;
use Auth;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::with('author')->get();

        return view('laravel-blog::admin.post.index', compact('posts'));
    }

    public function create()
    {
        //get last post for user
        $post = Post::where("user_id", $this->guard()->user()->id)->orderBy("created_at", "DESC")->first();

        //Check if last post is recently created (avoid empty post list)
        if (!$post || !$post->isRecentlyCreated()) {
            $post = new Post();
            $post->user_id = $this->guard()->user()->id;
            $post->save();
        }

        return redirect()->to(route("admin.blog.post.edit", ["id" => $post->id,"lang" =>  $this->guard()->user()->lang ?  $this->guard()->user()->lang : config()->get('blog.default_locale')]));
    }

    public function edit(Request $request, $id)
    {
        if (!in_array($request->get("lang"), config()->get('blog.locales'))) {
            abort(404);
        }

        $post = Post::findOrFail($id);
        $locale = $request->get("lang");
        return view('laravel-blog::admin.post.edit', compact('post', 'locale'));
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $translation = $post->translatedOrNew($request->get("lang"));
            $translation->fill($request->except('_token'));
            $translation->save();
        } catch (\Exception $e) {
            return response()->json([
              "success" => false,
              "errors" => $e->getMessage(),
          ], 422);
        }


        return response()->json(["success" => true]);
    }
}
