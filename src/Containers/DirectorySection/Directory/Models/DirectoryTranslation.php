<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\Models;

use AdminKit\Core\Ship\Abstracts\Models\AbstractModel;

/**
 * @property string $name
 */
class DirectoryTranslation extends AbstractModel
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
