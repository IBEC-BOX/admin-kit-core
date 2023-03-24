<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\API\Controllers;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;

class ArticleController
{
    public function index()
    {
        return Article::all();
    }

    public function show(Article $article)
    {
        return $article;
    }
}
