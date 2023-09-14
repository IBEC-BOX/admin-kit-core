<?php

namespace AdminKit\Core\Providers;

use Filament\Panel;
use Filament\PanelProvider;

class FilamentServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin-kit')
            ->path(config('admin-kit.panel.path'))
            ->login()
            ->colors(config('admin-kit.panel.colors'))
            ->resources(config('admin-kit.panel.resources'))
            ->pages(config('admin-kit.panel.pages'))
            ->widgets(config('admin-kit.panel.widgets'))
            ->middleware(config('admin-kit.panel.middleware'))
            ->authMiddleware(config('admin-kit.panel.authMiddleware'))
            ->discoverPages(
                config('admin-kit.panel.discover_pages.in'),
                config('admin-kit.panel.discover_pages.for')
            )
            ->discoverResources(
                config('admin-kit.panel.discover_resources.in'),
                config('admin-kit.panel.discover_resources.for')
            )
            ->discoverWidgets(
                config('admin-kit.panel.discover_widgets.in'),
                config('admin-kit.panel.discover_widgets.for')
            )
            ->domain(config('admin-kit.panel.domain'))
            ->authGuard(config('admin-kit.panel.auth_guard'))
            ->homeUrl(config('admin-kit.panel.home_url'))
            ->brandName(config('admin-kit.panel.brand_name'));
    }
}
