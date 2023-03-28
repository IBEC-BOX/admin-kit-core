<?php

use AdminKit\Core\Containers\ArticleSection\Article\UI\API\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

if (config('admin-kit.articles.enable_routes')) {
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/articles/slug/{slug}', [ArticleController::class, 'showBySlug']);
}
