<?php

namespace AdminKit\Core\Containers\DirectorySection\Directory\Models;

use AdminKit\Core\Containers\DirectorySection\Directory\Data\Factories\DirectoryFactory;
use AdminKit\Porto\Abstracts\Models\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $slug
 * @property array $properties
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $name
 */
class Directory extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes;
    use AsSource, Attachable, Filterable;
    use Translatable;

    use NodeTrait, Sluggable {
        Sluggable::replicate as replicateSluggable;
        NodeTrait::replicate insteadof Sluggable;
    }


    public const NAME = 'Directory';

    public const NAME_PLURAL = 'Directories';

    public const RECORD_NAME = 'Record';

    public const RECORD_NAME_PLURAL = 'Records';

    public const ICON = 'folder-alt';

    public const ROUTE_CHILD_LIST = 'platform.directories.list';

    public const ROUTE_CHILD_EDIT = 'platform.directories.edit';

    public const ROUTE_CHILD_CREATE = 'platform.directories.create';

    public const ROUTE_ROOT_LIST = 'platform.directories.root.list';

    public const ROUTE_ROOT_EDIT = 'platform.directories.root.edit';

    public const ROUTE_ROOT_CREATE = 'platform.directories.root.create';

    public const PERMISSION_CREATE = 'platform.directories.create';

    public const PERMISSION_READ = 'platform.directories.read';

    public const PERMISSION_UPDATE = 'platform.directories.update';

    public const PERMISSION_DELETE = 'platform.directories.delete';

    protected $fillable = [
        'slug',
        'properties',
    ];

    protected $translatedAttributes = [
        'name',
    ];

    protected $allowedFilters = [
        'id',
        'slug',
        'translations.name',
    ];

    protected $allowedSorts = [
        'id',
        'slug',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    protected static function newFactory(): Factory
    {
        return DirectoryFactory::new();
    }

    public function scopeName(Builder $query, $search): Builder
    {
        return $query->whereHas('translation', function ($query) use ($search) {
            $search = mb_strtolower($search);

            return $query->whereRaw('LOWER(name) LIKE (?)', ["%$search%"]);
        });
    }

    /**
     * Return needed Directory model
     *
     * @param string $slug
     * @return Builder
     */
    public static function initial(string $slug): Builder
    {
        return static::where('parent_id = (SELECT id FROM "directories" WHERE "slug" = ?)', [$slug]);
    }
}
