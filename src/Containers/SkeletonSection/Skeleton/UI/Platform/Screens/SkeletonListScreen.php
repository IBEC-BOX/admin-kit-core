<?php

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Screens;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Layouts\SkeletonListFiltersLayout;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Layouts\SkeletonListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class SkeletonListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'items' => Skeleton::query()
                ->withTranslation()
                ->filters()
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return __(Skeleton::NAME_PLURAL);
    }

    public function permission(): ?iterable
    {
        return [
            Skeleton::PERMISSION_READ,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Create'))
                ->icon('plus')
                ->route(Skeleton::ROUTE_CREATE),
        ];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            SkeletonListLayout::class,
        ];
    }

    public function remove(Skeleton $item): void
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Skeleton::NAME));
    }
}
