<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            ...$this->registerMenuFromPackages(), // Remove this, if you don't need
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    public function registerMenuFromPackages(): array
    {
        $menus = [
            Menu::make()->title(__('Modules')),
        ];

        foreach (config('admin-kit.packages') as $package) {
            $instance = $package['instance'] ?? null;
            if (isset($instance)
                && defined("$instance::NAME")
                && defined("$instance::ICON")
                && defined("$instance::ROUTE_LIST")
            ) {
                $menus[] = Menu::make(__($instance::NAME))
                    ->icon($instance::ICON)
                    ->route($instance::ROUTE_LIST);
            }
        }

        return $menus;
    }
}
