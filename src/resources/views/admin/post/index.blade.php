@extends('laravel-blog::layouts.admin')

@section('content')
<div class="content-pa">
    <div class="content-header">
        <h1>Tous mes articles (2)</h1>
        <a href="{{ route("admin.blog.post.create") }}" class="btn btn--primary">Écrire un article</a>
    </div>
    
    <!--
        <ul>
            @foreach ($posts as $key => $post)
            <article class="card card-blog card-blog--published">
                <div>
                    <h2>{{ $post->title }}</h2>
                    <div>@include('laravel-blog::svg.list') 18/11/2018 à 12:00 - article rédigé par Martin</div>
                </div>
            </article>
            @endforeach
        </ul>
    -->
    
    <a class="card card-blog card-blog--published">
        <div>
            <h2>Ici le titre de mon article</h2>
            <div>@include('laravel-blog::svg.list') 18/11/2018 à 12:00 - article rédigé par Martin</div>
        </div>
    </a>
    
    <a class="card card-blog card-blog--published">
        <div>
            <h2>Ici le titre de mon article</h2>
            <div>@include('laravel-blog::svg.list') 18/11/2018 à 12:00 - article rédigé par Martin</div>
        </div>
    </a>
</div>
@endsection

@section('css')

@endsection


@section('js')

@endsection
