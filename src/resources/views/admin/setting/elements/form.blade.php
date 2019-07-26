<div>
    <label for="name">{{ __("laravel-blog::setting.form.name") }}</label>
    <input id="name" type="text" name="blogName" value="{{ config('blog.blogName') }}" required>
</div>

<div>
    <label for="email">{{ __("laravel-blog::setting.form.articleNumber") }}</label>
    <input id="email" type="number" name="articleNumber" value="{{ config('blog.articleNumber') }}" required>
</div>
