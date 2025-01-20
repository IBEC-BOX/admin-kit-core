<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return trans('admin-kit::user.resource.title.create');
    }

    public function getRedirectUrl(): string
    {
        return UserResource::getUrl();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (config('admin-kit.user.password.expiry.enabled')) {
            $data['password_expires_at'] = Carbon::now()->addDays(config('admin-kit.user.password.expiry.days'));
        }

        return $data;
    }
}
