<?php

declare(strict_types=1);

namespace AdminKit\Core\Ship\Providers;

use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;

class ShipProvider extends AbstractMainServiceProvider
{
    protected array $serviceProviders = [
        MiddlewareServiceProvider::class,
    ];
}
