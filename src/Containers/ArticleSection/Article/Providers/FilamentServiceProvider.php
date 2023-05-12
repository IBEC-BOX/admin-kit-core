<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Providers;

use AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources\ArticleResource;
use AdminKit\Core\Ship\Abstracts\Providers\AbstractFilamentServiceProvider;

class FilamentServiceProvider extends AbstractFilamentServiceProvider
{
    public static string $name = 'article';

    protected array $resources = [
        ArticleResource::class,
    ];
}
