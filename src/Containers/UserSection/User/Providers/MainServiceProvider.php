<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\User\Providers;

use Orchid\Platform\Dashboard;

class MainServiceProvider extends \AdminKit\Porto\Abstracts\Providers\MainServiceProvider
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
