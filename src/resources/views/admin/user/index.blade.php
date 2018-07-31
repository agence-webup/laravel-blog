@extends('laravel-blog::layouts.admin')

@section('content')
<h1>All users</h1>
<a href="{{ route("admin.blog.user.create") }}">New user</a>

<ul>
  @foreach ($users as $key => $user)
    <li>
        <img src="{{ $user->pictureUrl }}" width="40" height="40" alt="Profil picture" class="avatar--rounded avatar--small mr05">
        {{ $user->name }} ({{ $user->email }}) {{ $user->isAdmin }}
        <a class="btn btn--primary" href="{{ route('admin.blog.user.edit',[$user->id]) }}">Edit</a>
      </li>
  @endforeach
</ul>

@endsection
