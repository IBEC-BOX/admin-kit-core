<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Layouts;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class RootMenuListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'items';

    protected function columns(): array
    {
        return [
            // id
            TD::make('id', __('ID'))
                ->alignCenter()
                ->width(50)
                ->sort()
                ->render(fn (Menu $item) => Link::make((string) $item->id)->route(Menu::ROUTE_ROOT_EDIT, $item->id)),

            // custom columns
            TD::make('title', __('Title'))
                ->render(fn (Menu $item) => Link::make($item->title)->route(Menu::ROUTE_CHILD_LIST, ['root' => $item->id])),

            // actions
            TD::make('actions', __('Actions'))
                ->alignRight()
                ->width(100)
                ->render(function (Menu $item) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route(Menu::ROUTE_ROOT_EDIT, $item->id)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->type(Color::DANGER())
                                ->confirm(__("Are you sure you want to delete entry #$item->id?"))
                                ->parameters(['id' => $item->id]),
                        ]);
                }),
        ];
    }
}
