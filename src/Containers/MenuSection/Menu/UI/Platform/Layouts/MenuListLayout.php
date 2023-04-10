<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Layouts;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class MenuListLayout extends Table
{
    public Menu $root;

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
        $root = $this->query->get('root');

        return [
            // id
            TD::make('id', __('ID'))
                ->alignCenter()
                ->width(50)
                ->sort()
                ->render(fn (Menu $item) => Link::make((string) $item->id)->route(Menu::ROUTE_CHILD_EDIT, ['root' => $root->id, 'item' => $item->id])),

            // custom columns
            TD::make('title', __('Title'))
                ->render(function (Menu $item) {
                    $dash = str_repeat('-', $item->depth);

                    return $dash.' '.$item->title;
                }),

            TD::make('position', __('Position'))
                ->alignRight()
                ->width(130)
                ->render(function (Menu $item) {
                    return Group::make([
                        Button::make()
                                ->method('up')
                                ->icon('arrow-up')
                                ->type(Color::SECONDARY())
                                ->parameters(['id' => $item->id]),
                        Button::make()
                            ->method('down')
                            ->icon('arrow-down')
                            ->type(Color::SECONDARY())
                            ->parameters(['id' => $item->id]),
                    ])->autoWidth();
                }),

            // actions
            TD::make('actions', __('Actions'))
                ->alignRight()
                ->width(100)
                ->render(function (Menu $item) use ($root) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route(Menu::ROUTE_CHILD_EDIT, ['root' => $root->id, 'item' => $item->id])
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
