<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Repositories;

use AdminKit\Core\Ship\Abstracts\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface SkeletonInterface extends RepositoryInterface
{
    public function getPaginatedList(): LengthAwarePaginator;

    public function getBySlug(string $slug): Model;
}
