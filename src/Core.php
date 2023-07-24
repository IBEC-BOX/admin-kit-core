<?php

namespace AdminKit\Core;

class Core
{
    public function locales(): array
    {
        return config('admin-kit.locales');
    }

    public function timezone(): string
    {
        return config('admin-kit.timezone');
    }
}
