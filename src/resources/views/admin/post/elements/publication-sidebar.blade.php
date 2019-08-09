<aside class="editor-sidebar" data-sidebar="publication">
    <div>
        <input type="checkbox" name="isPublished" id="isPublished" class="switch"
            @if($post->translatedOrNew($locale)->isPublished) checked @endif>
        <label for="isPublished">{{ __("laravel-blog::post.publication.publish") }}</label>
    </div>
    <label for="schedule">{{ __("laravel-blog::post.publication.schedule") }}</label>
    <input type="datetime-local" id="published_at" name="published_at"
        value="{{ $post->translatedOrNew($locale)->published_at }}">
    @if($post->translatedOrNew($locale)->isPublished)
    <div class="mt3">
        <button class="btn btn--primary btn--wide">{{ __("laravel-blog::post.publication.update") }}</button>
    </div>
    @endif
    <div class="editor-sidebar__bottom mb2">
        <form action="{{ route("admin.blog.post.deleteLang",["id" => $post->id,"locale" => $locale])}}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn--link btn--wide btn--icon" data-confirm="{{ __("laravel-blog::post.publication.delete_message") }}">@include('laravel-blog::svg.trash'){{ __("laravel-blog::post.publication.delete") }}</button>
        </form>
    </div>
</aside>
