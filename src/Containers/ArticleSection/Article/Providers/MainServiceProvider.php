<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Providers;

use AdminKit\Core\Containers\ArticleSection\Article\Repositories\ArticleInterface;
use AdminKit\Core\Containers\ArticleSection\Article\Repositories\ArticleRepository;
use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;

class MainServiceProvider extends AbstractMainServiceProvider
{
    public array $serviceProviders = [
        RouteServiceProvider::class,
        FilamentServiceProvider::class,
    ];

    public function register(): void
    {
        $this->app->bind(ArticleInterface::class, ArticleRepository::class);

        parent::register();
    }
}
