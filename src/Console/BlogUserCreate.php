<?php

namespace Webup\LaravelBlog\Console;

use Illuminate\Console\Command;
use Webup\LaravelBlog\Entities\User;

class BlogUserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:createAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a blog admin user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment("Create a blog admin user");

        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->ask('Password');

        try {
            $admin = new User();
            $admin->name = $name;
            $admin->email = $email;
            $admin->lang = config("blog.default_locale");
            $admin->password = bcrypt($password);
            $admin->isAdmin = true;
            $admin->save();
            $this->comment("Blog admin user was created");
        } catch (\Exception $e) {
            $this->error("Cannot create blog admin user");
            $this->error($e->getMessage());
        }
    }
}
