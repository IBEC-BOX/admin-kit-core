<?php

declare(strict_types=1);

namespace AdminKit\Core\Ship\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string srcPath()
 * @method static string shipPath()
 * @method static string containersPath()
 *
 * @see \AdminKit\Core\Core
 */
class AdminKit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AdminKit\Core\Core::class;
    }
}
