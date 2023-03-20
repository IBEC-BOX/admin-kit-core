<?php

namespace AdminKit\Core\Containers\UserSection\User\UI\Platform\Layouts;

use AdminKit\Core\Containers\UserSection\User\UI\Platform\Filters\RoleFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class UserFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            RoleFilter::class,
        ];
    }
}
