<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\UserSection\User\UI\Platform\Screens;

use AdminKit\Core\Containers\UserSection\User\Models\AdminUser;
use AdminKit\Core\Containers\UserSection\User\UI\Platform\Layouts\UserEditLayout;
use AdminKit\Core\Containers\UserSection\User\UI\Platform\Layouts\UserFiltersLayout;
use AdminKit\Core\Containers\UserSection\User\UI\Platform\Layouts\UserListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'users' => AdminUser::with('roles')
                ->filters()
                ->filtersApplySelection(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * Display header name.
     */
    public function name(): ?string
    {
        return 'User';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'All registered users';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.users.create'),
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
            UserFiltersLayout::class,
            UserListLayout::class,

            Layout::modal('asyncEditUserModal', UserEditLayout::class)
                ->async('asyncGetUser'),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetUser(AdminUser $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function saveUser(Request $request, AdminUser $user): void
    {
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(AdminUser::class, 'email')->ignore($user),
            ],
        ]);

        $user->fill($request->input('user'))->save();

        Toast::info(__('User was saved.'));
    }

    public function remove(Request $request): void
    {
        AdminUser::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
