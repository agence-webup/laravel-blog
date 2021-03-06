<?php

namespace Webup\LaravelBlog\Events\User;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Webup\LaravelBlog\Entities\User;

class Register
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user;
    public $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
