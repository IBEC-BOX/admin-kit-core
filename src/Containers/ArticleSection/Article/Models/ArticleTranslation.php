<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Models;

use AdminKit\Core\Ship\Abstracts\Models\AbstractModel;

/**
 * @property string $title
 * @property string $content
 * @property string $short_content
 */
class ArticleTranslation extends AbstractModel
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'short_content',
    ];
}
