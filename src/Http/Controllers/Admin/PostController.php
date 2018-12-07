<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Webup\LaravelBlog\Entities\Post;
use Webup\LaravelBlog\Http\Requests\UpdatePost;
use Webup\LaravelBlog\Http\Requests\UpdatePostMeta;
use Webup\LaravelBlog\Http\Requests\UpdatePostPublication;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Webup\LaravelBlog\Events\Post\Create as BlogPostCreated;
use Webup\LaravelBlog\Events\Post\Update as BlogPostUpdated;
use Webup\LaravelBlog\Events\PostTranslation\Create as BlogPostTranslationCreated;
use Webup\LaravelBlog\Events\PostTranslation\Update as BlogPostTranslationUpdated;
use Webup\LaravelBlog\Entities\PostTranslation;
use Webup\LaravelBlog\Http\Resources\PostTranslation as PostTranslationResource;

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
            event("laravel-blog.post.create", new BlogPostCreated($post));
        }

        return redirect()->to(route("admin.blog.post.edit", ["id" => $post->id, "lang" => $this->guard()->user()->lang ? $this->guard()->user()->lang : config()->get('blog.default_locale')]));
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

    public function update(UpdatePost $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $data = $request->validated();
            $translation = $post->translatedOrNew(array_get($data, "lang"));
            if (!$translation->hyperlink) {
                $data["hyperlink"] = str_slug(array_get($data, "title"));
            }
            $translation->fill($data);
            $translation->save();
            // Update updated_at from parent post
            $translation->post()->touch();
            // Send Events
            $this->sendEvents($post, $translation);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "errors" => $e->getMessage(),
            ], 422);
        }


        return response()->json([
            "success" => true,
            "post" => new PostTranslationResource($post->translatedOrNew(array_get($data, "lang")))
        ]);
    }

    public function updateMeta(UpdatePostMeta $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $data = $request->validated();
            $translation = $post->translatedOrNew(array_get($data, "lang"));
            if (!array_get($data, "hyperlink")) {
                array_forget($data, "hyperlink");
            }
            $translation->fill($data);
            $translation->save();
            // Update updated_at from parent post
            $translation->post()->touch();
            // Send Events
            $this->sendEvents($post, $translation);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "errors" => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            "success" => true,
            "post" => new PostTranslationResource($post->translatedOrNew(array_get($data, "lang")))
        ]);
    }

    public function updatePublication(UpdatePostPublication $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $data = $request->validated();
            $translation = $post->translatedOrNew(array_get($data, "lang"));
            if (!array_get($data, "published_at")) {
                array_set($data, "published_at", Carbon::now());
            } else {
                array_set($data, "published_at", Carbon::createFromFormat("Y-m-d H:i", $data["published_at"]));
            }
            $translation->fill($data);
            $translation->save();
            // Update updated_at from parent post
            $translation->post()->touch();
            // Send Events
            $this->sendEvents($post, $translation);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "errors" => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            "success" => true,
            "post" => new PostTranslationResource($post->translatedOrNew(array_get($data, "lang")))
        ]);
    }

    private function sendEvents(Post $post, PostTranslation $translation)
    {
        if ($translation->wasRecentlyCreated) {
            event("laravel-blog.postTranslation.create", new BlogPostTranslationCreated($translation));
        } else {
            event("laravel-blog.postTranslation.update", new BlogPostTranslationUpdated($translation));
        }
        event("laravel-blog.post.update", new BlogPostUpdated($post));

    }

}
