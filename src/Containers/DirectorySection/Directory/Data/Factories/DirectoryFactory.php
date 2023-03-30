<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\Data\Factories;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectoryFactory extends Factory
{
    protected $model = Directory::class;

    public function definition()
    {
        $locales = config('translatable.locales');
        $translations = collect($locales)
            ->mapWithKeys(fn ($locale) => [
                $locale => [
                    'name' => fake()->realText(100),
                ],
            ])
            ->toArray();

        return [
            'slug' => fake()->slug,
            ...$translations,
        ];
    }
}
