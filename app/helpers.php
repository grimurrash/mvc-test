<?php

if (!function_exists('app_path')) {
    function app_path($path = null): string
    {
        if ($path && substr($path, 0, 1) != DIRECTORY_SEPARATOR) {
            $path = DIRECTORY_SEPARATOR . $path;
        }

        return DOCROOT . 'app' . $path;
    }
}

if (!function_exists('base_path')) {
    function base_path($path = null): string
    {
        if ($path && substr($path, 0, 1) != DIRECTORY_SEPARATOR) {
            $path = DIRECTORY_SEPARATOR . $path;
        }

        return substr(DOCROOT, 0, -1) . $path;
    }
}

if (!function_exists('env')) {
    function env($key, $def = null)
    {
        return App\Core\Env::get($key, $def);
    }
}

if (!function_exists('config')) {
    function config(string $path, $default = null)
    {
        return App\Core\Config::get($path, $default);
    }
}