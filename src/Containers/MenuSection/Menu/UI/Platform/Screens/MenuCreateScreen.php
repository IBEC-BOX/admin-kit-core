<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Requests\MenuSaveRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
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
        $locales = app(Locales::class)->all();

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

        $nodes = Menu::get()->toTree();

        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            $options = [];
            foreach ($categories as $category) {
                $options[$prefix.' '.$category->title] = $category->id;

                $options = array_merge($options, $traverse($category->children, $prefix.'-'));
            }

            return $options;
        };

        $options = array_flip($traverse($nodes));

        return [
            Layout::rows([
                Input::make('slug')
                    ->title(__('Slug'))
                    ->placeholder(__('enter-slug')),
                Select::make('parent_id')
                    ->options($options),
            ]),
            Layout::tabs($tabs),
        ];
    }

    public function save(Menu $root, MenuSaveRequest $request): RedirectResponse
    {
        Menu::create($request->validated());
        Alert::info(__('You have successfully saved').' '.__(Menu::NAME));

        return redirect()->route(Menu::ROUTE_CHILD_LIST, ['root' => $root->id]);
    }
}
