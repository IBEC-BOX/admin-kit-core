<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Providers;

class MainServiceProvider extends \AdminKit\Porto\Abstracts\Providers\MainServiceProvider
{
    public array $serviceProviders = [
        PlatformServiceProvider::class,
    ];
}
