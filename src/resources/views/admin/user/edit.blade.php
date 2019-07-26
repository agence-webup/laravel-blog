@extends('laravel-blog::layouts.admin')

@section('css')
<link href="{{ asset("vendor/laravel-blog/node_modules/filepond/dist/filepond.min.css") }}" rel="stylesheet">
<link href="{{ asset("vendor/laravel-blog/node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css") }}" rel="stylesheet">
@endsection

@section('content')

<div class="content-pa">
    <div class="content-header">
        <h1>{{ __('laravel-blog::user.edit.title') }} : {{ $user->name }}</h1>
    </div>

    @if(Auth::user()->id != $user->id)
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

        <div class="mt3">
            <button type="submit" class="btn btn--primary">{{ __('laravel-blog::user.edit.submit') }}</button>
        </div>
    </form>
</div>



@endsection

@section('js')
@include("laravel-blog::admin.user.elements.javascript")
@endsection

