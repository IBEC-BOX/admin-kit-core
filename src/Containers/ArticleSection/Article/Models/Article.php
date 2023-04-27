<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\Models;

use AdminKit\Core\Containers\ArticleSection\Article\Data\Factories\ArticleFactory;
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
 * @property bool $pinned
 * @property Carbon|null $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $title
 * @property string $content
 * @property string $short_content
 * @property Collection<Attachment> $image
 */
class Article extends AbstractModel implements TranslatableContract
{
    use HasFactory, SoftDeletes;
    use AsSource, Attachable, Filterable;
    use Translatable;
    use Sluggable;

    public const NAME = 'Article';

    public const NAME_PLURAL = 'Articles';

    public const ICON = 'book-open';

    public const ROUTE_LIST = 'platform.articles.list';

    public const ROUTE_EDIT = 'platform.articles.edit';

    public const ROUTE_CREATE = 'platform.articles.create';

    public const PERMISSION_CREATE = 'platform.articles.create';

    public const PERMISSION_READ = 'platform.articles.read';

    public const PERMISSION_UPDATE = 'platform.articles.update';

    public const PERMISSION_DELETE = 'platform.articles.delete';

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'slug',
        'pinned',
        'published_at',
    ];

    protected $translatedAttributes = [
        'title',
        'content',
        'short_content',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
        'translations.title',
        'published_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'published_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class);
    }

    public function image(): MorphToMany
    {
        return $this->morphToMany(Attachment::class, 'attachmentable', 'attachmentable');
    }

    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeIsTitleNotNull(Builder $query): Builder
    {
        return $query->whereHas('translation', function ($query) {
            return $query->whereNotNull('title');
        });
    }

    public function scopeTitle(Builder $query, $search): Builder
    {
        return $query->whereHas('translation', function ($query) use ($search) {
            $search = mb_strtolower($search);

            return $query->whereRaw('LOWER(title) LIKE (?)', ["%$search%"]);
        });
    }

    public function scopeContent(Builder $query, $search): Builder
    {
        return $query->whereHas('translation', function ($query) use ($search) {
            $search = mb_strtolower($search);

            return $query->whereRaw('LOWER(content) LIKE (?)', ["%$search%"]);
        });
    }

    public function scopeShortContent(Builder $query, $search): Builder
    {
        return $query->whereHas('translation', function ($query) use ($search) {
            $search = mb_strtolower($search);

            return $query->whereRaw('LOWER(short_content) LIKE (?)', ["%$search%"]);
        });
    }

    protected static function newFactory()
    {
        return new ArticleFactory();
    }
}
