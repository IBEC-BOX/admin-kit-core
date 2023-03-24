<?php

use AdminKit\Core\Containers\ArticleSection\Article\UI\API\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/articles/{article}', [ArticleController::class, 'show']);
