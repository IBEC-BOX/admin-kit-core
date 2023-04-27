<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Models;

use AdminKit\Core\Ship\Abstracts\Models\AbstractModel;

/**
 * @property string $title
 */
class SkeletonTranslation extends AbstractModel
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];
}
