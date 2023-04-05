<?php

declare(strict_types=1);

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Platform\Requests;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleSaveRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return RuleFactory::make([
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/i', Rule::unique(Article::class, 'slug')->ignore($request->route('item'))],
            'pinned' => ['required', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'image_id' => ['nullable', 'exists:attachments,id'],

            '%title%' => ['nullable', 'string', 'max:255'],
            '%content%' => ['required_with:%title%', 'nullable', 'string', 'max:65535'],
            '%short_content%' => ['nullable', 'string', 'max:10000'],
        ]);
    }
}
