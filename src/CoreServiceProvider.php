<?php

namespace AdminKit\Core;

use AdminKit\Core\Commands\InstallCommand;
use AdminKit\Core\Providers\MiddlewareServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('admin-kit')
            ->hasConfigFile()
            ->hasMigration('create_admin_kit_users_table')
            ->hasCommand(InstallCommand::class);
    }

    public function registeringPackage()
    {
        $this->registerAuthConfigs();

        $this->app->register(MiddlewareServiceProvider::class);
    }

    public function bootingPackage(): void
    {
        $this->publishStubs();
    }

    protected function registerAuthConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__.'/../config/auth_guards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__.'/../config/auth_providers.php', 'auth.providers');

        return $this;
    }

    protected function publishStubs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/app/AdminKitUser.stub' => app_path('Models/AdminKitUser.php'),
            ], 'admin-kit-stubs');
        }

        return $this;
    }
}
