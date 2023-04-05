<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\API\Repositories;

use AdminKit\Core\Repositories\RepositoryInterface;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

interface ArticleInterface extends RepositoryInterface
{
    public function getPaginatedList(): PaginatedDataCollection;

    public function getBySlug(string $slug): Data;
}
