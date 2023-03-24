<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Models;

use AdminKit\Porto\Abstracts\Models\Model;

/**
 * @property string $title
 * @property string $content
 * @property string $short_content
 */
class ArticleTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'short_content',
    ];
}
