<?php

namespace AdminKit\Core\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
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
class AdminUser extends Authenticatable
{
    protected string $guard = 'admin-kit';

    //    public function roles(): BelongsToMany
    //    {
    //        return $this->belongsToMany(Role::class, 'admin_role_has_users', 'user_id', 'role_id');
    //    }
}
