@extends('laravel-blog::layouts.admin')

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="editor-topbar">
    <div id="topbar">
        <div id="toolbar">
            <span class="ql-formats">
                <button type="button" class="ql-clean"></button>
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <select class="ql-align">
                    <option selected="selected"></option>
                    <option value="center"></option>
                    <option value="right"></option>
                    <option value="justify"></option>
                </select>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-header" value="2"></button>
                <button type="button" class="ql-blockquote"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-list" value="ordered" type="button"></button>
                <button class="ql-list" value="bullet" type="button"></button>
                <button type="button" class="ql-indent" value="-1"></button>
                <button type="button" class="ql-indent" value="+1"></button>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-image"></button>
                <button type="button" class="ql-video"></button>
                <button type="button" class="ql-link"></button>
            </span>
        </div>
    </div>
    <div class="editor-topbar__actions">
        <button>FR</button>
        <button>{{ __("laravel-blog::post.form.update") }}</button>
        <button>@include('laravel-blog::svg.settings2')</button>
    </div>
</div>

<div class="editor">
    <input type="text" data-post="title" class="editor-title" placeholder="{{ __("laravel-blog::post.form.title_placeholder") }}" value="{{ $post->title }}">
    <div id="editorContent">
    </div>
</div>

<div class="editor-status">
    <div>{{ __("laravel-blog::post.form.word_count") }} <span data-counter>0</span></div>
    <div><i class="tag tag--green mr1"></i>{{ __("laravel-blog::post.form.last_save") }} <span data-timeago></span></div>
</div>
@endsection

@section('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('vendor/laravel-blog/js/editor.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/timeago.js/dist/timeago.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/timeago.js/dist/timeago.locales.min.js') }}"></script>
<script>
    var editor = new Editor({
      quillConfig:{
        placeholder : "{{ __('laravel-blog::post.form.content_placeholder') }}"
      },
      interfaceLang : "{{ app()->getLocale() }}",
      updateUrl : "{{ route("admin.blog.post.update",[$post->id]) }}",
      customHeaders : {
        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
      },
      content : {!! ($post->quill_content) ? $post->quill_content : "{}" !!}
    }).init();

</script>
@endsection
