<?php
namespace Webup\LaravelBlog\Entities;

use Webup\LaravelBlog\Entities\BaseModel;

class Post extends BaseModel
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
      'user_id',
    ];

    public function author()
    {
        return $this->belongsTo("Webup\LaravelBlog\Entities\User", "user_id");
    }

    public function isRecentlyCreated()
    {
        return $this->created_at == $this->updated_at;
    }

    public function hasTranslation($code)
    {
        $this->testAuthorizedLocal($code);

        foreach ($this->translations as $translation) {
            if ($translation->lang == $code) {
                return true;
            }
        }

        return false;
    }

    public function translated($code)
    {
        $this->testAuthorizedLocal($code);

        foreach ($this->translations as $translation) {
            if ($translation->lang == $code) {
                return $translation;
            }
        }

        return null;
    }

    private function testAuthorizedLocal($locale)
    {
        if (!in_array($locale, config()->get('blog.locales'))) {
            throw new \Exception("No '".$locale."' found in blog.locales");
        }
    }

    public function translatedOrNew($code)
    {
        $tranlsation = $this->translated($code);
        if (!$tranlsation) {
            $tranlsation = new PostTranslation();
            $tranlsation->post_id = $this->id;
            $tranlsation->lang = $code;
        }

        return $tranlsation;
    }

    public function translations()
    {
        return $this->hasMany("Webup\LaravelBlog\Entities\PostTranslation");
    }
}
