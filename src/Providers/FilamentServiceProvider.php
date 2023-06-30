<?php

declare(strict_types=1);

namespace AdminKit\Core\Providers;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Filament\PluginServiceProvider;

class FilamentServiceProvider extends PluginServiceProvider
{
    public static string $name = 'users';

    protected array $resources = [
        UserResource::class,
    ];
}
