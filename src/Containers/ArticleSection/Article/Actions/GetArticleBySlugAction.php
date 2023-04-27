<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Actions;

use AdminKit\Core\Containers\ArticleSection\Article\Repositories\ArticleRepository;
use AdminKit\Core\Containers\ArticleSection\Article\UI\API\DTO\ArticleDTO;
use AdminKit\Core\Ship\Abstracts\Actions\AbstractAction;
use Spatie\LaravelData\Data;

class GetArticleBySlugAction extends AbstractAction
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    public function run(string $slug): Data
    {
        $article = $this->articleRepository->getBySlug($slug);

        return ArticleDTO::from($article);
    }
}
