<?php


if (!function_exists('env')) {
    /**
     * Get Environment variables.
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    function env($key, $default = '')
    {
        $value = getenv($key);

        throw_when(!$value and !$default, "{$key} is not a defined .env variable and has not default value");

        return $value or $default;
    }
}

if (!function_exists('base_path')) {
    /**
     * Return the base path
     *
     * @param string $path
     * @return string
     */
    function base_path($path = '')
    {
        return __DIR__."/../{$path}";
    }
}

if (!function_exists('config_path')) {
    /**
     * Return the config folder path
     *
     * @param string $path
     * @return string
     */
    function config_path($path = '')
    {
        return base_path("config/{$path}");
    }
}

if (!function_exists('resource_path')) {
    /**
     * Return the resources folder path
     *
     * @param string $path
     * @return string
     */
    function resource_path($path = '')
    {
        return base_path("resources/{$path}");
    }
}

if (!function_exists('views_path')) {
    /**
     * Return the views folder path
     *
     * @param string $path
     * @return string
     */
    function views_path($path = '')
    {
        return base_path("resources/views/{$path}");
    }
}

if (!function_exists('public_path')) {
    /**
     * Return the public folder path
     *
     * @param string $path
     * @return string
     */
    function public_path($path = '')
    {
        return base_path("public/{$path}");
    }
}

if (!function_exists('throw_when')) {
    /**
     * Throw a custom exception error.
     *
     * @param boolean $fails
     * @param string $message
     * @param string $exception
     * @return \Exception
     */
    function throw_when(bool $fails, string $message, string $exception = Exception::class)
    {
        if (!$fails) {
            return;
        }

        throw new $exception($message);
    }
}

if (!function_exists('dd')) {
    /**
     * Debug function for Die and Dump
     *
     * @return void
     */
    function dd()
    {
        array_map(function ($content) {
            echo '<pre>';
            var_dump($content);
            echo '</pre>';
            echo '<hr>';
        }, func_get_args());

        die;
    }
}
