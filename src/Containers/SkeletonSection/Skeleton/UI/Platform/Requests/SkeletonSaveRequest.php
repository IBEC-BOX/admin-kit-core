<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\SkeletonSection\Skeleton\UI\Platform\Requests;

use AdminKit\Core\Containers\SkeletonSection\Skeleton\Models\Skeleton;
use AdminKit\Core\Ship\Abstracts\Requests\AbstractRequest;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkeletonSaveRequest extends AbstractRequest
{
    public function rules(Request $request)
    {
        return RuleFactory::make([
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/i', Rule::unique(Skeleton::class, 'slug')->ignore($request->route('item'))],

            '%title%' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
