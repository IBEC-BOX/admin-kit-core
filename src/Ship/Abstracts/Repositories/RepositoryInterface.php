<?php

declare(strict_types=1);

namespace AdminKit\Core\Ship\Parents\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all($columns = ['*']): Collection;
}
