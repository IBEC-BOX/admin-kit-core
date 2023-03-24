<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Screens;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Containers\ArticleSection\Article\Models\ArticleTranslation;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Requests\ArticleSaveRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ArticleEditScreen extends Screen
{
    public Article $item;

    public function query(Article $item): iterable
    {
        return [
            'item' => $item,
        ];
    }

    public function name(): ?string
    {
        return $this->item->exists
            ? __('Edit').' '.__(Article::NAME).' #'.$this->item->id
            : __('Create').' '.__(Article::NAME);
    }

    public function permission(): ?iterable
    {
        return [
            Article::PERMISSION_READ,
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
            /** @var ArticleTranslation|null $translation */
            $translation = $this->item->getTranslation($locale);
            $tabs[$locale] = [
                Layout::rows([
                    Input::make($locale.'[title]')
                        ->title(__('Title')." ($locale)")
                        ->required($locale === $defaultLocale)
                        ->placeholder(__('Enter title'))
                        ->value($translation?->title ?? ''),
                    Quill::make($locale.'[content]')
                        ->title(__('Content')." ($locale)")
                        ->required($locale === $defaultLocale)
                        ->value($translation?->content ?? ''),
                    Quill::make($locale.'[short_content]')
                        ->title(__('Short content')." ($locale)")
                        ->value($translation?->short_content ?? ''),
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
                    DateTimer::make('published_at')->enableTime()
                        ->title(__('Published at'))
                        ->value($this->item->published_at),
                    CheckBox::make('pinned')
                        ->value($this->item->pinned)
                        ->sendTrueOrFalse()
                        ->placeholder(__('Pinned')),
                ]),
                Layout::rows([
                    Cropper::make('image_id')
                        ->height(300)
                        ->width(500)
                        ->targetId()
                        ->value($this->item->image->first()?->id),
                ]),
            ]),
            Layout::tabs($tabs),
        ];
    }

    public function save(Article $item, ArticleSaveRequest $request): RedirectResponse
    {
        $item->fill($request->validated())->save();
        Alert::info(__('You have successfully saved').' '.__(Article::NAME));

        return redirect()->route(Article::ROUTE_LIST);
    }

    public function remove(Article $item): RedirectResponse
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Article::NAME));

        return redirect()->route(Article::ROUTE_LIST);
    }
}
