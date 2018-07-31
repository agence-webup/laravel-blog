<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-blog/css/laravel-blog.css') }}" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/agence-webup/colibri/83b76ae3/dist/colibri.css">
    @yield('css')
</head>
<body>
    <div class="app">
        <nav class="navigation">
            <div class="navigation-profil">
                <img src="{{ Auth::guard("blog")->user()->pictureUrl }}" width="40" height="40" alt="Profil picture" class="avatar--rounded avatar--small mr05"> {{ Auth::guard("blog")->user()->email }}
            </div>
            <div class="navigation-menu">
                <div class="navigation-menu__main">
                    <a href="{{route('admin.blog.post.create')}}" class="is-active">@include('laravel-blog::svg.add') Écrire un article</a>
                    <a href="{{route('admin.blog.post.index')}}">@include('laravel-blog::svg.list') Mes articles</a>
                    <a href="{{route('blog.index')}}" target="_blank">@include('laravel-blog::svg.website') Voir mon site</a>
                    <a href="{{route('admin.blog.user.index')}}">@include('laravel-blog::svg.user') Utilisateurs</a>
                    <a href="#">@include('laravel-blog::svg.settings') Réglages</a>
                </div>
                <div class="navigation-menu__bottom">
                    <form action="{{ route("admin.blog.logout") }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" name="button" class="navigation-logout">Se déconnecter</button>
                    </form>
                </div>
            </div>

        </nav>
        <main class="content">
            @yield('content')
        </main>
    <div>
    <script src="https://cdn.rawgit.com/agence-webup/colibri/83b76ae3/dist/colibri.js" charset="utf-8"></script>
    @yield('js')
</body>
</html>
