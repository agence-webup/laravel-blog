<?php
namespace Webup\LaravelBlog\Entities;

class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    public function __construct(array $attributes = array())
    {
        $this->connection = config()->get('blog.database.connection');
        parent::__construct($attributes);
    }
}
