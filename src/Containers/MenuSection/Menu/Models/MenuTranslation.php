<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Models;

use AdminKit\Core\Ship\Abstracts\Models\AbstractModel;

/**
 * @property string $title
 */
class MenuTranslation extends AbstractModel
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];
}
