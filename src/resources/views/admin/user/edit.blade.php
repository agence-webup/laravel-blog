@extends('laravel-blog::layouts.admin')

@section('content')
<h1>Edit user</h1>

<form class="" action="{{ route("admin.blog.user.update",[$user->id]) }}" method="post">
  {{ csrf_field() }}

  @include("laravel-blog::admin.user.elements.form")


  <button type="submit">Ajouter</button>

</form>

@endsection

@section('js')
  <script>
    var colibri = new Colibri('.colibri', {
        onUploadComplete: function(code, response) {
            console.log(response);
        }
    });
    </script>
@endsection