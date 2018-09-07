<aside class="editor-sidebar" data-sidebar="i18n">
    <div class="editor-sidebar-list">
        @foreach (config()->get('blog.locales') as $code)
          <a href="{{ route("admin.blog.post.edit",["id" => $post->id,"lang" => $code]) }}">
            {{ __("laravel-blog::language.$code") }} @if($code == $locale) {{ __("laravel-blog::post.i18n.current") }} @endif
            @if($post->hasTranslation($code) && $post->translatedOrNew($code)->isPublished)
              <i class="tag tag--green mr05 right">Publié</i>&nbsp;
            @elseif($post->hasTranslation($code) && !$post->translatedOrNew($code)->isPublished)
              <i class="tag tag--red mr05 right">Brouillon</i>&nbsp;
            @else
              <i class="tag tag--grey mr05 right">Inexistant</i>&nbsp;
            @endif
          </a>
        @endforeach
    </div>
</aside>