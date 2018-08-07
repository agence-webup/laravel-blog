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
        $posts = Post::get();

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

        return redirect()->to(route("admin.blog.post.edit", [$post->id]));
    }

    public function edit(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        return view('laravel-blog::admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->fill($request->except('_token'));
            $post->save();
        } catch (\Exception $e) {
            return response()->json([
              "success" => false,
              "errors" => $e->getMessage(),
          ], 422);
        }


        return response()->json(["success" => true]);
    }
}
