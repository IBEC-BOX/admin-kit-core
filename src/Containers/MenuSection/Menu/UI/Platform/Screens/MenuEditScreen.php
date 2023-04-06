<?php

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Screens;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use AdminKit\Core\Containers\MenuSection\Menu\Models\MenuTranslation;
use AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Requests\MenuSaveRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MenuEditScreen extends Screen
{
    public Menu $root;

    public Menu $item;

    public function query(Menu $root, Menu $item): iterable
    {
        return [
            'root' => $root,
            'item' => $item,
        ];
    }

    public function name(): ?string
    {
        return __('Edit').' '.__(Menu::RECORD_NAME).' #'.$this->item->id;
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
            Button::make(__('Update'))
                ->icon('note')
                ->method('save')
                ->canSee($this->item->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->item->exists)
                ->type(Color::DANGER())
                ->confirm(__("Are you sure you want to delete entry #{$this->item->id}?")),
        ];
    }

    public function layout(): iterable
    {
        $defaultLocale = config('app.locale');
        $locales = config('translatable.locales');

        $tabs = [];
        foreach ($locales as $locale) {
            /** @var MenuTranslation|null $translation */
            $translation = $this->item->getTranslation($locale);
            $tabs[$locale] = [
                Layout::rows([
                    Input::make($locale.'[title]')
                        ->title(__('Title')." ($locale)")
                        ->required($locale === $defaultLocale)
                        ->placeholder(__('Enter title...'))
                        ->value($translation?->title),
                ]),
            ];
        }

        return [
            Layout::rows([
                Input::make('slug')
                    ->title(__('Slug'))
                    ->placeholder(__('enter-slug'))
                    ->value($this->item->slug),
            ]),
            Layout::tabs($tabs),
        ];
    }

    public function save(Menu $root, Menu $item, MenuSaveRequest $request): RedirectResponse
    {
        $item->fill($request->validated())->appendToNode($root)->save();
        Alert::info(__('You have successfully saved').' '.__(Menu::NAME));

        return redirect()->route(Menu::ROUTE_CHILD_LIST, ['root' => $root->id]);
    }

    public function remove(Menu $root, Menu $item): RedirectResponse
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Menu::NAME));

        return redirect()->route(Menu::ROUTE_CHILD_LIST, ['root' => $root->id]);
    }
}
