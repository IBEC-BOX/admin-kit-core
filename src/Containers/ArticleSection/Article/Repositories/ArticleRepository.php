<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Repositories;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Repositories\AbstractRepository;
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
            ->with('translations', function ($query) {
                $query
                    ->select(['article_id', 'locale', 'title', 'short_content']) // without 'content' because it's too big
                    ->where('locale', app()->getLocale());
            })
            ->allowedFilters([
                'id',
                'slug',
                'published_at',
                'created_at',
                'updated_at',
                AllowedFilter::scope('title'),
                AllowedFilter::scope('content'),
                AllowedFilter::scope('short_content'),
                'translation.title',
                'translation.content',
                'translation.short_content',
            ])
            ->allowedSorts(['id', 'published_at'])
            ->isPublished()
            ->isTitleNotNull()
            ->paginate($this->perPage());
    }

    public function getBySlug(string $slug): Model
    {
        return $this->model
            ->withTranslation()
            ->where('slug', $slug)
            ->isPublished()
            ->firstOrFail();
    }

    private function perPage()
    {
        $perPageDefault = 20; // TODO $perPageDefault to config
        $perPageMax = 50; // TODO $perPageMax to config
        $perPage = (int) request()->query('per_page');

        if (empty($perPage)) {
            $perPage = $perPageDefault;
        }

        if ($perPage > $perPageMax) {
            $perPage = $perPageMax;
        }

        return $perPage;
    }
}
