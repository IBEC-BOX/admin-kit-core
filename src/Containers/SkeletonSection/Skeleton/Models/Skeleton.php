<?php

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Models;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Data\Factories\SkeletonFactory;
use AdminKit\Core\Containers\UserSection\User\Models\AdminUser;
use AdminKit\Core\Ship\Abstracts\Models\AbstractModel;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $title
 */
class Skeleton extends AbstractModel implements TranslatableContract
{
    // use SoftDeletes;
    use HasFactory;
    use AsSource, Filterable;
    use Translatable;
    use Sluggable;

    public const NAME = 'Skeleton';

    public const NAME_PLURAL = 'Skeletons';

    public const ICON = 'question';

    public const ROUTE_LIST = 'platform.skeletons.list';

    public const ROUTE_EDIT = 'platform.skeletons.edit';

    public const ROUTE_CREATE = 'platform.skeletons.create';

    public const PERMISSION_CREATE = 'platform.skeletons.create';

    public const PERMISSION_READ = 'platform.skeletons.read';

    public const PERMISSION_UPDATE = 'platform.skeletons.update';

    public const PERMISSION_DELETE = 'platform.skeletons.delete';

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'slug',
    ];

    protected $translatedAttributes = [
        'title',
    ];

    protected $allowedFilters = [
        'id',
    ];

    protected $allowedSorts = [
        'id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    protected static function newFactory()
    {
        return new SkeletonFactory();
    }
}
