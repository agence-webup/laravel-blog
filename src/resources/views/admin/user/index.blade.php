@extends('laravel-blog::layouts.admin')

@section('content')
<h1>All users</h1>
<a href="{{ route("admin.blog.user.create") }}">New user</a>

<ul>
  @foreach ($users as $key => $user)
    <li>{{ $user->name }} ({{ $user->email }}) {{ $user->isAdmin }} <a href="{{ route('admin.blog.user.edit',[$user->id]) }}">Edit</a></li>
  @endforeach
</ul>

@endsection
