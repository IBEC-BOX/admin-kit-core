<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\API\DTO;

use AdminKit\Core\Ship\Abstracts\DTO\AbstractDTO;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class MenuDTO extends AbstractDTO
{
    public function __construct(
        public int $id,
        public string $slug,
        public string $title,
        #[DataCollectionOf(MenuDTO::class), MapInputName('children')]
        public DataCollection $children,
    ) {
    }
}
