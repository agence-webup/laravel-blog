<?php

namespace Webup\LaravelBlog\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $langs = [];
        foreach (config()->get('blog.locales') as $code) {
            $langs[$code] = [
                "isDraw" => $this->post->translatedOrNew($code)->isDraw,
                "isPublished" => $this->post->translatedOrNew($code)->isPublished,
            ];
        }

        return [
            "id" => $this->id,
            "post_id" => $this->post_id,
            "title" => $this->title,
            "content" => $this->content,
            "excerpt" => $this->excerpt,
            "hyperlink" => $this->hyperlink,
            "isDraw" => $this->isDraw,
            "isFeatured" => $this->isFeatured,
            "isIndexed" => $this->isIndexed,
            "isPublished" => $this->isPublished,
            "lang" => $this->lang,
            "quill_content" => $this->quill_content,
            "seo" => [
                "facebook" => [
                    "description" => array_get($this->seo, "facebook.description", null),
                    "title" => array_get($this->seo, "facebook.title", null),
                ],
                "seo" => [
                    "description" => array_get($this->seo, "seo.description", null),
                    "title" => array_get($this->seo, "seo.title", null),
                ],
                "twitter" => [
                    "description" => array_get($this->seo, "twitter.description", null),
                    "title" => array_get($this->seo, "twitter.title", null),
                ],
            ],
            "langs" => $langs,
            "published_at" => $this->published_at,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
