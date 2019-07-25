<?php

namespace Webup\LaravelBlog\Policies;

use Webup\LaravelBlog\Entities\User as LaravelBlogUser;
use Webup\LaravelBlog\Entities\Post as LaravelBlogPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all laravel blog posts.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @return mixed
     */
    public function list(LaravelBlogUser $laravelBlogUser)
    {
        return true;
    }

    /**
     * Determine whether the user can create laravel blog posts.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @return mixed
     */
    public function create(LaravelBlogUser $laravelBlogUser)
    {
        return true;
    }

    /**
     * Determine whether the user can update the laravel blog post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPost
     * @return mixed
     */
    public function update(LaravelBlogUser $laravelBlogUser, LaravelBlogPost $laravelBlogPost)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the laravel blog post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPost
     * @return mixed
     */
    public function delete(LaravelBlogUser $laravelBlogUser, LaravelBlogPost $laravelBlogPost)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the laravel blog post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPost
     * @return mixed
     */
    public function restore(LaravelBlogUser $laravelBlogUser, LaravelBlogPost $laravelBlogPost)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the laravel blog post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPost
     * @return mixed
     */
    public function forceDelete(LaravelBlogUser $laravelBlogUser, LaravelBlogPost $laravelBlogPost)
    {
        return true;
    }
}
