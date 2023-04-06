<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\Data\Factories;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Use with children:
 * Menu::factory(2)->hasChildren(10)->create();
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;

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
                    'title' => fake()->realText(100),
                ],
            ])
            ->toArray();
    }
}
