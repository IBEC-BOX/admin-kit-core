<?php

namespace AdminKit\Core\UI\Filament\Resources\UserResource\Pages;

use Carbon\Carbon;

trait UserPageTrait
{
    protected function setPasswordExpiry(array $data): array
    {
        if (! config('admin-kit.user.password.expiry.enabled')) {
            return $data;
        }

        if (empty($data['password'])) {
            return $data;
        }

        $days = config('admin-kit.user.password.expiry.days');

        $data['password_expires_at'] = Carbon::now()->addDays($days);

        return $data;
    }

    protected function setPasswordHistory(array $data, string $hashedPassword, array $passwordHistory = []): array
    {
        if (! config('admin-kit.user.password.history.enabled')) {
            return $data;
        }

        if (empty($data['password'])) {
            return $data;
        }

        $count = config('admin-kit.user.password.history.count');

        $passwordHistory[] = $hashedPassword;

        $data['password_history'] = array_slice($passwordHistory, -$count);

        return $data;
    }
}
