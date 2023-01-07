<?php

namespace AdminKit\Core\Models;

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
}
