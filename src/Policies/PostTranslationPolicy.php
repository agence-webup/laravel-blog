<?php

namespace Webup\LaravelBlog\Policies;

use Webup\LaravelBlog\Entities\User as LaravelBlogUser;
use Webup\LaravelBlog\Entities\PostTranslation as LaravelBlogPostTranslation;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostTranslationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the laravel blog translation post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPostTranslation
     * @return mixed
     */
    public function view(LaravelBlogUser $laravelBlogUser, LaravelBlogPostTranslation $laravelBlogPostTranslation)
    {
        //
    }

    /**
     * Determine whether the user can create laravel blog translations posts.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @return mixed
     */
    public function create(LaravelBlogUser $laravelBlogUser)
    {
        //
    }

    /**
     * Determine whether the user can update the laravel blog translation post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPostTranslation
     * @return mixed
     */
    public function update(LaravelBlogUser $laravelBlogUser, LaravelBlogPostTranslation $laravelBlogPostTranslation)
    {
        //
    }

    /**
     * Determine whether the user can delete the laravel blog translation post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPostTranslation
     * @return mixed
     */
    public function delete(LaravelBlogUser $laravelBlogUser, LaravelBlogPostTranslation $laravelBlogPostTranslation)
    {
        //
    }

    /**
     * Determine whether the user can restore the laravel blog translation post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPostTranslation
     * @return mixed
     */
    public function restore(LaravelBlogUser $laravelBlogUser, LaravelBlogPostTranslation $laravelBlogPostTranslation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the laravel blog translation post.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\Post  $laravelBlogPostTranslation
     * @return mixed
     */
    public function forceDelete(LaravelBlogUser $laravelBlogUser, LaravelBlogPostTranslation $laravelBlogPostTranslation)
    {
        //
    }
}
