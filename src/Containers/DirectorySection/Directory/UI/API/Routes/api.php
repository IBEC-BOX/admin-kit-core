<?php

use AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;

if (config('admin-kit.directories.enable_routes')) {
    Route::get('/directories', [DirectoryController::class, 'index']);
    Route::get('/directories/{slug}', [DirectoryController::class, 'listBySlug']);
}
