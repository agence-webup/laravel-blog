@extends('laravel-blog::layouts.admin')

@section('content')
  <div class="content-pa">
      <div class="content-header">
          <h1>{{ __('laravel-blog::setting.index.title') }}</h1>
      </div>

      <form class="" action="{{ route("admin.blog.setting.update") }}" method="post">
        {{ csrf_field() }}

        @include("laravel-blog::admin.setting.elements.form")

        <div class="mt3">
            <button type="submit" class="btn btn--primary">{{ __('laravel-blog::setting.update.submit') }}</button>
        </div>

      </form>

  </div>
</div>

@endsection
