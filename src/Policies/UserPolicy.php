<?php

namespace Webup\LaravelBlog\Policies;

use Webup\LaravelBlog\Entities\User as LaravelBlogUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view all laravel blog user.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @return mixed
     */
    public function list(LaravelBlogUser $laravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }

    /**
     * Determine whether the user can view the laravel blog user.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\User  $otherLaravelBlogUser
     * @return mixed
     */
    public function view(LaravelBlogUser $laravelBlogUser, LaravelBlogUser $otherLaravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }

    /**
     * Determine whether the user can create laravel blog users.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @return mixed
     */
    public function create(LaravelBlogUser $laravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }

    /**
     * Determine whether the user can update the laravel blog user.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\User  $otherLaravelBlogUser
     * @return mixed
     */
    public function update(LaravelBlogUser $laravelBlogUser, LaravelBlogUser $otherLaravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }

    /**
     * Determine whether the user can delete the laravel blog user.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\User  $otherLaravelBlogUser
     * @return mixed
     */
    public function delete(LaravelBlogUser $laravelBlogUser, LaravelBlogUser $otherLaravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }

    /**
     * Determine whether the user can restore the laravel blog user.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\User  $otherLaravelBlogUser
     * @return mixed
     */
    public function restore(LaravelBlogUser $laravelBlogUser, LaravelBlogUser $otherLaravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }

    /**
     * Determine whether the user can permanently delete the laravel blog user.
     *
     * @param  \Webup\LaravelBlog\Entities\User  $laravelBlogUser
     * @param  \Webup\LaravelBlog\Entities\User  $otherLaravelBlogUser
     * @return mixed
     */
    public function forceDelete(LaravelBlogUser $laravelBlogUser, LaravelBlogUser $otherLaravelBlogUser)
    {
        return $laravelBlogUser->isAdmin;
    }
}
