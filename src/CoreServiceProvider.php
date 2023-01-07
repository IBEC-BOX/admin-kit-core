<?php

namespace AdminKit\Core;

use AdminKit\Core\Commands\InstallCommand;
use Illuminate\Support\Facades\Route;
use Orchid\Platform\Dashboard;
use Orchid\Screen\TD;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('core')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(InstallCommand::class);
    }

    public function registeringPackage()
    {
        TD::macro('bool', function () {
            $column = $this->column;
            $this->render(function ($datum) use ($column) {
                return view('admin-kit::bool', [
                    'bool' => $datum->$column,
                ]);
            });

            return $this;
        });
    }

    public function bootingPackage()
    {
        Route::domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->middleware(config('platform.middleware.private'))
            ->group(__DIR__.'/../routes/platform.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/app/routes/' => base_path('routes'),
                __DIR__.'/../stubs/app/Orchid/' => app_path('Orchid'),
            ], 'core-stubs');
        }
    }
}
