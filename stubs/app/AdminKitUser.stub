<?php

namespace App\Models;

use Filament\Panel;
use AdminKit\Core\Models\AdminKitUser as Authenticatable;
use Filament\Models\Contracts\FilamentUser;

class AdminKitUser extends Authenticatable implements FilamentUser
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
