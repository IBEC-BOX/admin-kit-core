<?php

namespace AdminKit\Core\Models;

use AdminKit\Core\Presenters\UserPresenter;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property array $permissions
 */
class User extends \Orchid\Platform\Models\User
{
    /**
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }
}
