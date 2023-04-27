<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Repositories;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Ship\Abstracts\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SkeletonRepository extends AbstractRepository implements SkeletonInterface
{
    public function model(): string
    {
        return Skeleton::class;
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return QueryBuilder::for($this->model())
            ->withTranslation()
            ->allowedFilters([
                'id',
                'slug',
                'created_at',
                'updated_at',
                AllowedFilter::scope('title'),
            ])
            ->allowedSorts(['id'])
            ->jsonPaginate();
    }

    public function getBySlug(string $slug): Model
    {
        return $this->model
            ->withTranslation()
            ->where('slug', $slug)
            ->isPublished()
            ->firstOrFail();
    }
}
