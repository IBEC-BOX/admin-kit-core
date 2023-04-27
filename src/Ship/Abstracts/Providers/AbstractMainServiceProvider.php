<?php

namespace AdminKit\Core\Ship\Abstracts\Providers;

use AdminKit\Porto\Abstracts\Providers\MainServiceProvider;

abstract class AbstractMainServiceProvider extends MainServiceProvider
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
