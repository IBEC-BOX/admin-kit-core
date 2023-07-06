<?php

namespace AdminKit\Core\Models;

use AdminKit\Core\Traits\CyrillicChars;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class AdminKitUser extends Authenticatable
{
    use HasRoles;
    use CyrillicChars;

    /**
     * Он тут нужен?
     * И без него работает guard, указанный в config('auth.providers.admin_users')
     */
    protected string $guard = 'admin-kit-web';
}
