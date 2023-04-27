<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\API\DTO;

use AdminKit\Core\Ship\Abstracts\DTO\AbstractDTO;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\DataCollection;

class DirectoryDTO extends AbstractDTO
{
    public function __construct(
        public int $id,
        public string $slug,
        public string $name,
        #[DataCollectionOf(RecordDTO::class), MapInputName('children')]
        public DataCollection $records,
    ) {
    }
}
