<?php

namespace AdminKit\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AdminKit\Core\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AdminKit\Core\Core::class;
    }
}
