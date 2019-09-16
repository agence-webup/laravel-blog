@extends('laravel-blog::layouts.auth')

@section('content')



@forelse ($postTranslations as $postTranslation)
    <article>  
        Auteur : {{ $postTranslation->author->name }}<br>
        Date de publication : {{ $postTranslation->published_at->format("d/m/Y à H:i") }}<br>
        {{ $postTranslation->title }}<br>
        {{ $postTranslation->content }}<br>
        {{ $postTranslation->hyperlink }}<br>
        {{ $postTranslation->excerpt }}<br>

        <a href="{{ route("blog.show",[$postTranslation->post->id,$postTranslation->hyperlink]) }}">Voir l"article</a>
    </article>
    <br>
@empty
    Aucun article ! 
@endforelse
@endsection
