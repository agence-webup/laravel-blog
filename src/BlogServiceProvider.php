<?php

namespace Webup\LaravelBlog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Webup\LaravelBlog\Entities\User;
use Webup\LaravelBlog\Console\BlogUserCreate;
use Webup\LaravelBlog\Http\Middleware\BlogRedirectIfNotAuth;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->publishes([
          __DIR__.'/../config/blog.php' => config_path('blog.php'),
        ]);

        $router->aliasMiddleware('blog.auth', BlogRedirectIfNotAuth::class);

        $this->loadMigrationsFrom(__DIR__.'/../database');

        $this->loadRoutesFrom(__DIR__.'/routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');


        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-blog');

        if ($this->app->runningInConsole()) {
            $this->commands([
                BlogUserCreate::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
           __DIR__.'/../config/blog.php',
                  'blog'
       );

        $this->defineConnection();
        $this->defineAuth();
    }

    /**
    * Update db connection for package
    *
    * @return void
    */
    private function defineConnection()
    {
        // If project connection is same as package connection
        if (config()->get('database.default') == config()->get('blog.database.connection')) {
            // Get project connection
            $defaultConfig = config()->get('database.connections.'.config()->get('database.default'));
            // Add prefix (avoid tablename conflict)
            $defaultConfig["prefix"] = array_get(config('blog.database'), "prefix_for_default_connection", "");
            // Add new connection with name 'blog' (avoid connection overriding)
            config()->set('database.connections.blog', $defaultConfig);
            // Replace config connection value with 'blog'
            config()->set('blog.database.connection', 'blog');
        }
    }

    /**
    * Update auth for package
    *
    * @return void
    */
    private function defineAuth()
    {
        //Get guards config
        $guardsConfig = $this->app['config']->get("auth.guards", []);
        //Merge default guard for blog
        $this->app['config']->set("auth.guards", array_merge([
            'blog' => [
              'driver' => 'session',
              'provider' => 'blogs',
            ],
        ], $guardsConfig));

        //Get providers config
        $providersConfig = $this->app['config']->get("auth.providers", []);
        //Merge default provider for blog
        $this->app['config']->set("auth.providers", array_merge([
            'blogs' => [
              'driver' => 'eloquent',
              'model' => Entities\User::class,
            ],
        ], $providersConfig));
    }
}
