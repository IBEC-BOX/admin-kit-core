<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\User\Providers;

use AdminKit\Core\Ship\Abstracts\Providers\AbstractMainServiceProvider;
use Orchid\Platform\Dashboard;

class MainServiceProvider extends AbstractMainServiceProvider
{
    public function boot(): void
    {
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \AdminKit\Core\Containers\UserSection\User\Models\AdminUser::class
        );

        parent::boot();
    }
}
