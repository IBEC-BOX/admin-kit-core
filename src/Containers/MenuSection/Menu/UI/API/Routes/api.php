<?php

use AdminKit\Core\Containers\MenuSection\Menu\UI\API\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/menus', [MenuController::class, 'index']);

