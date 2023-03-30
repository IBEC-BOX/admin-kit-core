<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\DirectorySection\Directory\UI\Platform\Requests;

use AdminKit\Core\Containers\DirectorySection\Directory\Models\Directory;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RootDirectorySaveRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return RuleFactory::make([
            'slug' => ['nullable', 'string', 'max:255', Rule::unique(Directory::class, 'slug')->ignore($request->route('item'))],

            '%name%' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
