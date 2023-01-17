<?php

namespace AdminKit\Core\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property array $permissions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Role extends \Orchid\Platform\Models\Role
{
    /**
     * Table name
     */
    protected $table = 'admin_roles';

    /**
     * The Users relationship.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(AdminUser::class, 'admin_role_has_users', 'role_id', 'user_id');
    }
}
