<?php

namespace AdminKit\Core\Containers\UserSection\User\Models;

use AdminKit\Core\Containers\UserSection\Role\Models\Role;
use AdminKit\Core\Containers\UserSection\User\UI\Platform\Presenters\AdminUserPresenter;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
class AdminUser extends \Orchid\Platform\Models\User
{
    /**
     * Table name
     */
    protected $table = 'admin_users';

    /**
     * Model guard
     */
    protected $guard = 'admin-kit';

    /**
     * @return AdminUserPresenter
     */
    public function presenter()
    {
        return new AdminUserPresenter($this);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'admin_role_has_users', 'user_id', 'role_id');
    }
}
