@extends('laravel-blog::layouts.admin')

@section('content')
<h1>{{ __('laravel-blog::user.edit.title') }}</h1>

@if(Auth::guard("blog")->user()->id != $user->id)
  <form action="{{ route('admin.blog.user.delete',[$user->id]) }}" method="post">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button class="btn btn--danger" type="submit">{{ __('laravel-blog::user.edit.delete') }}</button>
  </form>
@endif

<form class="" action="{{ route("admin.blog.user.update",[$user->id]) }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  @include("laravel-blog::admin.user.elements.form")


  <button type="submit" class="btn btn--primary">{{ __('laravel-blog::user.edit.submit') }}</button>

</form>

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
