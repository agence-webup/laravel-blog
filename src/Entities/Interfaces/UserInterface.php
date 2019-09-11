<?php

namespace Webup\LaravelBlog\Entities\Interfaces;


interface UserInterface
{
    public function unauthenticatedRedirectRoute();
    public function getPictureUrlAttribute();
    public function getIsAdminAttribute();
    public function getLangAttribute();
    public function getNameAttribute();
}
