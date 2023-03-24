<?php

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Screens\ArticleEditScreen;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Screens\ArticleListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('/articles')->group(function () {
    Route::screen('/', ArticleListScreen::class)
        ->name(Article::ROUTE_LIST)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__(Article::NAME_PLURAL), route(Article::ROUTE_LIST));
        });
    Route::screen('/create', ArticleEditScreen::class)
        ->name(Article::ROUTE_CREATE)
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent(Article::ROUTE_LIST)
                ->push(__('Create'), route(Article::ROUTE_CREATE));
        });
    Route::screen('/{item}/edit', ArticleEditScreen::class)
        ->name(Article::ROUTE_EDIT)
        ->breadcrumbs(function (Trail $trail, $item) {
            return $trail
                ->parent(Article::ROUTE_LIST)
                ->push(__('Edit'), route(Article::ROUTE_EDIT, $item));
        });
});
