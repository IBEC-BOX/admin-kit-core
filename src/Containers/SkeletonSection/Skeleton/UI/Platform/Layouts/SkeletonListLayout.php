<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Layouts;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class SkeletonListLayout extends Table
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
                ->render(fn (Skeleton $item) => Link::make((string) $item->id)->route(Skeleton::ROUTE_EDIT, $item->id)),

            // custom columns
            TD::make('title', __('Title')),

            // actions
            TD::make('actions', __('Actions'))
                ->alignRight()
                ->width(100)
                ->render(function (Skeleton $item) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route(Skeleton::ROUTE_EDIT, $item->id)
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
