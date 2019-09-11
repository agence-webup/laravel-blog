<?php

namespace Webup\LaravelBlog\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;
use Webup\LaravelBlog\Entities\Interfaces\UserInterface;

class User extends Authenticatable implements UserInterface
{
    use Notifiable;

    public function __construct(array $attributes = array())
    {
        $this->connection = config()->get('blog.database.connection');
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'picture', 'biography', 'lang', 'isAdmin', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function unauthenticatedRedirectRoute()
    {
        return route('admin.blog.login');
    }

    public function getIsAdminAttribute()
    {
        return $this->attributes['isAdmin'];
    }

    public function getLangAttribute()
    {
        return $this->attributes['lang'];
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }


    public function getPictureUrlAttribute()
    {
        if (!$this->picture) {
            return "https://randomuser.me/api/portraits/women/21.jpg";
        }
        $url = Storage::url($this->picture);
        if (substr($url, 0, 1) == "/") {
            $url = config("app.url") . $url;
        }
        return $url;
    }
}
