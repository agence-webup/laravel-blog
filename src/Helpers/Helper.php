<?php

namespace Webup\LaravelBlog\Helpers;

class Helper
{
    public static function current_blog_route($routeName, $cssClass = 'current')
    {
        $currentRoute = app('router')->current()->getName();
        $rootPath = substr($currentRoute, 0, strlen($routeName));

        return ($rootPath == $routeName) ? $cssClass : '';
    }
}
