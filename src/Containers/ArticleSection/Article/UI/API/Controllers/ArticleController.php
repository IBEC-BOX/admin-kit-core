<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\API\Controllers;

use AdminKit\Core\Containers\ArticleSection\Article\UI\API\Repositories\ArticleInterface;

class ArticleController
{
    public function __construct(
        public ArticleInterface $repository,
    ) {
    }

    public function index()
    {
        return $this->repository->getPaginatedList();
    }

    public function show(int $id)
    {
        return $this->repository->getById($id);
    }

    public function showBySlug(string $slug)
    {
        return $this->repository->getBySlug($slug);
    }
}
