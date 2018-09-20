@extends('laravel-blog::layouts.admin')

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="{{ asset("vendor/laravel-blog/node_modules/flatpickr/dist/flatpickr.min.css") }}" rel="stylesheet">
@endsection

@section('content')

<div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="locale" value="{{ $locale }}">

    @include('laravel-blog::admin.post.elements.editor-toolbar')

    <div class="editor">
        <input type="text" data-post="title" class="editor-title" placeholder="{{ __("laravel-blog::post.form.title_placeholder") }}" value="{{ $post->translatedOrNew($locale)->title }}">
        <div id="editorContent" data-quill-placeholder="{{__('laravel-blog::post.form.content_placeholder')}}">
        </div>
    </div>

    @include('laravel-blog::admin.post.elements.meta-sidebar')
    @include('laravel-blog::admin.post.elements.i18n-sidebar')
    @include('laravel-blog::admin.post.elements.publication-sidebar')


    <div class="editor-infos">
        <div>{{ __("laravel-blog::post.form.word_count") }} <span data-counter>0</span></div>
        <div data-status="wrapper" class="editor-status">
            <i class="tag tag--green mr05" data-status="indicator"></i>
            <span data-status="normal">{{ __("laravel-blog::post.form.last_save") }} <span data-timeago></span></span>
            <span data-status="saving"><span class="loading-dot">{{ __("laravel-blog::post.form.saving") }}</span></span>
            <span data-status="error">{{ __("laravel-blog::post.form.error") }}</span>
        </div>
    </div>

</div>

<script data-template-translation-status="published" type="text/x-template">
    @include("laravel-blog::admin.post.elements.translations-status",["isDraw" => false,"isPublished" => true])
</script>
<script data-template-translation-status="draw" type="text/x-template">
    @include("laravel-blog::admin.post.elements.translations-status",["isDraw" => true,"isPublished" => false])
</script>
<script data-template-translation-status="unknown" type="text/x-template">
    @include("laravel-blog::admin.post.elements.translations-status",["isDraw" => false,"isPublished" => false])
</script>


@endsection

@section('js')
<script>
    var LBConfig = {
        uiLang : "{{ app()->getLocale() }}",
        updateUrl : "{{ route("admin.blog.post.update",["id" => $post->id,"lang" => $locale]) }}",
        updateMetaUrl : "{{ route("admin.blog.post.updateMeta",["id" => $post->id,"lang" => $locale]) }}",
        updatePublicationUrl : "{{ route("admin.blog.post.updatePublication",["id" => $post->id,"lang" => $locale]) }}",
        uploadImageUrl : "{{ route("admin.blog.image.upload") }}",
        quillContent : {!! ($post->translatedOrNew($locale)->quill_content) ? $post->translatedOrNew($locale)->quill_content : "{}" !!}
    };
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('vendor/laravel-blog/js/sidebar.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/status-bottom-bar.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/publication.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/editor.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/meta.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/translations.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/timeago.js/dist/timeago.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/timeago.js/dist/timeago.locales.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/pages/post.js') }}"></script>
@endsection
