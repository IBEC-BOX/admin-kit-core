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
            ->publishAssets()
            ->publishConfigs()
            ->publishMigrations()
            ->bindUserModel();
    }

    protected function registerCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        return $this;
    }

    protected function registerMacros(): self
    {
        TD::macro('bool', function () {
            /** @var TD $this */
            $column = $this->column; /** @phpstan-ignore-line */
            $this->render(function ($datum) use ($column) {
                return view('admin-kit::partials.bool', [
                    'bool' => $datum->$column,
                ]);
            });

            return $this;
        });

        return $this;
    }

    protected function registerConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__."/../config/$this->name.php", $this->name);
        $this->mergeConfigFrom(__DIR__.'/../config/auth_guards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__.'/../config/auth_providers.php', 'auth.providers');

        return $this;
    }

    protected function addRoutes(): self
    {
        Route::domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->middleware(config('platform.middleware.private'))
            ->group(__DIR__.'/../routes/platform.php');

        return $this;
    }

    protected function addViews(): self
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->name);

        return $this;
    }

    protected function publishConfigs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__."/../config/$this->name.php" => config_path("$this->name.php"),
                __DIR__.'/../config/platform.php' => config_path('platform.php'),
            ], "$this->name-config");
        }

        return $this;
    }

    protected function publishStubs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/app/routes/' => base_path('routes'),
                __DIR__.'/../stubs/app/Orchid/' => app_path('Orchid'),
                __DIR__.'/../stubs/app/AdminUser.stub' => app_path('Models/AdminUser.php'),
            ], "$this->name-stubs");
        }

        return $this;
    }

    protected function publishMigrations(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], "$this->name-migrations");
        }

        return $this;
    }

    protected function publishAssets(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../public' => public_path("vendor/$this->name"),
            ], ["$this->name-assets", 'laravel-assets']);
        }

        return $this;
    }

    protected function bindUserModel(): self
    {
        Dashboard::useModel(\Orchid\Platform\Models\User::class, \AdminKit\Core\Models\AdminUser::class);

        return $this;
    }
}
