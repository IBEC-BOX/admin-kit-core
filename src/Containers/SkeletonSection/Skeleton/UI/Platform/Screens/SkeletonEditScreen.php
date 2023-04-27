<?php

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Screens;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\SkeletonTranslation;
use AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Requests\SkeletonSaveRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class SkeletonEditScreen extends Screen
{
    public Skeleton $item;

    public function query(Skeleton $item): iterable
    {
        return [
            'item' => $item,
        ];
    }

    public function name(): ?string
    {
        return $this->item->exists
            ? __('Edit').' '.__(Skeleton::NAME).' #'.$this->item->id
            : __('Create').' '.__(Skeleton::NAME);
    }

    public function permission(): ?iterable
    {
        return [
            Skeleton::PERMISSION_READ,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save')
                ->canSee(! $this->item->exists),

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
            /** @var SkeletonTranslation|null $translation */
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
            Layout::columns([
                Layout::rows([
                    Input::make('slug')
                        ->title(__('Slug'))
                        ->placeholder(__('enter-slug'))
                        ->value($this->item->slug),
                ]),
            ]),
            Layout::tabs($tabs),
        ];
    }

    public function save(Skeleton $item, SkeletonSaveRequest $request): RedirectResponse
    {
        $item->fill($request->validated())->save();
        Alert::info(__('You have successfully saved').' '.__(Skeleton::NAME));

        return redirect()->route(Skeleton::ROUTE_LIST);
    }

    public function remove(Skeleton $item): RedirectResponse
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Skeleton::NAME));

        return redirect()->route(Skeleton::ROUTE_LIST);
    }
}
