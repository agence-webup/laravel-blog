@extends('laravel-blog::layouts.admin')

@section('content')
<div class="content-pa">
    <div class="content-header">
        <h1>{{ __('laravel-blog::user.index.title',["count" => $users->count()]) }}</h1>
        <a href="{{ route("admin.blog.user.create") }}" class="btn btn--primary">{{ __("laravel-blog::user.index.add") }}</a>
    </div>

    @foreach ($users as $key => $user)
    <a href="{{ route('admin.blog.user.edit',[$user->id]) }}" class="card card-blog card-blog--published">
        <div>
            <img src="{{ $user->pictureUrl }}" width="40" height="40" class="avatar--rounded avatar--small mr05">
            <h2>{{ $user->name }}</h2> - ({{ $user->email }}) - {{ $user->isAdmin }}
        </div>
    </a>
    @endforeach
</div>
@endsection
