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
     * @param  callable(Locale): array  $callback
     */
    public static function make(callable $callback): Tabs
    {
        if (gettype($callback(app()->getLocale())) === 'array') {
            $tabs = array_map(fn ($locale) => Tabs\Tab::make($locale)->schema($callback($locale)), AdminKit::locales());

            return Tabs::make('Translatable')->tabs($tabs);
        }

        return Tabs::make('Translatable')->tabs(array_map($callback, AdminKit::locales()));
    }
}
