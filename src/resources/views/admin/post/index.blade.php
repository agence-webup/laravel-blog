@extends('laravel-blog::layouts.admin')

@section('content')
<h1>All posts</h1>

<a href="{{ route("admin.blog.post.create") }}">New post</a>

<ul>
  @foreach ($posts as $key => $post)
    <li>{{ $post->title }}</li>
  @endforeach
</ul>

@endsection

@section('css')

@endsection


@section('js')

@endsection
