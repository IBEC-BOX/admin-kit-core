<?php

use Illuminate\Support\Facades\Route;

/**
 * Routes for CKFinder
 */
Route::group(['middleware' => 'customCkfinderAuth'], function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');

    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
});
