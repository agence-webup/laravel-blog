<?php

namespace Webup\LaravelBlog\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;

class User extends Authenticatable
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

    public function getPictureUrlAttribute()
    {
        if (!$this->picture) {
            return "https://randomuser.me/api/portraits/women/21.jpg";
        }
        return Storage::url($this->picture);
    }
}
