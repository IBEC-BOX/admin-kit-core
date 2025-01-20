<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use AdminKit\Core\UI\Filament\Resources\UserResource;
use Carbon\Carbon;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $model = config('admin-kit.user.model');
        $user = $model::where('email', $data['email'])->first();
        if (! $user) {
            return $data;
        }

        if (config('admin-kit.user.password.expiry.enabled')) {
            $data = $this->setPasswordExpiry($data);
        }

        if (config('admin-kit.user.password.history.enabled')) {
            $data = $this->setPasswordHistory($data, $user);
        }

        if (empty($data['password'])) {
            $data['password'] = $user->password;
        }

        return $data;
    }

    public function getTitle(): string
    {
        return trans('admin-kit::user.resource.title.edit');
    }

    private function setPasswordExpiry(array $data): array
    {
        $days = config('admin-kit.user.password.expiry.days');
        $data['password_expires_at'] = Carbon::now()->addDays($days);

        return $data;
    }

    private function setPasswordHistory(array $data, User $user): array
    {
        if (empty($data['password'])) {
            return $data;
        }

        foreach ($user->password_history as $passwordHash) {
            if (Hash::check($data['password'], $passwordHash)) {
                throw new \Exception('password is already set in history');
            }
        }

        $history = [...$user->password_history, $user->password];
        $count = config('admin-kit.user.password.history.count');
        $data['password_history'] = array_slice($history, -$count);

        return $data;
    }
}
