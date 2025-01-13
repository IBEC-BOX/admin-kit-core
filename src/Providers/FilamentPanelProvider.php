<?php

namespace AdminKit\Core\Providers;

use App\Models\AdminKitUser;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Contracts\Auth\Authenticatable;

// use Livewire\LivewireServiceProvider;

class FilamentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $plugins = $this->getPlugins();

        return $panel
            ->default()
            ->id('admin-kit')
            ->path(config('admin-kit.panel.path'))
            ->login()
            ->colors(config('admin-kit.panel.colors'))
            ->navigationGroups(config('admin-kit.panel.navigation_groups', []))
            ->navigationItems(config('admin-kit.panel.navigation_items', []))
            ->resources(config('admin-kit.panel.resources'))
            ->pages(config('admin-kit.panel.pages'))
            ->widgets(config('admin-kit.panel.widgets'))
            ->plugins($plugins)
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
            ->brandName(config('admin-kit.panel.brand_name'))
            ->databaseNotifications(config('admin-kit.panel.notifications.enabled', false))
            ->databaseNotificationsPolling(config('admin-kit.panel.notifications.polling', '30s'));
    }

    /**
     * @throws \ReflectionException
     */
    private function getPlugins(): array
    {
        $pluginsClasses = config('admin-kit.panel.plugins');
        $plugins = [];

        foreach ($pluginsClasses as $pluginsClass) {
            $reflect = new \ReflectionClass($pluginsClass);

            $plugins[] = $reflect->hasMethod('make')
                ? $pluginsClass::make()
                : new $pluginsClass;
        }

        return $plugins;
    }

    public function register(): void
    {
        parent::register();

        // for correct working Filament Importer/Exporter
        if (class_exists(AdminKitUser::class)) {
            $this->app->bind(Authenticatable::class, AdminKitUser::class);
        }
    }
}
