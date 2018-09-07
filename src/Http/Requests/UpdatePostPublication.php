<?php

namespace Webup\LaravelBlog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostPublication extends FormRequest
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
            "isPublished" => "",
            "published_at" => "",
        ];
    }
}
