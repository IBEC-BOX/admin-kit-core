<?php

namespace AdminKit\Core;

class Core
{
    public function locales()
    {
        return config('admin-kit.locales');
    }

    public function timezone()
    {
        return config('admin-kit.timezone');
    }
}
