<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\API\Controllers;

use AdminKit\Core\Containers\MenuSection\Menu\Actions\GetListAction;
use AdminKit\Core\Containers\MenuSection\Menu\UI\API\DTO\MenuDTO;

class MenuController
{
    public function index() {
        $menus = app(GetListAction::class)->run();

        return MenuDTO::collection($menus);
    }

}
