<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Repositories;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Ship\Abstracts\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleRepository extends AbstractRepository implements ArticleInterface
{
    public function model(): string
    {
        return Article::class;
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return QueryBuilder::for($this->model())
            ->allowedFilters([
                'id',
                'slug',
                'published_at',
                'created_at',
                'updated_at',
                AllowedFilter::scope('title'),
                AllowedFilter::scope('content'),
                AllowedFilter::scope('short_content'),
            ])
            ->allowedSorts(['id', 'published_at'])
            ->isPublished()
            ->isTitleNotNull()
            ->jsonPaginate();
    }

    public function getBySlug(string $slug): Model
    {
        return $this->model
            ->where('slug', $slug)
            ->isPublished()
            ->firstOrFail();
    }
}
