<?php

declare(strict_types=1);

namespace AdminKit\Core\Providers;

use Filament\PluginServiceProvider;
use AdminKit\Core\UI\Filament\Resources\UserResource;

class FilamentServiceProvider extends PluginServiceProvider
{
    public static string $name = 'users';

    protected array $resources = [
        UserResource::class,
    ];
}
