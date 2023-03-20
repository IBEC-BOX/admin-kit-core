<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\Role\UI\Platform\Screens;

use AdminKit\Core\Containers\UserSection\Role\Models\Role;
use AdminKit\Core\Containers\UserSection\Role\UI\Platform\Layouts\RoleListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoleListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'roles' => Role::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * Display header name.
     */
    public function name(): ?string
    {
        return 'Manage roles';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Access rights';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.roles',
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->href(route('platform.systems.roles.create')),
        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            RoleListLayout::class,
        ];
    }
}
