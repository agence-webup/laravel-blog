<?php

namespace Webup\LaravelBlog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostMeta extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "lang" => "required|in:" . implode(',', config("blog.locales")),
            "hyperlink" => "",
            "excerpt" => "",
            "thumbnail" => "",
            "isFeatured" => "",
            "isIndexed" => "",
            "seo.seo.title" => "",
            "seo.seo.description" => "",
            "seo.twitter.title" => "",
            "seo.twitter.description" => "",
            "seo.facebook.title" => "",
            "seo.facebook.description" => "",
        ];
    }
}
