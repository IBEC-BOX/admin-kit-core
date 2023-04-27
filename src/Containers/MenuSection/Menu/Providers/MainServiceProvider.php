<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Providers;

use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;

class MainServiceProvider extends AbstractMainServiceProvider
{
    public array $serviceProviders = [
        PlatformServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();
    }
}
