<aside class="editor-sidebar" data-sidebar="publication">
    <div>
        <input type="checkbox" name="isPublished" id="isPublished" class="switch" @if($post->translatedOrNew($locale)->isPublished) checked @endif>
        <label for="isPublished">{{ __("laravel-blog::post.publication.publish") }}</label>
    </div>
    <label for="schedule">{{ __("laravel-blog::post.publication.schedule") }}</label>
    <input type="datetime-local" id="published_at" name="published_at" value="{{ $post->translatedOrNew($locale)->published_at }}">
    @if($post->translatedOrNew($locale)->isPublished)
        <div class="mt3">
            <button class="btn btn--primary btn--wide">{{ __("laravel-blog::post.publication.update") }}</button>
        </div>
    @endif
</aside>