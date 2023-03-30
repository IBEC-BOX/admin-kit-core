<?php

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Layouts\RootDirectoryListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class RootDirectoryListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'items' => Directory::query()
                ->whereNull('parent_id')
                ->withTranslation()
                ->filters()
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return __(Directory::NAME_PLURAL);
    }

    public function permission(): ?iterable
    {
        return [
            Directory::PERMISSION_READ,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Create'))
                ->icon('plus')
                ->route(Directory::ROUTE_ROOT_CREATE),
        ];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            RootDirectoryListLayout::class,
        ];
    }

    public function remove(Directory $item): void
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Directory::NAME));
    }
}
