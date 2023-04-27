<?php

use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\API\Controllers\SkeletonController;
use Illuminate\Support\Facades\Route;

Route::get('/skeletons', [SkeletonController::class, 'index']);
Route::get('/skeletons/{slug}', [SkeletonController::class, 'showBySlug']);
