<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Providers;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Ship\Abstracts\Providers\AbstractPlatformServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Screen\Actions\Menu;

class PlatformServiceProvider extends AbstractPlatformServiceProvider
{
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__(Skeleton::NAME_PLURAL))
                ->title(__(Skeleton::NAME_PLURAL))
                ->icon(Skeleton::ICON)
                ->route(Skeleton::ROUTE_LIST)
                ->permission(Skeleton::PERMISSION_READ),
        ];
    }

    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__(Skeleton::NAME_PLURAL))
                ->addPermission(Skeleton::PERMISSION_CREATE, __('Create'))
                ->addPermission(Skeleton::PERMISSION_READ, __('Read'))
                ->addPermission(Skeleton::PERMISSION_UPDATE, __('Update'))
                ->addPermission(Skeleton::PERMISSION_DELETE, __('Delete')),
        ];
    }
}
