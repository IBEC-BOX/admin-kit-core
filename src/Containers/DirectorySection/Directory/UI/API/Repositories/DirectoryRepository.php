<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\API\Repositories;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\API\DTO\DirectoryDTO;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\API\DTO\RecordDTO;
use AdminKit\Core\Ship\Parents\Repositories\AbstractRepository;
use Spatie\LaravelData\DataCollection;

class DirectoryRepository extends AbstractRepository implements DirectoryInterface
{
    public function model(): string
    {
        return Directory::class;
    }

    public function getListAll(): DataCollection
    {
        $directories = $this->model
            ->defaultOrder()
            ->get()
            ->toTree();

        return DirectoryDTO::collection($directories);
    }

    public function getListBySlug($slug): DataCollection
    {
        $directories = $this->model
            ->initial($slug)
            ->defaultOrder()
            ->get();

        return RecordDTO::collection($directories);
    }
}
