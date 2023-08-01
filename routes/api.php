<?php

use Illuminate\Support\Facades\Route;

Route::get('/api', fn() => response()->json([
    'name' => config('app.name'),
    'environment' => config('app.env'),
    'by' => config('admin-kit.developer'),
]));
