<?php

if (!function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string       $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (!function_exists('isMultiWord')) {
    /**
     * Check if a value is multi-word.
     *
     * @param string $value The value to check.
     * @return bool Returns true if the value is multi-word, false otherwise.
     */
    function isMultiWord($value)
    {
        return strpos($value, ' ') !== false;
    }
}

if (!function_exists('curriencies')) {
    function curriencies() : array
    {
        $content = file_get_contents(__DIR__ . '/CURRENCIES');
        $lines = explode("\n", $content);

        return collect($lines)->mapWithKeys(function ($item) {
            return [strtolower(trim($item)) => $item];
        })->toArray();
    }
}
