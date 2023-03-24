<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Providers;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformServiceProvider extends OrchidServiceProvider
{
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__(Article::NAME_PLURAL))
                ->title(__(Article::NAME_PLURAL))
                ->icon(Article::ICON)
                ->route(Article::ROUTE_LIST)
                ->permission(Article::PERMISSION_READ),
        ];
    }

    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__(Article::NAME_PLURAL))
                ->addPermission(Article::PERMISSION_CREATE, __('Create'))
                ->addPermission(Article::PERMISSION_READ, __('Read'))
                ->addPermission(Article::PERMISSION_UPDATE, __('Update'))
                ->addPermission(Article::PERMISSION_DELETE, __('Delete')),
        ];
    }
}
