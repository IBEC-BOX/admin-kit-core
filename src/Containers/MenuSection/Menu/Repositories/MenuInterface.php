<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Repositories;

use AdminKit\Core\Ship\Parents\Repositories\RepositoryInterface;
use Spatie\LaravelData\Data;

interface MenuInterface extends RepositoryInterface
{
    public function getList();

    public function getBySlug(string $slug): Data;
}
