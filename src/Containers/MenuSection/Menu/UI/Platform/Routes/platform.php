<?php

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens\MenuCreateScreen;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens\MenuEditScreen;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens\MenuListScreen;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens\RootMenuEditScreen;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens\RootMenuListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('/menus')->group(function () {
    Route::screen('/', RootMenuListScreen::class)
        ->name(Menu::ROUTE_ROOT_LIST)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__(Menu::NAME_PLURAL), route(Menu::ROUTE_ROOT_LIST));
        });
    Route::screen('/create', RootMenuEditScreen::class)
        ->name(Menu::ROUTE_ROOT_CREATE)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent(Menu::ROUTE_ROOT_LIST)
                ->push(__('Create'), route(Menu::ROUTE_ROOT_CREATE));
        });
    Route::screen('/{item}/edit', RootMenuEditScreen::class)
        ->name(Menu::ROUTE_ROOT_EDIT)
        ->breadcrumbs(function (Trail $trail, $item) {
            return $trail
                ->parent(Menu::ROUTE_ROOT_LIST)
                ->push($item->title, route(Menu::ROUTE_ROOT_EDIT, $item));
        });

    Route::prefix('/{root}/records')->group(function () {
        Route::screen('/', MenuListScreen::class)
            ->name(Menu::ROUTE_CHILD_LIST)
            ->breadcrumbs(function (Trail $trail, $root) {
                return $trail
                    ->parent(Menu::ROUTE_ROOT_EDIT, $root)
                    ->push(__(Menu::RECORD_NAME_PLURAL), route(Menu::ROUTE_CHILD_LIST, ['root' => $root]));
            });
        Route::screen('/create', MenuCreateScreen::class)
            ->name(Menu::ROUTE_CHILD_CREATE)
            ->breadcrumbs(function (Trail $trail, $root) {
                return $trail
                    ->parent(Menu::ROUTE_CHILD_LIST, $root)
                    ->push(__('Create'), route(Menu::ROUTE_CHILD_CREATE, ['root' => $root]));
            });
        Route::screen('/{item}/edit', MenuEditScreen::class)
            ->name(Menu::ROUTE_CHILD_EDIT)
            ->breadcrumbs(function (Trail $trail, $root, $item) {
                return $trail
                    ->parent(Menu::ROUTE_CHILD_LIST, $root)
                    ->push(__('Edit'), route(Menu::ROUTE_CHILD_EDIT, ['root' => $root, 'item' => $item]));
            });
    });
});
