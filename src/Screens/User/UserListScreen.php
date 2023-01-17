<?php

declare(strict_types=1);

namespace AdminKit\Core\Screens\User;

use AdminKit\Core\Layouts\User\UserEditLayout;
use AdminKit\Core\Layouts\User\UserFiltersLayout;
use AdminKit\Core\Layouts\User\UserListLayout;
use AdminKit\Core\Models\AdminUser;
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
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'User';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All registered users';
    }

    /**
     * @return iterable|null
     */
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
     * @param  AdminUser  $user
     * @return array
     */
    public function asyncGetUser(AdminUser $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    /**
     * @param  Request  $request
     * @param  AdminUser  $user
     */
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

    /**
     * @param  Request  $request
     */
    public function remove(Request $request): void
    {
        AdminUser::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
