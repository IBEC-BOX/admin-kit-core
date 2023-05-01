<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\Data\Factories;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Ship\Abstracts\Factories\AbstractFactory;

class SkeletonFactory extends AbstractFactory
{
    protected $model = Skeleton::class;

    public function definition()
    {
        $locales = app(Locales::class)->all();
        $translations = collect($locales)
            ->mapWithKeys(fn ($value) => [
                $value => [
                    'title' => fake('ru')->realText(100),
                ],
            ])
            ->toArray();

        return [
            'slug' => fake()->slug,
            ...$translations,
        ];
    }
}
