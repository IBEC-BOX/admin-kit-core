<?php

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Screens;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Requests\DirectorySaveRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class DirectoryCreateScreen extends Screen
{
    public Directory $root;

    public function query(Directory $root): iterable
    {
        return [
            'root' => $root,
        ];
    }

    public function name(): ?string
    {
        return __('Create').' '.__(Directory::RECORD_NAME);
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
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        $defaultLocale = config('app.locale');
        $locales = app(Locales::class)->all();

        $tabs = [];
        foreach ($locales as $locale) {
            $tabs[$locale] = [
                Layout::rows([
                    Input::make($locale.'[name]')
                        ->title(__('Name')." ($locale)")
                        ->required($locale === $defaultLocale)
                        ->placeholder(__('Enter name...')),
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

    public function save(Directory $root, DirectorySaveRequest $request): RedirectResponse
    {
        $root->children()->create($request->validated());
        Alert::info(__('You have successfully saved').' '.__(Directory::NAME));

        return redirect()->route(Directory::ROUTE_CHILD_LIST, ['root' => $root->id]);
    }
}
