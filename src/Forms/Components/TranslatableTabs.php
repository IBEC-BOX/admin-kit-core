<?php

declare(strict_types=1);

namespace AdminKit\Core\Forms\Components;

use AdminKit\Core\Facades\AdminKit;
use Filament\Forms\Components\Tabs;

/**
 * @template Locale of string
 */
class TranslatableTabs
{
    /**
     * @param callable(Locale): array $callback
     * @return Tabs
     */
    public static function make(callable $callback): Tabs
    {
        return Tabs::make('Translatable')->tabs(array_map($callback, AdminKit::locales()));
    }
}
