<?php

declare(strict_types=1);

namespace AdminKit\Core\Ship\Providers;

use AdminKit\Core\Ship\Abstracts\Providers\AbstractMiddlewareServiceProvider;
use AdminKit\Core\Ship\Middlewares\ForceJsonApiResponse;
use AdminKit\Core\Ship\Middlewares\SetLocaleFromAcceptLanguageHeader;

class MiddlewareServiceProvider extends AbstractMiddlewareServiceProvider
{
    protected array $middlewares = [
        ForceJsonApiResponse::class,
    ];

    protected array $middlewareGroups = [
        'api' => [
            SetLocaleFromAcceptLanguageHeader::class,
        ],
    ];

    protected array $middlewarePriority = [];

    protected array $routeMiddleware = [];
}
