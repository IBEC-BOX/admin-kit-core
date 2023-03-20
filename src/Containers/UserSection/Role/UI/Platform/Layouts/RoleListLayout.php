<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\Role\UI\Platform\Layouts;

use AdminKit\Core\Containers\UserSection\Role\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Cell;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RoleListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'roles';

    /**
     * @return Cell[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Role $role) {
                    return Link::make($role->name)
                        ->route('platform.systems.roles.edit', $role->id);
                }),

            TD::make('slug', __('Slug'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('created_at', __('Created'))
                ->sort()
                ->render(function (Role $role) {
                    return $role->created_at->toDateTimeString();
                }),
        ];
    }
}
