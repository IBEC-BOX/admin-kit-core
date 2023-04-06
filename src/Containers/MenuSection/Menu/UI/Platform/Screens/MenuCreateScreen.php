<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Requests\MenuSaveRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MenuCreateScreen extends Screen
{
    public Menu $root;

    public function query(Menu $root): iterable
    {
        return [
            'root' => $root,
        ];
    }

    public function name(): ?string
    {
        return __('Create').' '.__(Menu::RECORD_NAME);
    }

    public function permission(): ?iterable
    {
        return [
            Menu::PERMISSION_READ,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        $defaultLocale = config('app.locale');
        $locales = config('translatable.locales');

        $tabs = [];
        foreach ($locales as $locale) {
            $tabs[$locale] = [
                Layout::rows([
                    Input::make($locale.'[title]')
                        ->title(__('Title')." ($locale)")
                        ->required($locale === $defaultLocale)
                        ->placeholder(__('Enter title...')),
                ]),
            ];
        }

        return [
            Layout::rows([
                Input::make('slug')
                    ->title(__('Slug'))
                    ->placeholder(__('enter-slug')),
            ]),
            Layout::tabs($tabs),
        ];
    }

    public function save(Menu $root, MenuSaveRequest $request): RedirectResponse
    {
        $root->children()->create($request->validated());
        Alert::info(__('You have successfully saved').' '.__(Menu::NAME));

        return redirect()->route(Menu::ROUTE_CHILD_LIST, ['root' => $root->id]);
    }
}
