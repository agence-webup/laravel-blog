# laravel-blog

# Config

## Database
```
'database' => [
  'connection' => env('DB_CONNECTION_BLOG', 'mysql'),
  'prefix_for_default_connection' => "blog_",
]
```

## Auth
### Guards
```
    'blog' => [
      'driver' => 'session',
      'provider' => 'blogs',
    ],
```
### Providers
```
    'blogs' => [
      'driver' => 'eloquent',
      'model' => Entities\User::class,
    ],
```

# Routes
- Listes des routes


# Overriding

## User
```
protected function redirectAfterStore(Webup\LaravelBlog\Entities\User $user){
  return route("admin.blog.user.index");
}
```
```
protected function redirectAfterUpdate(Webup\LaravelBlog\Entities\User $user){
  return route("admin.blog.user.index");
}
```

# Events

## User

```
Event::listen('laravel-blog.user.login', function ($event) {
    // $event->user;
});

Event::listen('laravel-blog.user.logout', function ($event) {
    // $event->user;
});

Event::listen('laravel-blog.user.register', function ($event) {
    // $event->user;
    // $event->password;
});

Event::listen('laravel-blog.user.update', function ($event) {
    // $event->user;
});
```
