<?php

declare(strict_types=1);

namespace AdminKit\Core\Ship\Providers;

use AdminKit\Core\Ship\Facades\AdminKit;
use AdminKit\Porto\Loaders\PathsLoaderTrait;

class RouteServiceProvider extends \AdminKit\Porto\Abstracts\Providers\RouteServiceProvider
{
    use PathsLoaderTrait;

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this
            ->initPorto(AdminKit::srcPath())
            ->runRoutesAutoLoader();
    }
}
