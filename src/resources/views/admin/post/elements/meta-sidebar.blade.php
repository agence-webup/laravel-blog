<aside class="editor-sidebar" data-sidebar="meta">
    
    {{-- Post properties --}}
    <div class="editor-sidebar__section">{{ __("laravel-blog::post.meta.post.section") }}</div>
    
    <label for="hyperlink">{{ __("laravel-blog::post.meta.post.hyperlink") }}</label>
    <input type="text" id="hyperlink" name="hyperlink" value="{{ $post->translatedOrNew($locale)->hyperlink }}">
    
    <label for="excerpt">{{ __("laravel-blog::post.meta.post.excerpt") }}</label>
    <textarea id="excerpt" name="excerpt">{{ $post->translatedOrNew($locale)->excerpt }}</textarea>
    
    <label>{{ __("laravel-blog::post.meta.post.other_settings") }}</label>
    <div>
        <input type="checkbox" name="isFeatured" id="isFeatured" class="switch" @if($post->translatedOrNew($locale)->isFeatured) checked @endif>
        <label for="isFeatured">{{ __("laravel-blog::post.meta.post.featured") }}</label>
    </div>
    <div>
        <input type="checkbox" name="isIndexed" id="isIndexed" class="switch" @if($post->translatedOrNew($locale)->isIndexed) checked @endif>
        <label for="isIndexed">{{ __("laravel-blog::post.meta.post.indexed") }}</label>
    </div>
    
    {{-- Seo --}}
    <div class="editor-sidebar__section">{{ __("laravel-blog::post.meta.seo.section") }}</div>
    
    <label for="seoTitle">{{ __("laravel-blog::post.meta.seo.title") }}</label>
    <input type="text" id="seoTitle" name="seo[seo][title]" value="{{ array_get($post->translatedOrNew($locale)->seo,"seo.title") }}">

    
    <label for="seoDescription">{{ __("laravel-blog::post.meta.seo.description") }}</label>
    <textarea name="seo[seo][description]" id="seoDescription">{{ array_get($post->translatedOrNew($locale)->seo,"seo.description") }}</textarea>

    
    {{-- Twitter --}}
    <div class="editor-sidebar__section">{{ __("laravel-blog::post.meta.twitter.section") }}</div>

    
    <label for="twitterTitle">{{ __("laravel-blog::post.meta.twitter.title") }}</label>
    <input type="text" id="twitterTitle" name="seo[twitter][title]" value="{{ array_get($post->translatedOrNew($locale)->seo,"twitter.title") }}">

    
    <label for="twitterDescription">{{ __("laravel-blog::post.meta.twitter.description") }}</label>
    <textarea name="seo[twitter][description]" id="twitterDescription">{{ array_get($post->translatedOrNew($locale)->seo,"twitter.description") }}</textarea>

    
    {{-- Facebook --}}
    <div class="editor-sidebar__section">{{ __("laravel-blog::post.meta.facebook.section") }}</div>

    
    <label for="facebookTitle">{{ __("laravel-blog::post.meta.facebook.title") }}</label>
    <input type="text" id="facebookTitle" name="seo[facebook][title]" value="{{ array_get($post->translatedOrNew($locale)->seo,"facebook.title") }}">

    
    <label for="facebookDescription">{{ __("laravel-blog::post.meta.facebook.description") }}</label>
    <textarea name="seo[facebook][description]" id="facebookDescription">{{ array_get($post->translatedOrNew($locale)->seo,"facebook.description") }}</textarea>
</aside>