<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\Role\Providers;

use Orchid\Platform\Dashboard;

class MainServiceProvider extends \AdminKit\Porto\Abstracts\Providers\MainServiceProvider
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
