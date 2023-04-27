<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\API\DTO;

use AdminKit\Core\Ship\Abstracts\DTO\AbstractDTO;
use Spatie\LaravelData\Data;

class RecordDTO extends AbstractDTO
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
