<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\Models;

use AdminKit\Core\Containers\MenuSection\Menu\Data\Factories\MenuFactory;
use AdminKit\Core\Ship\Abstracts\Models\AbstractModel;
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
 * @property int $parent_id
 * @property string $slug
 * @property string url
 * @property bool url_in_new_window
 * @property bool is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $title
 */
class Menu extends AbstractModel implements TranslatableContract
{
    use HasFactory, SoftDeletes;
    use AsSource, Attachable, Filterable;
    use Translatable;
    use NodeTrait, Sluggable {
        Sluggable::replicate as replicateSluggable;
        NodeTrait::replicate insteadof Sluggable;
    }

    public const NAME = 'Menu';

    public const NAME_PLURAL = 'Menus';

    public const RECORD_NAME = 'Record';

    public const RECORD_NAME_PLURAL = 'Records';

    public const ICON = 'folder-alt';

    public const ROUTE_CHILD_LIST = 'platform.menus.list';

    public const ROUTE_CHILD_EDIT = 'platform.menus.edit';

    public const ROUTE_CHILD_CREATE = 'platform.menus.create';

    public const ROUTE_ROOT_LIST = 'platform.menus.root.list';

    public const ROUTE_ROOT_EDIT = 'platform.menus.root.edit';

    public const ROUTE_ROOT_CREATE = 'platform.menus.root.create';

    public const PERMISSION_CREATE = 'platform.menus.create';

    public const PERMISSION_READ = 'platform.menus.read';

    public const PERMISSION_UPDATE = 'platform.menus.update';

    public const PERMISSION_DELETE = 'platform.menus.delete';

    protected $fillable = [
        'parent_id',
        'slug',
        'url',
        'url_in_new_window',
        'is_active',
    ];

    protected $translatedAttributes = [
        'title',
    ];

    protected $allowedFilters = [
        'id',
        'slug',
        'translations.title',
    ];

    protected $allowedSorts = [
        'id',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    protected static function newFactory(): Factory
    {
        return MenuFactory::new();
    }

    public function scopeTitle(Builder $query, $search): Builder
    {
        return $query->whereHas('translation', function ($query) use ($search) {
            $search = mb_strtolower($search);

            return $query->whereRaw('LOWER(title) LIKE (?)', ["%$search%"]);
        });
    }

    /**
     * Return needed Menu model
     */
    public function initial(string $slug): Builder
    {
        return $this->whereRaw('parent_id = (SELECT id FROM "menus" WHERE "slug" = ?)', [$slug]);
    }
}
