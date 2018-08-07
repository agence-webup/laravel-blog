@extends('laravel-blog::layouts.admin')

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
  <script>
    var colibri = new Colibri('.colibri', {
        onUploadComplete: function(code, response) {
          var response = JSON.parse(response);
          var pictureInput = document.querySelector('[data-js=picture]');
          if(response.path){
            pictureInput.value = response.path;
          }
        }
    });
    </script>
@endsection
