<?php

namespace AdminKit\Core;

use AdminKit\Core\Ship\Commands\InstallCommand;
use AdminKit\Core\Ship\Providers\ShipProvider;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    protected string $name = 'admin-kit';

    public function register(): void
    {
        $this
            ->registerCommands()
            ->registerConfigs()
            ->registerLocalizations()
            ->registerContainers();

        $this->app->register(ShipProvider::class);
    }

    public function boot(): void
    {
        $this
            ->publishStubs()
            ->publishConfigs();
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

    protected function registerConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__."/../config/$this->name.php", $this->name);
        $this->mergeConfigFrom(__DIR__.'/../config/auth_guards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__.'/../config/auth_providers.php', 'auth.providers');

        return $this;
    }

    protected function registerLocalizations(): self
    {
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');

        return $this;
    }

    protected function publishConfigs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__."/../config/$this->name.php" => config_path("$this->name.php"),
            ], "$this->name-config");
        }

        return $this;
    }

    protected function publishStubs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/app/AdminUser.stub' => app_path('Models/AdminUser.php'),
            ], "$this->name-stubs");
        }

        return $this;
    }

    protected function registerContainers(): self
    {
        foreach (config("$this->name.containers") as $container) {
            $this->app->register($container);
        }

        return $this;
    }
}
