@extends('laravel-blog::layouts.admin')

@section('css')
<link href="{{ asset("vendor/laravel-blog/node_modules/filepond/dist/filepond.min.css") }}" rel="stylesheet">
<link href="{{ asset("vendor/laravel-blog/node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css") }}" rel="stylesheet">
@endsection

@section('content')

<div class="content-pa">
    <div class="content-header">
        <h1>{{ __('laravel-blog::user.create.title') }}</h1>
    </div>

    <form class="" action="{{ route("admin.blog.user.store") }}" method="post">
      {{ csrf_field() }}

      @include("laravel-blog::admin.user.elements.form")

      <div class="mt3">
          <button type="submit" class="btn btn--primary">{{ __('laravel-blog::user.create.submit') }}</button>
      </div>

    </form>

</div>

@endsection

@section('js')
@include("laravel-blog::admin.user.elements.javascript")
@endsection
