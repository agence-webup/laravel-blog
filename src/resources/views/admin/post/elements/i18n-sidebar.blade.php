<aside class="editor-sidebar" data-sidebar="i18n">
    <div class="editor-sidebar-list">
        @foreach (config()->get('blog.locales') as $code)
          <a href="{{ route("admin.blog.post.edit",["id" => $post->id,"lang" => $code]) }}" @if($code == $locale) @endif>
            {{ __("laravel-blog::language.$code") }} @if($code == $locale) {{ __("laravel-blog::post.i18n.current") }} @endif
            <span data-translation="{{ $code }}">
              @include("laravel-blog::admin.post.elements.translations-status",["isDraw" => $post->translatedOrNew($code)->isDraw,"isPublished" => $post->translatedOrNew($code)->isPublished])
            </span>
          </a>
        @endforeach
    </div>
</aside>