<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return trans('admin-kit::user.resource.title.list');
    }
}
