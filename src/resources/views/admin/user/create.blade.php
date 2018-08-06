@extends('laravel-blog::layouts.admin')

@section('content')
<h1>{{ __('laravel-blog::user.create.title') }}</h1>

<form class="" action="{{ route("admin.blog.user.store") }}" method="post">
  {{ csrf_field() }}

  @include("laravel-blog::admin.user.elements.form")

  <button class="btn btn--primary" type="submit">Ajouter</button>

</form>

@endsection

@section('js')
  <script>
    var colibri = new Colibri('.colibri', {
        onUploadComplete: function(code, response) {
          var pictureInput = document.querySelector('[data-js=picture]');
          if(response.path){
            pictureInput.value = response.path;
          }
        }
    });
    </script>
@endsection
