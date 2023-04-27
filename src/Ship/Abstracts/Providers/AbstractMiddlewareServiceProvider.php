<?php

namespace AdminKit\Core\Ship\Parents\Providers;

use AdminKit\Porto\Abstracts\Providers\MiddlewareServiceProvider as AbstractMiddlewareServiceProvider;

abstract class AbstractMiddlewareServiceProvider extends AbstractMiddlewareServiceProvider
{
    protected array $middlewares = [];

    protected array $middlewareGroups = [];

    protected array $middlewarePriority = [];

    protected array $routeMiddleware = [];
}
