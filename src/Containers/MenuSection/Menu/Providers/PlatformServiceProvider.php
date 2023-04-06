<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Providers;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu as OrchidMenu;

class PlatformServiceProvider extends OrchidServiceProvider
{
    public function registerMainMenu(): array
    {
        return [
            OrchidMenu::make(__(Menu::NAME_PLURAL))
                ->title(__(Menu::NAME_PLURAL))
                ->icon(Menu::ICON)
                ->route(Menu::ROUTE_ROOT_LIST)
                ->permission(Menu::PERMISSION_READ),
        ];
    }

    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__(Menu::NAME_PLURAL))
                ->addPermission(Menu::PERMISSION_CREATE, __('Create'))
                ->addPermission(Menu::PERMISSION_READ, __('Read'))
                ->addPermission(Menu::PERMISSION_UPDATE, __('Update'))
                ->addPermission(Menu::PERMISSION_DELETE, __('Delete')),
        ];
    }
}
