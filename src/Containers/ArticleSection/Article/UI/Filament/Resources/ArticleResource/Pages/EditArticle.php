<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources\ArticleResource\Pages;

use AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
