<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Layouts;

use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Filters\ArticleContentFilter;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Filters\ArticleTitleFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class ArticleListFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            ArticleTitleFilter::class,
            ArticleContentFilter::class,
        ];
    }
}
