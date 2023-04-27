<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\Role\Providers;

use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;
use Orchid\Platform\Dashboard;

class MainServiceProvider extends AbstractMainServiceProvider
{
    public function boot(): void
    {
        Dashboard::useModel(
            \Orchid\Platform\Models\Role::class,
            \AdminKit\Core\Containers\UserSection\Role\Models\Role::class
        );

        parent::boot();
    }
}
