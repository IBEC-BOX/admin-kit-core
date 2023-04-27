<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\API\DTO;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Ship\Abstracts\DTO\AbstractDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class SkeletonDTO extends AbstractDTO
{
    public function __construct(
        public Lazy|int $id,
        public Lazy|string $slug,
        public Lazy|string $title,
        public Lazy|Carbon $created_at,
        public Lazy|Carbon $updated_at,
    ) {
    }

    public static function fromModel(Skeleton $skeleton): self
    {
        return new self(
            Lazy::when(fn () => isset($skeleton->id), fn () => $skeleton->id),
            Lazy::when(fn () => isset($skeleton->slug), fn () => $skeleton->slug),
            Lazy::when(fn () => isset($skeleton->title), fn () => $skeleton->title),
            Lazy::when(fn () => isset($skeleton->created_at), fn () => $skeleton->created_at),
            Lazy::when(fn () => isset($skeleton->updated_at), fn () => $skeleton->updated_at),
        );
    }
}
