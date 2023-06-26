<?php

declare(strict_types=1);

namespace AdminKit\Core\Providers;

use AdminKit\Core\Middlewares\ForceJsonApiResponse;
use AdminKit\Core\Middlewares\SetLocaleFromAcceptLanguageHeader;

class MiddlewareServiceProvider extends \AdminKit\Porto\Abstracts\MiddlewareServiceProvider
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
