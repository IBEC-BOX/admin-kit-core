<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\API\Controllers;

use AdminKit\Core\Containers\MenuSection\Menu\Actions\GetMenuListAction;
use AdminKit\Core\Containers\MenuSection\Menu\UI\API\DTO\MenuDTO;
use AdminKit\Core\Ship\Abstracts\Controllers\AbstractApiController;

class MenuController extends AbstractApiController
{
    public function index()
    {
        $menus = app(GetMenuListAction::class)->run();

        return MenuDTO::collection($menus);
    }
}
