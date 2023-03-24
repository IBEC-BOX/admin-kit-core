<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Layouts;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class ArticleListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'items';

    protected function columns(): array
    {
        return [
            // id
            TD::make('id', __('ID'))
                ->alignCenter()
                ->width(50)
                ->sort()
                ->render(fn (Article $item) => Link::make((string) $item->id)->route(Article::ROUTE_EDIT, $item->id)),

            // custom columns
            TD::make('title', __('Title')),
            TD::make('published_at', __('Publish date'))
                ->alignCenter()
                ->width(200)
                ->sort()
                ->filter(TD::FILTER_DATE_RANGE)
                ->render(function (Article $article) {
                    if (! ($article->published_at)) {
                        return view('admin-kit::partials.bool', ['bool' => false]);
                    }

                    return $article->published_at->format('d.m.Y H:i');
                }),

            // actions
            TD::make('actions', __('Actions'))
                ->alignRight()
                ->width(100)
                ->render(function (Article $item) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route(Article::ROUTE_EDIT, $item->id)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->type(Color::DANGER())
                                ->confirm(__("Are you sure you want to delete entry #$item->id?"))
                                ->parameters(['id' => $item->id]),
                        ]);
                }),
        ];
    }
}
