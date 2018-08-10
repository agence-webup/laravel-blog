@extends('laravel-blog::layouts.admin')

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')

<div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="locale" value="{{ $locale }}">
    <div class="editor-topbar">
        <div id="topbar">
            <div id="toolbar">
                <span class="ql-formats">
                    <button type="button" class="ql-clean" title="{{ __("laravel-blog::post.topbar.reset") }}"></button>
                    <button class="ql-bold" title="{{ __("laravel-blog::post.topbar.bold") }}"></button>
                    <button class="ql-italic" title="{{ __("laravel-blog::post.topbar.italic") }}"></button>
                    <button class="ql-underline" title="{{ __("laravel-blog::post.topbar.underline") }}"></button>
                    <select class="ql-align" title="{{ __("laravel-blog::post.topbar.alignment") }}">
                        <option selected="selected" title="{{ __("laravel-blog::post.topbar.align.left") }}"></option>
                        <option value="center" title="{{ __("laravel-blog::post.topbar.align.center") }}"></option>
                        <option value="right" title="{{ __("laravel-blog::post.topbar.align.right") }}"></option>
                        <option value="justify" title="{{ __("laravel-blog::post.topbar.align.justify") }}"></option>
                    </select>
                </span>
                <span class="ql-formats" title="pouet">
                    <button type="button" class="ql-header" value="2" title="{{ __("laravel-blog::post.topbar.header") }}"></button>
                    <button type="button" class="ql-header" value="3" title="{{ __("laravel-blog::post.topbar.header") }}">@include('laravel-blog::svg.quill.header-3')</button>
                    <button type="button" class="ql-header" value="4" title="{{ __("laravel-blog::post.topbar.header") }}">@include('laravel-blog::svg.quill.header-4')</button>
                    <button type="button" class="ql-header" value="5" title="{{ __("laravel-blog::post.topbar.header") }}">@include('laravel-blog::svg.quill.header-5')</button>
                    <button type="button" class="ql-blockquote" title="{{ __("laravel-blog::post.topbar.quote") }}"></button>
                </span>
                <span class="ql-formats" title="pouet">
                    <button class="ql-list" value="ordered" type="button" title="{{ __("laravel-blog::post.topbar.list.ordered") }}"></button>
                    <button class="ql-list" value="bullet" type="button" title="{{ __("laravel-blog::post.topbar.list.bullet") }}"></button>
                    <button type="button" class="ql-indent" value="-1" title="{{ __("laravel-blog::post.topbar.indent") }}"></button>
                    <button type="button" class="ql-indent" value="+1" title="{{ __("laravel-blog::post.topbar.unindent") }}"></button>
                </span>
                <span class="ql-formats" title="pouet">
                    <button type="button" class="ql-image" title="{{ __("laravel-blog::post.topbar.image") }}"></button>
                    <button type="button" class="ql-video" title="{{ __("laravel-blog::post.topbar.video") }}"></button>
                    <button type="button" class="ql-link" title="{{ __("laravel-blog::post.topbar.link") }}"></button>
                </span>
            </div>
        </div>
        <div class="editor-topbar__actions">
            <button data-sidebar="triggerI18n">FR</button>
            <button data-sidebar="triggerStatus">{{ __("laravel-blog::post.form.update") }}</button>
            <button title="{{ __("laravel-blog::post.topbar.settings") }}" class="editor-sidebarBtn" data-sidebar="triggerMeta">
                @include('laravel-blog::svg.settings2') 
                @include('laravel-blog::svg.close')
            </button>
        </div>
    </div>
    
    <div class="editor">
        <input type="text" data-post="title" class="editor-title" placeholder="{{ __("laravel-blog::post.form.title_placeholder") }}" value="{{ $post->title }}">
        <div id="editorContent" data-quill-placeholder="{{__('laravel-blog::post.form.content_placeholder')}}">
        </div>
    </div>
    
    <aside class="editor-sidebar" data-sidebar="meta">
        <div class="editor-sidebar__section">Propriété de l'article</div>
        <label for="hyperlink">Hyperlien</label>
        <input type="text" id="hyperlink" name="hyperlink">
        <label for="excerpt">Extrait de l'article</label>
        <textarea id="excerpt" name="excerpt"></textarea>
        <label>Autres réglages</label>
        <div>
            <input type="checkbox" name="isFeatured" id="isFeatured" class="switch">
            <label for="isFeatured">Mise en avant</label>
        </div>
        <div>
            <input type="checkbox" name="isIndexed" id="isIndexed" class="switch" checked>
            <label for="isIndexed" checked>Article indexé</label>
        </div>
        <div class="editor-sidebar__section">SEO</div>
        <label for="seoTitle">Title</label>
        <input type="text" id="seoTitle" name="seoTitle">
        
        <label for="seoDescription">Meta description</label>
        <textarea name="seoDescription" id="seoDescription"></textarea>
        
        <div class="editor-sidebar__section">Twitter</div>
        
        <label for="twitterTitle">Twitter title</label>
        <input type="text" id="twitterTitle" name="twitterTitle">
        
        <label for="twitterDescription">Twitter description</label>
        <textarea name="twitterDescription" id="twitterDescription"></textarea>
        
        <div class="editor-sidebar__section">Facebook</div>
        
        <label for="facebookTitle">Facebook title</label>
        <input type="text" id="facebookTitle" name="facebookTitle">
        
        <label for="facebookDescription">Facebook description</label>
        <textarea name="facebookDescription" id="facebookDescription"></textarea>
    </aside>
    
    <aside class="editor-sidebar" data-sidebar="i18n">
        <div class="editor-sidebar-list">
            <a href="#"><i class="tag tag--green mr05"></i> Français (en cours)</a>
            <a href="#"><i class="tag tag--red mr05"></i> Anglais</a>
            <a href="#"><i class="tag tag--red mr05"></i> Allemand</a>
        </div>
    </aside>
    
    <aside class="editor-sidebar" data-sidebar="status">
        <div>
            <input type="checkbox" name="isPublished" id="isPublished" class="switch" checked>
            <label for="isPublished" checked>Publish article</label>
        </div>
        <label for="schedule">Schedule</label>
        <input type="datetime-local" id="schedule">
        <div class="mt3">
            <button class="btn btn--primary btn--wide">Update article</button>
        </div>
    </aside>
    
    <div class="editor-infos">
        <div>{{ __("laravel-blog::post.form.word_count") }} <span data-counter>0</span></div>
        <div data-status="wrapper" class="editor-status">
            <i class="tag tag--green mr05" data-status="indicator"></i>
            <span data-status="normal">{{ __("laravel-blog::post.form.last_save") }} <span data-timeago></span></span>
            <span data-status="saving"><span class="loading-dot">Saving your post</span></span>
            <span data-status="error">Error while saving</span>
        </div>
    </div>
    
</div>

@endsection

@section('js')
<script>
    var LBConfig = {
        uiLang : "{{ app()->getLocale() }}",
        updateUrl : "{{ route("admin.blog.post.update",[$post->id]) }}",
        uploadImageUrl : "{{ route("admin.blog.image.upload") }}",
        quillContent : {!! ($post->quill_content) ? $post->quill_content : "{}" !!}
    };
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('vendor/laravel-blog/js/sidebar.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/status-bar.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/editor.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/meta.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/timeago.js/dist/timeago.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/node_modules/timeago.js/dist/timeago.locales.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-blog/js/pages/post.js') }}"></script>
@endsection
