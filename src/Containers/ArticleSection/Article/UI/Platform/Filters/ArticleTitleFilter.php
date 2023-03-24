<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class ArticleTitleFilter extends Filter
{
    /**
     * The displayable name of the filter.
     */
    public function name(): string
    {
        return __('Title');
    }

    /**
     * The array of matched parameters.
     */
    public function parameters(): ?array
    {
        return ['title'];
    }

    /**
     * Apply to a given Eloquent query builder.
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('translations', function ($query) {
            $search = mb_strtolower($this->request->get('title'));

            return $query->whereRaw('LOWER(title) LIKE (?)', ["%$search%"]);
        });
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Input::make('title')
                ->type('text')
                ->value($this->request->get('title'))
                ->placeholder('Search...')
                ->title(__('Title')),
        ];
    }
}
