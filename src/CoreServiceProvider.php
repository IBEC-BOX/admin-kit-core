<?php

namespace AdminKit\Core;

use AdminKit\Core\Commands\InstallCommand;
use AdminKit\Core\Providers\FilamentServiceProvider;
use AdminKit\Core\Providers\MiddlewareServiceProvider;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
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
            ->hasMigration('create_admin_kit_users_table')
            ->hasViews()
            ->hasAssets()
            ->hasTranslations()
            ->hasRoute('api')
            ->hasCommand(InstallCommand::class);
    }

    public function registeringPackage()
    {
        $this->registerConfigs();

        $this->app->register(FilamentServiceProvider::class);
        $this->app->register(MiddlewareServiceProvider::class);

        $this->configureTimezoneForFilament();
    }

    public function bootingPackage(): void
    {
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    protected function registerConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__.'/../config/admin-kit.php', 'admin-kit');
        $this->mergeConfigFrom(__DIR__.'/../config/auth_guards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__.'/../config/auth_providers.php', 'auth.providers');

        return $this;
    }

    protected function publishFiles(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/admin-kit.php' => config_path('admin-kit.php'),
                __DIR__.'/../config/ckfinder.php' => config_path('ckfinder.php'),
                __DIR__.'/../stubs/app/AdminKitUser.stub' => app_path('Models/AdminKitUser.php'),
                __DIR__.'/../stubs/config/filament-shield.php' => config_path('filament-shield.php'),
                __DIR__.'/../public/js' => public_path('js/'),
            ], 'admin-kit-stubs');
        }

        return $this;
    }

    protected function configureTimezoneForFilament(): void
    {
        DateTimePicker::configureUsing(fn (DateTimePicker $component) => $component->timezone(config('admin-kit.timezone')));
        TextColumn::configureUsing(fn (TextColumn $column) => $column->timezone(config('admin-kit.timezone')));
    }
}
