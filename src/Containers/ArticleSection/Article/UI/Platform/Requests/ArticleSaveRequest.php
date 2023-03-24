<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class ArticleSaveRequest extends FormRequest
{
    public function rules()
    {
        return RuleFactory::make([
            'slug' => ['nullable', 'string', 'max:255'],
            'pinned' => ['required', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'image_id' => ['nullable', 'exists:attachments,id'],

            '%title%' => ['nullable', 'string', 'max:255'],
            '%content%' => ['required_with:%title%', 'nullable', 'string', 'max:65535'],
            '%short_content%' => ['nullable', 'string', 'max:10000'],
        ]);
    }
}
