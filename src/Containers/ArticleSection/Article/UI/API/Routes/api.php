<?php

use AdminKit\Core\Containers\ArticleSection\Article\UI\API\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{slug}', [ArticleController::class, 'showBySlug']);
