<?php

namespace Webup\LaravelBlog\Entities;

use Webup\LaravelBlog\Entities\BaseModel;

class Setting extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $primaryKey = 'key'; // or null
    public $incrementing = false;

    public $timestamps = false;

    public static function allFormatted()
    {
        $settings = self::pluck("value", "key");
        return $settings;
    }
}
