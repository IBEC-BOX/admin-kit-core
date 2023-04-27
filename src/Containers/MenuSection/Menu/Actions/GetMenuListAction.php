<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\Actions;

use AdminKit\Core\Containers\MenuSection\Menu\Repositories\MenuRepository;
use AdminKit\Core\Ship\Abstracts\Actions\AbstractAction;

class GetMenuListAction extends AbstractAction
{
    public function run()
    {
        return app(MenuRepository::class)->getList();
    }
}
