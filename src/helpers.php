<?php

if (!function_exists('is_dev')) {
    function is_dev(): bool
    {
        $isProd = app()->environment(['production']);
        $isDevMode = request()->header('Develop-Mode') == 1;

        return !$isProd && $isDevMode;
    }
}
