<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getTitle(): string
    {
        return trans('admin-kit::user.resource.title.create');
    }

    protected function getRedirectUrl(): string
    {
        return UserResource::getUrl();
    }
}
