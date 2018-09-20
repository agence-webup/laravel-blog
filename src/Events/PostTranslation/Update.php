<?php

namespace Webup\LaravelBlog\Events\PostTranslation;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Webup\LaravelBlog\Entities\PostTranslation;

class Update
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $postTranslation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PostTranslation $postTranslation)
    {
        $this->postTranslation = $postTranslation;
    }
}
