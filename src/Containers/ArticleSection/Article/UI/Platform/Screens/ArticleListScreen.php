<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Screens;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Layouts\ArticleListFiltersLayout;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Layouts\ArticleListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ArticleListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'items' => Article::query()
                ->with('translations')
                ->filters()
                ->filtersApplySelection(ArticleListFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return __(Article::NAME_PLURAL);
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
            Link::make(__('Create'))
                ->icon('plus')
                ->route(Article::ROUTE_CREATE),
        ];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            ArticleListFiltersLayout::class,
            ArticleListLayout::class,
        ];
    }

    public function remove(Article $item): void
    {
        $item->delete();
        Alert::info(__('You have successfully deleted').' '.__(Article::NAME));
    }
}
