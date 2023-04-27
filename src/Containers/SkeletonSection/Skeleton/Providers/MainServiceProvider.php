<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Providers;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Repositories\SkeletonInterface;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\Repositories\SkeletonRepository;
use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;

class MainServiceProvider extends AbstractMainServiceProvider
{
    public array $serviceProviders = [
        PlatformServiceProvider::class,
    ];

    public function register(): void
    {
        $this->app->bind(SkeletonInterface::class, SkeletonRepository::class);

        parent::register();
    }
}
