<?php

namespace AdminKit\Core;

use AdminKit\Core\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin-kit.php', 'admin-kit');
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/admin-kit.php' => config_path('admin-kit.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'migrations');
        }
    }
}
