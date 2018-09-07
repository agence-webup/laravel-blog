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
            <button data-sidebar="triggerI18n">{{ strtoupper($locale) }}</button>
            <button data-sidebar="triggerStatus">{{ __("laravel-blog::post.form.update") }}</button>
            <button title="{{ __("laravel-blog::post.topbar.settings") }}" class="editor-sidebarBtn" data-sidebar="triggerMeta">
                @include('laravel-blog::svg.settings2')
                @include('laravel-blog::svg.close')
            </button>
        </div>
    </div>