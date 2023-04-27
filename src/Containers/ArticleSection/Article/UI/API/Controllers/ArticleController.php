<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\API\Controllers;

use AdminKit\Core\Containers\ArticleSection\Article\Actions\GetArticleBySlugAction;
use AdminKit\Core\Containers\ArticleSection\Article\Actions\GetArticleListAction;

class ArticleController
{
    public function index()
    {
        return app(GetArticleListAction::class)->run();
    }

    public function showBySlug(string $slug)
    {
        return app(GetArticleBySlugAction::class)->run($slug);
    }
}
