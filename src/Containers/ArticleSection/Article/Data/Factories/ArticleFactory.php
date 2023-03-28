<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\Data\Factories;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        $locales = config('translatable.locales');
        $translations = collect($locales)
            ->mapWithKeys(fn ($value) => [
                $value => [
                    'title' => fake('ru')->realText(100),
                    'content' => fake('ru')->randomHtml,
                    'short_content' => fake('ru')->realText(500),
                ],
            ])
            ->toArray();

        return [
            'slug' => fake()->slug,
            'published_at' => fake()->boolean ? fake()->dateTimeThisMonth : null,
            'pinned' => fake()->boolean,
            ...$translations,
        ];
    }
}
