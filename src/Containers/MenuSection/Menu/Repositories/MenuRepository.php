<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Repositories;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Ship\Parents\Repositories\AbstractRepository;
use Exception;
use Spatie\LaravelData\Data;

class MenuRepository extends AbstractRepository implements MenuInterface
{
    public function model(): string
    {
        return Menu::class;
    }

    public function getList()
    {
        return $this->model
            ->withTranslation()
            ->get()
            ->toTree();
    }

    public function getBySlug(string $slug): Data
    {
        return $this->model
            ->withTranslation()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * @throws Exception
     */
    private function checkIsActive(Menu $menu)
    {
        if (! $menu->is_active) {
            throw new Exception(__('Menu has not been published'));
        }
    }
}
