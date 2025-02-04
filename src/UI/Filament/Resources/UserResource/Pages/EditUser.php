<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    use UserPageTrait;

    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $model = config('admin-kit.user.model');
        $user = $model::where('email', $data['email'])->first();
        if (! $user) {
            throw new \Exception("User with email {$data['email']} not found");
        }

        if (! empty($data['password'])) {
            $hashedPassword = Hash::make($data['password']);
            $data = $this->setPasswordExpiry($data);
            $data = $this->setPasswordHistory($data, $hashedPassword, $user->password_history ?? []);
            $data['password'] = $hashedPassword;
        } else {
            unset($data['password']);
        }

        return $data;
    }

    public function getTitle(): string
    {
        return trans('admin-kit::user.resource.title.edit');
    }
}
