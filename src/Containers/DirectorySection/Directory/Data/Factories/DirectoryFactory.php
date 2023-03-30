<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\Data\Factories;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Use with children:
 * Directory::factory(2)->hasChildren(10)->create();
 */
class DirectoryFactory extends Factory
{
    protected $model = Directory::class;

    public function definition()
    {
        return [
            'slug' => fake()->unique()->slug,
            ...$this->translatable(),
        ];
    }

    public function translatable()
    {
        $locales = config('translatable.locales');

        return collect($locales)
            ->mapWithKeys(fn ($locale) => [
                $locale => [
                    'name' => fake()->realText(100),
                ],
            ])
            ->toArray();
    }
}
