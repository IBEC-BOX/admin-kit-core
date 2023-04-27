<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\API\DTO;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Ship\Abstracts\DTO\AbstractDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Lazy;

class ArticleDTO extends AbstractDTO
{
    public function __construct(
        public Lazy|int $id,
        public Lazy|string $slug,
        public Lazy|string $title,
        public Lazy|string $content,
        public Lazy|string|null $short_content,
        public Lazy|Carbon $published_at,
        public Lazy|Carbon $created_at,
        public Lazy|Carbon $updated_at,
    ) {
    }

    public static function fromModel(Article $article): self
    {
        return new self(
            Lazy::when(fn () => isset($article->id), fn () => $article->id),
            Lazy::when(fn () => isset($article->slug), fn () => $article->slug),
            Lazy::when(fn () => isset($article->title), fn () => $article->title),
            Lazy::when(fn () => isset($article->content), fn () => $article->content),
            Lazy::when(fn () => isset($article->short_content), fn () => $article->short_content),
            Lazy::when(fn () => isset($article->published_at), fn () => $article->published_at),
            Lazy::when(fn () => isset($article->created_at), fn () => $article->created_at),
            Lazy::when(fn () => isset($article->updated_at), fn () => $article->updated_at),
        );
    }
}
