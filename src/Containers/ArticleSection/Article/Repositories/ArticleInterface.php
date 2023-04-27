<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Repositories;

use AdminKit\Core\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleInterface extends RepositoryInterface
{
    public function getPaginatedList(): LengthAwarePaginator;

    public function getBySlug(string $slug): Model;
}
