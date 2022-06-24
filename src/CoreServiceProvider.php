<?php

namespace AdminKit\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'admin-kit');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('admin-kit.php'),
        ], 'config');

    }
    }
}
