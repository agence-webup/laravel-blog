@extends('laravel-blog::layouts.auth')

@section('content')

<div>
    Changer de langue : 
    @foreach (config("blog.locales") as $avaiableLocale)
    <a href="{{ route("blog.indexLocalized", ["locale" => $avaiableLocale]) }}">{{ $avaiableLocale }}</a> | 
    @endforeach
<div>

<h1>Index blog {{ $locale }}!</h1>




<hr>


@forelse ($posts as $post)
    <article>  
        Auteur : {{ $post->author->name }}<br>
        Date de publication : {{ $post->translated($locale)->published_at->format("d/m/Y à H:i") }}<br>
        {{ $post->translated($locale)->title }}<br>
        {{ $post->translated($locale)->content }}<br>
        {{ $post->translated($locale)->hyperlink }}<br>
        {{ $post->translated($locale)->excerpt }}<br>

        <a href="{{ route("blog.show",[$locale,$post->id,$post->translated($locale)->hyperlink]) }}">Voir l"article</a>
    </article>
    <br>
@empty
    Aucun article ! 
@endforelse
@endsection
