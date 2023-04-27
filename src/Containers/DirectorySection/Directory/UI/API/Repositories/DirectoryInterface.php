<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Repositories;

use AdminKit\Core\Ship\Abstracts\Repositories\RepositoryInterface;
use Spatie\LaravelData\DataCollection;

interface DirectoryInterface extends RepositoryInterface
{
    public function getListAll(): DataCollection;

    public function getListBySlug($slug): DataCollection;
}
