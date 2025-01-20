<?php

namespace AdminKit\Core;

use AdminKit\Core\Commands\ClonePackageCommand;
use AdminKit\Core\Commands\InstallCommand;
use AdminKit\Core\Commands\InstallPackagesCommand;
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
            ->hasMigrations([
                'create_admin_kit_users_table',
                'create_admin_kit_password_histories_table',
            ])
            ->hasTranslations()
            ->hasRoute('api')
            ->hasCommands([
                InstallCommand::class,
                ClonePackageCommand::class,
                InstallPackagesCommand::class,
            ]);
    }

    public function registeringPackage()
    {
        $this->registerHelperFile();

        $this->registerConfigs();

        $this->registerPanelProvider();

        $this->app->register(MiddlewareServiceProvider::class);

        $this->configureTimezoneForFilament();
    }

    public function bootingPackage(): void
    {
        $this->publishFiles();
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
                __DIR__.'/../stubs/app/AdminKitUser.stub' => app_path('Models/AdminKitUser.php'),
                __DIR__.'/../stubs/config/filament-shield.php' => config_path('filament-shield.php'),
            ], 'admin-kit-stubs');
        }

        return $this;
    }

    protected function configureTimezoneForFilament(): void
    {
        DateTimePicker::configureUsing(fn (DateTimePicker $component) => $component->timezone(config('admin-kit.timezone')));
        TextColumn::configureUsing(fn (TextColumn $column) => $column->timezone(config('admin-kit.timezone')));
    }

    protected function registerHelperFile(): void
    {
        require_once __DIR__.'/helpers.php';
    }

    protected function registerPanelProvider(): void
    {
        $panelProvider = config('admin-kit.panel.provider', \AdminKit\Core\Providers\FilamentPanelProvider::class);

        $this->app->register($panelProvider);
    }
}
