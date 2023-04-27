<?php

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Screens\SkeletonEditScreen;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Screens\SkeletonListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('/skeletons')->group(function () {
    Route::screen('/', SkeletonListScreen::class)
        ->name(Skeleton::ROUTE_LIST)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__(Skeleton::NAME_PLURAL), route(Skeleton::ROUTE_LIST));
        });
    Route::screen('/create', SkeletonEditScreen::class)
        ->name(Skeleton::ROUTE_CREATE)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent(Skeleton::ROUTE_LIST)
                ->push(__('Create'), route(Skeleton::ROUTE_CREATE));
        });
    Route::screen('/{item}/edit', SkeletonEditScreen::class)
        ->name(Skeleton::ROUTE_EDIT)
        ->breadcrumbs(function (Trail $trail, $item) {
            return $trail
                ->parent(Skeleton::ROUTE_LIST)
                ->push(__('Edit'), route(Skeleton::ROUTE_EDIT, $item));
        });
});
