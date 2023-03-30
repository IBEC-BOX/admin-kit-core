<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\API\DTO;

use Spatie\LaravelData\Data;

class RecordDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
