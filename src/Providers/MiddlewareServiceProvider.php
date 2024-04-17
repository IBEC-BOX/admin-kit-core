<?php

declare(strict_types=1);

namespace AdminKit\Core\Providers;

use AdminKit\Core\Middlewares\CheckAdminIpMiddleware;
use AdminKit\Core\Middlewares\ForceJsonApiResponse;
use AdminKit\Core\Middlewares\SetLocaleFromAcceptLanguageHeader;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    protected array $middlewares = [
        ForceJsonApiResponse::class,
    ];

    protected array $middlewareGroups = [
        'api' => [
            SetLocaleFromAcceptLanguageHeader::class,
        ],
        'web' => [
            CheckAdminIpMiddleware::class,
        ],
    ];

    protected array $middlewarePriority = [];

    protected array $routeMiddleware = [];

    public function boot(): void
    {
        $this->registerMiddleware($this->middlewares);
        $this->registerMiddlewareGroups($this->middlewareGroups);
        $this->registerMiddlewarePriority($this->middlewarePriority);
        $this->registerRouteMiddleware($this->routeMiddleware);
    }

    /**
     * Registering Route Group's
     *
     * @throws BindingResolutionException
     */
    private function registerMiddleware(array $middlewares = []): void
    {
        $httpKernel = $this->app->make(Kernel::class);

        foreach ($middlewares as $middleware) {
            $httpKernel->prependMiddleware($middleware);
        }
    }

    /**
     * Registering Route Group's
     */
    private function registerMiddlewareGroups(array $middlewareGroups = []): void
    {
        foreach ($middlewareGroups as $key => $middleware) {
            if (! is_array($middleware)) {
                $this->app->booted(fn () => $this->app['router']->pushMiddlewareToGroup($key, $middleware));
            } else {
                foreach ($middleware as $item) {
                    $this->app->booted(fn () => $this->app['router']->pushMiddlewareToGroup($key, $item));
                }
            }
        }
    }

    /**
     * Registering Route Middleware's priority
     */
    private function registerMiddlewarePriority(array $middlewarePriority = []): void
    {
        foreach ($middlewarePriority as $key => $middleware) {
            if (! in_array($middleware, $this->app['router']->middlewarePriority)) {
                $this->app['router']->middlewarePriority[] = $middleware;
            }
        }
    }

    /**
     * Registering Route Middleware's
     */
    private function registerRouteMiddleware(array $routeMiddleware = []): void
    {
        foreach ($routeMiddleware as $key => $value) {
            $this->app['router']->aliasMiddleware($key, $value);
        }
    }
}
