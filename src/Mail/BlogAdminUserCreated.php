<?php

namespace Webup\LaravelBlog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Webup\LaravelBlog\Entities\User;

class BlogAdminUserCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Blog '.config('app.name').'] New user')
          ->markdown('laravel-blog::emails.new_admin_user', [
            "user" => $this->user,
            "password" => $this->password,
          ]);
    }
}
