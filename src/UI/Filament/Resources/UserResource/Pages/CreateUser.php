<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    use UserPageTrait;

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
        $hashedPassword   = Hash::make($data['password']);
        $data             = $this->setPasswordExpiry($data);
        $data             = $this->setPasswordHistory($data, $hashedPassword);
        $data['password'] = $hashedPassword;

        return $data;
    }
}
