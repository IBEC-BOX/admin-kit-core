<?php

namespace AdminKit\Core;

use AdminKit\Core\Commands\InstallCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Screen\TD;

class CoreServiceProvider extends ServiceProvider
{
    protected string $name = 'admin-kit';

    public function register()
    {
        $this
            ->registerCommands()
            ->registerMacros()
            ->registerConfigs();
    }

    public function boot()
    {
        $this
            ->addViews()
            ->addRoutes()
            ->publishStubs()
            ->publishConfigs();
    }

    private function registerCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        return $this;
    }

    private function registerMacros(): self
    {
        TD::macro('bool', function () {
            /** @var TD $this */
            $column = $this->column; /** @phpstan-ignore-line */
            $this->render(function ($datum) use ($column) {
                return view('admin-kit::bool', [
                    'bool' => $datum->$column
                ]);
            });

            return $this;
        });

        return $this;
    }

    private function registerConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/$this->name.php", $this->name);

        return $this;
    }

    private function addRoutes(): self
    {
        Route::domain((string)config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->middleware(config('platform.middleware.private'))
            ->group(__DIR__ . '/../routes/platform.php');

        return $this;
    }

    private function addViews(): self
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', $this->name);

        return $this;
    }

    private function publishConfigs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . "/../config/$this->name.php" => config_path("$this->name.php"),
                __DIR__ . "/../config/platform.php" => config_path("platform.php"),
            ], "$this->name-config");
        }

        return $this;
    }

    private function publishStubs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../stubs/app/routes/' => base_path('routes'),
                __DIR__ . '/../stubs/app/Orchid/' => app_path('Orchid'),
            ], "$this->name-stubs");
        }

        return $this;
    }
}
