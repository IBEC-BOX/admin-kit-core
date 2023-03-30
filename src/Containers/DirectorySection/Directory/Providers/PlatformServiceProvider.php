<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\Providers;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformServiceProvider extends OrchidServiceProvider
{
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__(Directory::NAME_PLURAL))
                ->title(__(Directory::NAME_PLURAL))
                ->icon(Directory::ICON)
                ->route(Directory::ROUTE_ROOT_LIST)
                ->permission(Directory::PERMISSION_READ),
        ];
    }

    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__(Directory::NAME_PLURAL))
                ->addPermission(Directory::PERMISSION_CREATE, __('Create'))
                ->addPermission(Directory::PERMISSION_READ, __('Read'))
                ->addPermission(Directory::PERMISSION_UPDATE, __('Update'))
                ->addPermission(Directory::PERMISSION_DELETE, __('Delete')),
        ];
    }
}
