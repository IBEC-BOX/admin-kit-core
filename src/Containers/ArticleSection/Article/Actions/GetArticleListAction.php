<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Actions;

use AdminKit\Core\Containers\ArticleSection\Article\Repositories\ArticleRepository;
use AdminKit\Core\Containers\ArticleSection\Article\UI\API\DTO\ArticleDTO;
use Spatie\LaravelData\PaginatedDataCollection;

class GetArticleListAction
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    public function run(): PaginatedDataCollection
    {
        $articles = $this->articleRepository->getPaginatedList();

        return ArticleDTO::collection($articles)->except('content');
    }
}
