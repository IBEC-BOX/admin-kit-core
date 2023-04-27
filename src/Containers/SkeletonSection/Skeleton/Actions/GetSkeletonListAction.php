<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Actions;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Repositories\SkeletonRepository;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\API\DTO\SkeletonDTO;
use AdminKit\Core\Ship\Abstracts\Actions\AbstractAction;
use Spatie\LaravelData\PaginatedDataCollection;

class GetSkeletonListAction extends AbstractAction
{
    public function __construct(
        private readonly SkeletonRepository $skeletonRepository,
    ) {
    }

    public function run(): PaginatedDataCollection
    {
        $skeletons = $this->skeletonRepository->getPaginatedList();

        return SkeletonDTO::collection($skeletons)->except('content');
    }
}
