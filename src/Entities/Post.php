<?php
namespace Webup\LaravelBlog\Entities;

use Webup\LaravelBlog\Entities\BaseModel;

class Post extends BaseModel
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
      'user_id',
      'title',
      'content',
      'quill_content',
    ];

    public function author()
    {
        return $this->belongsTo("Webup\LaravelBlog\Entities\User", "user_id");
    }
}
