<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Actions;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Repositories\SkeletonRepository;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\API\DTO\SkeletonDTO;
use AdminKit\Core\Ship\Abstracts\Actions\AbstractAction;
use Spatie\LaravelData\Data;

class GetSkeletonBySlugAction extends AbstractAction
{
    public function __construct(
        private readonly SkeletonRepository $skeletonRepository,
    ) {
    }

    public function run(string $slug): Data
    {
        $skeleton = $this->skeletonRepository->getBySlug($slug);

        return SkeletonDTO::from($skeleton);
    }
}
