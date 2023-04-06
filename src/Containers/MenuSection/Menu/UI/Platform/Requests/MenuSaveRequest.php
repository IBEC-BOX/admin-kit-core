<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\MenuSection\Menu\UI\Platform\Requests;

use AdminKit\Core\Containers\MenuSection\Menu\Models\Menu;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuSaveRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return RuleFactory::make([
            'slug' => ['nullable', 'string', 'max:255', Rule::unique(Menu::class, 'slug')->ignore($request->route('item'))],

            '%title%' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
