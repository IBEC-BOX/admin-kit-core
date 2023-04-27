<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\Providers;

use AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Repositories\DirectoryInterface;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Repositories\DirectoryRepository;
use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;

class MainServiceProvider extends AbstractMainServiceProvider
{
    public array $serviceProviders = [
        PlatformServiceProvider::class,
    ];

    public function register(): void
    {
        $this->app->bind(DirectoryInterface::class, DirectoryRepository::class);

        parent::register();
    }
}
