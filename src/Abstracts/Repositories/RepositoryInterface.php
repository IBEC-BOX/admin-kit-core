<?php

declare(strict_types=1);

namespace AdminKit\Core\Abstracts\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all($columns = ['*']): Collection;
}
