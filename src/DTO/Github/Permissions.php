<?php

declare(strict_types=1);

namespace AdminKit\Core\DTO\Github;

use Spatie\LaravelData\Data;

class Permissions extends Data
{
    public function __construct(
        public bool $admin,
        public bool $maintain,
        public bool $push,
        public bool $triage,
        public bool $pull,
    ) {}
}
