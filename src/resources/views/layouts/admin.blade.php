@php
    use Webup\LaravelBlog\Helpers\Helper as BlogHelper;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-blog/css/laravel-blog.css') }}" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div class="app">
        <nav class="navigation">
            <div class="navigation-profil">
                @if(Auth::user()->pictureUrl)<img src="{{ Auth::user()->pictureUrl }}" width="40" height="40" alt="Profil picture" class="avatar--rounded avatar--small mr05">@endif {{ Auth::user()->name }}
            </div>
            <div class="navigation-menu">
                <div class="navigation-menu__main">
                    @if (Auth::user()->can('create', \Webup\LaravelBlog\Entities\Post::class))
                        <a href="{{route('admin.blog.post.create')}}" class="{{ BlogHelper::current_blog_route("admin.blog.post.edit","is-active") }}">@include('laravel-blog::svg.add') {{ __("laravel-blog::menu.newpost") }}</a>
                    @endif
                    @if (Auth::user()->can('list', \Webup\LaravelBlog\Entities\Post::class))
                        <a href="{{route('admin.blog.post.index')}}" class="{{ BlogHelper::current_blog_route("admin.blog.post.index","is-active") }}">@include('laravel-blog::svg.list') {{ __("laravel-blog::menu.posts") }}</a>
                    @endif
                    <a href="{{route('blog.index')}}" target="_blank">@include('laravel-blog::svg.website') {{ __("laravel-blog::menu.website") }}</a>
                    @if ((config()->get("blog.custom_guard", null) ?: "blog") == "blog" && Auth::user()->can('list', \Webup\LaravelBlog\Entities\User::class))
                        <a href="{{route('admin.blog.user.index')}}" class="{{ BlogHelper::current_blog_route("admin.blog.user","is-active") }}">@include('laravel-blog::svg.user') {{ __("laravel-blog::menu.users") }}</a>
                    @endif
                    {{-- @if (Auth::user()->can('update', $post)) --}}
                        <a href="{{route('admin.blog.setting.index')}}" class="{{ BlogHelper::current_blog_route("admin.blog.setting","is-active") }}">@include('laravel-blog::svg.settings') {{ __("laravel-blog::menu.settings") }}</a>
                    {{-- @endif --}}

                    @if( config("blog.custom_link.link") &&  config("blog.custom_link.name"))
                        <a href="{{ config("blog.custom_link.link") }}">@include('laravel-blog::svg.settings') {{ config("blog.custom_link.name") }}</a>
                    @endif
                </div>
                <div class="navigation-menu__bottom">
                    <form action="{{ route("admin.blog.logout") }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" name="button" class="navigation-logout">{{ __("logout") }}</button>
                    </form>
                </div>
            </div>
        </nav>
        <main class="content">
            @yield('content')
        </main>
    <div>
        <script src="{{ asset('node_modules/quill-image-drop-module/image-drop.min.js') }}"></script>
        <script src="{{ asset('node_modules/quill-image-resize-module/image-resize.min.js') }}"></script>
        <script src="{{ asset('node_modules/quill/dist/quill.min.js') }}"></script>
        <script src="{{ asset('node_modules/timeago.js/dist/timeago.min.js') }}"></script>
        <script src="{{ asset('node_modules/timeago.js/dist/timeago.locales.min.js') }}"></script>
        <script src="{{ asset('node_modules/flatpickr/dist/flatpickr.min.js') }}"></script>
        <script src="{{ asset('vendor/laravel-blog/js/bundle.js') }}"></script>
        @yield('js')
</body>
</html>
