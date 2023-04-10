<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Layouts\MenuListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MenuListScreen extends Screen
{
    public Menu $root;

    public function query(Menu $root): iterable
    {
        $items = Menu::withDepth()
            ->withTranslation()
            ->defaultOrder()
            ->descendantsOf($root->id);

        return [
            'root' => $root,
            'items' => $items,
        ];
    }

    public function name(): ?string
    {
        return __(Menu::RECORD_NAME_PLURAL);
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
                ->route(Menu::ROUTE_CHILD_CREATE, ['root' => $this->root->id]),
        ];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            MenuListLayout::class,
        ];
    }

    public function remove(Menu $item): void
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Menu::NAME));
    }

    public function up(Request $request) {
        $item = Menu::findOrFail($request->get('id'));
        $item->up();
        Alert::info(__('You have successfully up').': '. $item->title);
    }

    public function down(Request $request) {
        $item = Menu::findOrFail($request->get('id'));
        $item->down();
        Alert::info(__('You have successfully down').': '.$item->title);
    }
}
