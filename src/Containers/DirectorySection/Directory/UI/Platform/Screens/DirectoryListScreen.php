<?php

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Layouts\DirectoryListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class DirectoryListScreen extends Screen
{
    public Directory $root;

    public function query(Directory $root): iterable
    {
        return [
            'root' => $root,
            'items' => Directory::where('parent_id', $root->id)
                ->withTranslation()
                ->filters()
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return __(Directory::RECORD_NAME_PLURAL);
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
                ->route(Directory::ROUTE_CHILD_CREATE, ['root' => $this->root->id]),
        ];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            DirectoryListLayout::class,
        ];
    }

    public function remove(Directory $item): void
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Directory::NAME));
    }
}
