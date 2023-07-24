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

    public function mapLocales(callable $callback): array
    {
        return collect($this->locales())->map($callback)->toArray();
    }

    public function mapLocalesWithKeys(callable $callback): array
    {
        return collect($this->locales())->mapWithKeys($callback)->toArray();
    }
}
