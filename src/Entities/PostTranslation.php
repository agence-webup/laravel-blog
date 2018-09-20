<?php
namespace Webup\LaravelBlog\Entities;

use Webup\LaravelBlog\Entities\BaseModel;

class PostTranslation extends BaseModel
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'lang',
    'title',
    'content',
    'quill_content',
    'isFeatured',
    'isIndexed',
    'hyperlink',
    'excerpt',
    'seo',
    'isPublished',
    'published_at',
  ];

  protected $casts = [
    "seo" => "array",
  ];

  protected $dates = [
    "published_at"
  ];

  protected $appends = [
    "isDraw"
  ];

  public function getIsDrawAttribute()
  {
    return $this->exists && !$this->isPublished;
  }

  public function post()
  {
    return $this->belongsTo("Webup\LaravelBlog\Entities\Post");
  }
}
