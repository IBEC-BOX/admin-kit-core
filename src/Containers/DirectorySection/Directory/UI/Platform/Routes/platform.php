<?php

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens\DirectoryCreateScreen;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens\DirectoryEditScreen;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens\DirectoryListScreen;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens\RootDirectoryEditScreen;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens\RootDirectoryListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('/directories')->group(function () {
    Route::screen('/', RootDirectoryListScreen::class)
        ->name(Directory::ROUTE_ROOT_LIST)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__(Directory::NAME_PLURAL), route(Directory::ROUTE_ROOT_LIST));
        });
    Route::screen('/create', RootDirectoryEditScreen::class)
        ->name(Directory::ROUTE_ROOT_CREATE)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent(Directory::ROUTE_ROOT_LIST)
                ->push(__('Create'), route(Directory::ROUTE_ROOT_CREATE));
        });
    Route::screen('/{item}/edit', RootDirectoryEditScreen::class)
        ->name(Directory::ROUTE_ROOT_EDIT)
        ->breadcrumbs(function (Trail $trail, $item) {
            return $trail
                ->parent(Directory::ROUTE_ROOT_LIST)
                ->push($item->name, route(Directory::ROUTE_ROOT_EDIT, $item));
        });

    Route::prefix('/{root}/records')->group(function () {
        Route::screen('/', DirectoryListScreen::class)
            ->name(Directory::ROUTE_CHILD_LIST)
            ->breadcrumbs(function (Trail $trail, $root) {
                return $trail
                    ->parent(Directory::ROUTE_ROOT_EDIT, $root)
                    ->push(__(Directory::RECORD_NAME_PLURAL), route(Directory::ROUTE_CHILD_LIST, ['root' => $root]));
            });
        Route::screen('/create', DirectoryCreateScreen::class)
            ->name(Directory::ROUTE_CHILD_CREATE)
            ->breadcrumbs(function (Trail $trail, $root) {
                return $trail
                    ->parent(Directory::ROUTE_CHILD_LIST, $root)
                    ->push(__('Create'), route(Directory::ROUTE_CHILD_CREATE, ['root' => $root]));
            });
        Route::screen('/{item}/edit', DirectoryEditScreen::class)
            ->name(Directory::ROUTE_CHILD_EDIT)
            ->breadcrumbs(function (Trail $trail, $root, $item) {
                return $trail
                    ->parent(Directory::ROUTE_CHILD_LIST, $root)
                    ->push(__('Edit'), route(Directory::ROUTE_CHILD_EDIT, ['root' => $root, 'item' => $item]));
            });
    });
});
