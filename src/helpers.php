<?php

if (! function_exists('is_dev')) {
    function is_dev(): bool
    {
        $isProd = app()->environment(['production']);
        $isDevMode =
            request()->header('Develop-Mode') == 1
            || request('develop_mode') == 1
            || request('phone') == '71111111111';

        return ! $isProd && $isDevMode;
    }
}
