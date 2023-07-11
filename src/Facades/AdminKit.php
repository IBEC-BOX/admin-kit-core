<?php

declare(strict_types=1);

namespace AdminKit\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array locales()

 * @see \AdminKit\Core\Core
 */
class AdminKit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AdminKit\Core\Core::class;
    }
}
