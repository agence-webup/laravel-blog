@extends('laravel-blog::layouts.auth')

@section('content')
Index blog !

<hr>


@forelse ($posts as $post)
    <article>  
        Autheur : {{ $post->author->name }}<br>
        Date de publication : {{ $post->translated($locale)->published_at->format("d/m/Y à H:i") }}

        {{ $post->translated($locale)->title }}
        {{ $post->translated($locale)->content }}
        {{ $post->translated($locale)->hyperlink }}
        {{ $post->translated($locale)->excerpt }}

        <a href="{{ route("blog.show",[$locale,$post->id,$post->translated($locale)->hyperlink]) }}">Voir l"article</a>
    </article>
    <br>
@empty
    Aucun article ! 
@endforelse
@endsection
