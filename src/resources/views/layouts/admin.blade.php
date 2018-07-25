<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
      <form action="{{ route("admin.blog.logout") }}" method="post">
          {{ csrf_field() }}
          <button type="submit" name="button">Logout</button>
      </form>

      <main>
          @yield('content')
      </main>
</body>
</html>
