<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
