<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Models;

use AdminKit\Porto\Abstracts\Models\Model;

/**
 * @property string $title
 */
class MenuTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];
}
