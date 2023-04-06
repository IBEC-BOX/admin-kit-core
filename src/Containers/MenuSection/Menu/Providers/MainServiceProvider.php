<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Providers;

class MainServiceProvider extends \AdminKit\Porto\Abstracts\Providers\MainServiceProvider
{
    public array $serviceProviders = [
        PlatformServiceProvider::class,
    ];

    public function register(): void
    {

        parent::register();
    }
}
