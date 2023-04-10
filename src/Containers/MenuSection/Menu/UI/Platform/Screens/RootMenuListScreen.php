<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Layouts\RootMenuListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class RootMenuListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'items' => Menu::query()
                ->whereNull('parent_id')
                ->withTranslation()
                ->filters()
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return __(Menu::NAME_PLURAL);
    }

    public function permission(): ?iterable
    {
        return [
            Menu::PERMISSION_READ,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Create'))
                ->icon('plus')
                ->route(Menu::ROUTE_ROOT_CREATE),
        ];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            RootMenuListLayout::class,
        ];
    }

    public function remove(Menu $item): void
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Menu::NAME));
    }
}
