<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Providers;

use AdminKit\Core\Containers\ArticleSection\Article\UI\API\Repositories\ArticleInterface;
use AdminKit\Core\Containers\ArticleSection\Article\UI\API\Repositories\ArticleRepository;

class MainServiceProvider extends \AdminKit\Porto\Abstracts\Providers\MainServiceProvider
{
    public array $serviceProviders = [
        PlatformServiceProvider::class,
    ];

    public function register(): void
    {
        $this->app->bind(ArticleInterface::class, ArticleRepository::class);

        parent::register();
    }
}
