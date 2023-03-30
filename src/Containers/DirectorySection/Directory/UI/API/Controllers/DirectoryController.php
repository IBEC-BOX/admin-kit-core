<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Controllers;

use AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Repositories\DirectoryInterface;

class DirectoryController
{
    public function __construct(
        public DirectoryInterface $repository,
    ) {
    }

    public function index()
    {
        return $this->repository->getListAll();
    }

    public function listBySlug(string $slug)
    {
        return $this->repository->getListBySlug($slug);
    }
}
