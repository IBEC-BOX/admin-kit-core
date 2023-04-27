<?php

namespace AdminKit\Core\Ship\Parents\Providers;

use AdminKit\Porto\Abstracts\Providers\MainServiceProvider as AbstractMainServiceProvider;

abstract class AbstractMainServiceProvider extends AbstractMainServiceProvider
{
    public array $serviceProviders = [
        //
    ];

    public array $commands = [
        //
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
    }
}
