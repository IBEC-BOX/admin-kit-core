<?php

namespace AdminKit\Core;

use AdminKit\Core\Console\InstallCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'admin-kit');
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    public function boot()
    {
        Route::domain((string)config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->middleware(config('platform.middleware.private'))
            ->group(__DIR__ . '/../routes/platform.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('admin-kit.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../stubs/app/routes/' => base_path('routes'),
                __DIR__ . '/../stubs/app/Orchid/' => app_path('Orchid'),
            ], 'stubs');
        }
    }
}
