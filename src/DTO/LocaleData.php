<?php

declare(strict_types=1);

namespace AdminKit\Core\DTO;

use AdminKit\Core\Facades\AdminKit;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class LocaleData extends Data
{
    public string $title;

    public string $native;

    public function __construct(
        public string $code,
    ) {
        $this->title = __("admin-kit::language.$this->code");
        $this->native = __(key: "admin-kit::language.$this->code", locale: $this->code);
    }

    public static function make(?string $locale = null): self
    {
        if (! $locale) {
            $locale = app()->getLocale();
        }

        return new self($locale);
    }

    public static function makeCollection(?array $locales = null): Collection
    {
        if (! $locales) {
            $locales = AdminKit::locales();
        }

        return collect($locales)
            ->map(fn (string $code) => new self($code));
    }
}
