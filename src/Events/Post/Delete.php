<?php

namespace Webup\LaravelBlog\Events\Post;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Webup\LaravelBlog\Entities\Post;

class Delete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
