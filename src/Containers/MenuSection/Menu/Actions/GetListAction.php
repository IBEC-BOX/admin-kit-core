<?php


namespace AdminKit\Core\Containers\MenuSection\Menu\Actions;


use AdminKit\Core\Containers\MenuSection\Menu\Repositories\MenuRepository;
use AdminKit\Core\Ship\Parents\Actions\Action as ParentAction;

class GetListAction extends ParentAction
{
    public function run() {
        return app(MenuRepository::class)->getList();
    }

}