<?php

if (!function_exists('current_blog_route')) {
    /**
     * Handle CSS class for current route
     *
     * @param string  $routeName  Current route name for the page
     * @param string  $cssClass  CSS class for current state (default is current)
     * @return string  Current class if match, else empty string
     */
    function current_blog_route($routeName, $cssClass = 'current')
    {
        $currentRoute = app('router')->current()->getName();
        $rootPath = substr($currentRoute, 0, strlen($routeName));

        return ($rootPath == $routeName) ? $cssClass : '';
    }
}
