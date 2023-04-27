<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\API\Controllers;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Actions\GetSkeletonBySlugAction;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\Actions\GetSkeletonListAction;
use AdminKit\Core\Ship\Abstracts\Controllers\AbstractApiController;

class SkeletonController extends AbstractApiController
{
    public function index()
    {
        return app(GetSkeletonListAction::class)->run();
    }

    public function showBySlug(string $slug)
    {
        return app(GetSkeletonBySlugAction::class)->run($slug);
    }
}
