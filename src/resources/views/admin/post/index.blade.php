@extends('laravel-blog::layouts.admin')

@section('content')
<div class="content-pa">
    <div class="content-header">
        <h1>Tous mes articles (2)</h1>
        <a href="{{ route("admin.blog.post.create") }}" class="btn btn--primary">Écrire un article</a>
    </div>

    @foreach ($posts as $key => $post)

      <a class="card card-blog card-blog--published" href="{{ route("admin.blog.post.edit",[$post->id]) }}">
          <div>
              <h2>{{ $post->title }}</h2>
              <div>@include('laravel-blog::svg.list') {{ $post->created_at->formatLocalized('%c') }} (dernière modification : {{ $post->updated_at->formatLocalized('%c') }}) - article rédigé par {{ $post->author->name }}</div>
          </div>
      </a>
    @endforeach
</div>
@endsection

@section('css')

@endsection


@section('js')

@endsection
