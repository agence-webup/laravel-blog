@extends('laravel-blog::layouts.admin')

@section('content')
<div class="content-pa">
    <div class="content-header">
        <h1>{{ __('laravel-blog::post.index.title',["count" => $posts->count()]) }}</h1>
        <a href="{{ route("admin.blog.post.create") }}" class="btn btn--primary">{{ __("laravel-blog::post.index.add") }}</a>
    </div>

    @foreach ($posts as $key => $post)
      <a class="card card-blog card-blog--published" href="{{ route("admin.blog.post.edit", ["id" => $post->id,"lang" => (Auth::guard("blog")->user()->lang) ? Auth::guard("blog")->user()->lang : config()->get('blog.default_locale')]) }}">
          <div>
              <h2>@if($post->translatedOrNew(Auth::guard("blog")->user()->lang)->title) {{ $post->translatedOrNew(Auth::guard("blog")->user()->lang)->title }} @else <i>{{ __("laravel-blog::post.index.no-title") }}</i> @endif</h2>
              <div class="card-blog__sub">@include('laravel-blog::svg.clock') {{ $post->created_at->formatLocalized(__("laravel-blog::date.date_with_hours")) }} - {{ __("laravel-blog::post.index.written",["name" => $post->author->name]) }}</div>
          </div>
      </a>
    @endforeach
</div>
@endsection

@section('css')

@endsection


@section('js')

@endsection
